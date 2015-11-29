<?php
    include 'template.php';
?>

<html>
    <head>
         <link rel="stylesheet" href="./public/css/add.css">
    </head>
    <body>
    <?php
        $init_query = <<<stmt
        SELECT id FROM breweries WHERE breweries.name = ?;
stmt;
        $i_stmt = $mysql->prepare($init_query);
        $i_stmt->bind_param('s', $_POST["brew_name"]);
        $i_stmt->execute();
        $i_stmt->store_result();
        $i_stmt->bind_result($i_id);
        $i_num_rows = $i_stmt->num_rows;

        if ($i_num_rows > 0) {
            echo <<<res
            <h2>Brewery already exists in the database. Sorry, we only accept new submissions.</h2>
res;
            exit();
        }
        $i_stmt->close();

        $city = $_POST["brew_city"];
        $state = $_POST["brew_state"];
        $rating = $_POST["brew_rating"];

        $query = <<<stmt
        SELECT id FROM locations WHERE locations.city = ? AND locations.state = ?;
stmt;
        $stmt = $mysql->prepare($query);
        $stmt->bind_param('ss', $city, $state);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id);
        $num_rows = $stmt->num_rows;

        if ($num_rows > 0) {

            $stmt->fetch();
            $secondary_query = <<<stmt
            INSERT INTO breweries (name, rating, location_id) VALUES (?, ?, ?);
stmt;
            $stmt_2 = $mysql->prepare($secondary_query);
            $stmt_2->bind_param('sii', $_POST["brew_name"], $rating, $id);
            $stmt_2->execute();
            $last_id = $stmt_2->insert_id;

            foreach ($_POST["brew_amenities"] as $amenity) {
                $temp_query = <<<stmt
                SELECT id FROM amenities WHERE amenities.feature = ?;
stmt;
                $stmt_3 = $mysql->prepare($temp_query);
                $stmt_3->bind_param('s', $amenity);
                $stmt_3->execute();
                $stmt_3->bind_result($id);
                $stmt_3->fetch();
                $stmt_3->close();
                $temp_query_2 = <<<stmt
                INSERT INTO contains (amenity_id, brewery_id) VALUES (?, ?);
stmt;
                $stmt_4 = $mysql->prepare($temp_query_2);
                $stmt_4->bind_param('ii', $id, $last_id);
                $stmt_4->execute();
                $stmt_4->close();
            }

            echo <<<res
            <h2>
                Thank you for adding to the database!
            </h2>
res;

        } else {

            $secondary_query = <<<stmt
            INSERT INTO locations (city, state) VALUES (?, ?);
stmt;
            $stmt_2 = $mysql->prepare($secondary_query);
            $stmt_2->bind_param('ss', $city, $state);
            $stmt_2->execute();
            $last_loc_id = $stmt_2->insert_id;

            $ter_query = <<< stmt
            INSERT INTO breweries (name, rating, location_id) VALUES (?, ?, ?);
stmt;
            $stmt_3 = $mysql->prepare($ter_query);
            $stmt_3->bind_param('sii', $_POST["brew_name"], $rating, $last_loc_id);
            $stmt_3->execute();
            $last_brew_id = $stmt_3->insert_id;

            foreach ($_POST["brew_amenities"] as $amenity) {
                $temp_query = <<<stmt
                SELECT id FROM amenities WHERE amenities.feature = ?;
stmt;
                $stmt_4 = $mysql->prepare($temp_query);
                $stmt_4->bind_param('s', $amenity);
                $stmt_4->execute();
                $stmt_4->bind_result($id);
                $stmt_4->fetch();
                $stmt_4->close();
                $temp_query_2 = <<<stmt
                INSERT INTO contains (amenity_id, brewery_id) VALUES (?, ?);
stmt;
                $stmt_5 = $mysql->prepare($temp_query_2);
                $stmt_5->bind_param('ii', $id, $last_brew_id);
                $stmt_5->execute();
                $stmt_5->close();
            }

            echo <<<res
            <h2>
                Thank you for adding to the database!
            </h2>
res;
        }

    ?>
    </body>
</html>
