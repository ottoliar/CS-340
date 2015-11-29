<?php
    include 'template.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="./public/css/beer.css">
    </head>
    <body>
        <div id="main">
            <table class="table">
                <tr>
                    <th>Beer Name</th>
                    <th>Type</th>
                    <th>Style</th>
                    <th>ABV%</th>
                    <th>Found At</th>
                </tr>
            <?php
                if ($_GET["b_type"] != "Select Beer Type" && $_GET["b_style"] != "Select Beer Style"
                    && $_GET["b_range"] != "Select ABV% Range") {

                    $type = mysqli_real_escape_string($mysql, $_GET["b_type"]);
                    $style = mysqli_real_escape_string($mysql, $_GET["b_style"]);
                    $abv = mysqli_real_escape_string($mysql, $_GET["b_range"]);
                    $lo = 0;
                    $hi = 0;

                    if ($abv == "0-5") {
                        $lo = 0; $hi = 5;
                    } else if ($abv == "5-10") {
                        $lo = 5; $hi = 10;
                    } else {
                        $lo = 10; $hi = 100;
                    }

                    $query = <<<stmt
                    SELECT beers.name, beers.type, beers.style, beers.abv, GROUP_CONCAT(breweries.name) AS found_at
                    FROM breweries INNER JOIN serves on breweries.id = serves.brewery_id INNER JOIN beers ON
                    beers.id = serves.beer_id WHERE beers.type = ? AND beers.style = ? AND beers.abv > ?
                    AND beers.abv < ? GROUP BY beers.name;
stmt;
                    $stmt = $mysql->prepare($query);
                    $stmt->bind_param('ssii', $type, $style, $lo, $hi);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($name, $style, $type, $abv, $found_at);
                    $num_rows = $stmt->num_rows;
                    if ($num_rows > 0) {
                        while ( $stmt->fetch() ) {

                            echo <<<res
                            <tr>
                                <td>$name</td>
                                <td>$style</td>
                                <td>$type</td>
                                <td>$abv</td>
                                <td>$found_at</td>
                            </tr>
res;
                        }


                    } else {

                        echo <<<res
                        <h2>No matching beers were found in the database with your filters.
                        Please go back and re-filter, or add a beer that you know matches
                        the criteria!</h2>
res;

                    }

                } else {

                    $query = <<<stmt
                    SELECT beers.name, beers.type, beers.style, beers.abv, GROUP_CONCAT(breweries.name) AS found_at
                    FROM breweries INNER JOIN serves on breweries.id = serves.brewery_id INNER JOIN beers ON
                    beers.id = serves.beer_id GROUP BY beers.name;
stmt;
                    $stmt = $mysql->prepare($query);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($name, $style, $type, $abv, $found_at);
                    $num_rows = $stmt->num_rows;
                    if ($num_rows > 0) {

                        while ( $stmt->fetch() ) {

                            echo <<<res
                        <tr>
                            <td>$name</td>
                            <td>$style</td>
                            <td>$type</td>
                            <td>$abv</td>
                            <td>$found_at</td>
                        </tr>
res;
                        }


                    } else {

                        echo <<<res
                        <h2>No matching beers were found in the database with your filters.
                        Please go back and re-filter, or add a beer that you know matches
                        the criteria!</h2>
res;


                    }
                }
            ?>

            </table>
        </div>
    </body>

</html>