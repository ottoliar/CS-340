<?php
    include 'template.php'
?>

<html>
    <head>
        <link rel="stylesheet" href="./public/css/employees.css">
    </head>
    <body>
        <h2>Employees returned by query:</h2>
        <div id="main">

            <table class="table">
                <tr>
                    <th>Brewery</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Position</th>
                    <th>Pay/hr</th>
                    <th>Favorite Beer</th>
                </tr>
                <?php
                    if ($_GET["e_location"] != "Choose Brewery Location") {

                        $loc_str = $_GET["e_location"];
                        $loc_pieces = explode(",", $loc_str);
                        $city = trim($loc_pieces[0]);
                        $state = trim($loc_pieces[1]);

                        echo <<<res
                        Showing all employees working at breweries in $city, $state.
res;
                        $query = <<<stmt
                        SELECT breweries.name AS brew_name, employees.f_name, employees.l_name,
                        employees.age, employees.position, employees.pay_hr, beers.name AS fav_beer
                        FROM employees INNER JOIN beers ON employees.beer_id = beers.id INNER JOIN
                        breweries ON employees.brewery_id = breweries.id INNER JOIN locations ON
                        breweries.location_id = locations.id WHERE locations.city = ?
                        AND locations.state = ?;
stmt;
                        $stmt = $mysql->prepare($query);
                        $stmt->bind_param('ss', $city, $state);
                        $stmt->execute();
                        $stmt->bind_result($b_name, $f_name, $l_name, $age, $pos, $pay, $fav_beer);
                        while ( $stmt->fetch() ) {

                            echo <<<res
                            <tr>
                                <td>$b_name</td>
                                <td>$f_name $l_name</td>
                                <td>$age</td>
                                <td>$pos</td>
                                <td>$pay</td>
                                <td>$fav_beer</td>
                            </tr>
res;
                        }

                    } else {

                        echo <<<res
                        <h2>Showing all employees in the database.</h2>
res;

                        $query = <<<stmt
                        SELECT breweries.name AS brew_name, employees.f_name, employees.l_name,
                        employees.age, employees.position, employees.pay_hr, beers.name AS fav_beer
                        FROM employees INNER JOIN beers ON employees.beer_id = beers.id INNER JOIN
                        breweries ON employees.brewery_id = breweries.id;
stmt;
                        $stmt = $mysql->prepare($query);
                        $stmt->execute();
                        $stmt->bind_result($b_name, $f_name, $l_name, $age, $pos, $pay, $fav_beer);
                        while ( $stmt->fetch() ) {

                            echo <<<res
                            <tr>
                                <td>$b_name</td>
                                <td>$f_name, $l_name</td>
                                <td>$age</td>
                                <td>$pos</td>
                                <td>$pay</td>
                                <td>$fav_beer</td>
                            </tr>
res;
                        }
                    }
                ?>

            </table>
        </div>
    </body>
</html>
