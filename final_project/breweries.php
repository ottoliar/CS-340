<?php
    include 'template.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="./public/css/breweries.css">
    </head>
    <body>

        <div id="main">
            <h2>
                All breweries are shown below. Please help us expand our database by<br>
                adding any micro-breweries you know. NOTE: If a brewery already exists,<br>
                you cannot add another instance of it, even if it is in a different location.
            </h2>

        <table class="table">
                <tr>
                    <th>Brewery Name</th>
                    <th>Rating (Out of 5)</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Amenities</th>
                </tr>
            <?php
                $query = <<<stmt
                SELECT breweries.name, breweries.rating, locations.city, locations.state,
                GROUP_CONCAT(amenities.feature) AS features FROM breweries INNER JOIN locations ON
                breweries.location_id = locations.id INNER JOIN contains ON breweries.id = contains.brewery_id
                INNER JOIN amenities ON amenities.id = contains.amenity_id GROUP BY breweries.name;
stmt;
                $stmt = $mysql->prepare($query);
                $stmt->execute();
                $stmt->bind_result($b_name, $b_rating, $b_city, $b_state, $amenities);
                while ( $stmt->fetch() ) {

                    echo <<<res
                    <tr>
                        <td>$b_name</td>
                        <td>$b_rating</td>
                        <td>$b_city</td>
                        <td>$b_state</td>
                        <td>$amenities</td>
                    </tr>
res;

                }
            ?>
        </table>

        </div>

    </body>
</html>