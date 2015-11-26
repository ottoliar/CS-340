<?php
    include 'template.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="./public/css/beer.css">
    </head>
    <body>

        <div id="main">
            <h2>
                Use the filters below to view the beers offered by the breweries in the database.<br>
                Or, click 'Search Beers' without using the filters to get all beers in the database.
            </h2>
            <form class="form-inline" action="b_process.php" method="GET">

                <select class="c-select" name="b_type">
                    <option selected>Select Beer Type</option>
                    <?php
                    $query = <<<stmt
                    SELECT DISTINCT type FROM beers;
stmt;
                    $stmt = $mysql->prepare($query);
                    $stmt->execute();
                    $stmt->bind_result($db_data);
                   while ( $stmt->fetch() ) {
                       echo <<<res
                        <option>$db_data</option>
res;
                    }
                    ?>
                </select>

                <select class="c-select" name="b_style">
                    <option selected>Select Beer Style</option>
                    <?php
                    $query = <<<stmt
                    SELECT DISTINCT style FROM beers;
stmt;
                    $stmt = $mysql->prepare($query);
                    $stmt->execute();
                    $stmt->bind_result($db_data);
                    while ($stmt->fetch()) {
                        echo <<<res
                        <option>$db_data</option>
res;
                    }
                    ?>
                </select>

                <select class="c-select" name="b_range">
                    <option selected>Select ABV% Range</option>
                    <option>0-5</option>
                    <option>5-10</option>
                    <option>10+</option>
                </select>

                <button type="submit" class="btn btn-primary">Search Beers</button>
            </form>
        </div>
    </body>
</html>
