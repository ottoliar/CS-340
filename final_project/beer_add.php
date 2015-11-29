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
        SELECT id FROM beers WHERE beers.name = ?;
stmt;
        $i_stmt = $mysql->prepare($init_query);
        $i_stmt->bind_param('s', $_POST["beer_name"]);
        $i_stmt->execute();
        $i_stmt->store_result();
        $i_stmt->bind_result($i_id);
        $i_num_rows = $i_stmt->num_rows;

        if ($i_num_rows > 0) {
            echo <<<res
            <h2>That beer already exists in the database. Sorry, we only accept new submissions.</h2>
res;
            exit();
        }
        $i_stmt->close();

        $b_type = $_POST["beer_type"];
        $b_style = $_POST["beer_style"];
        $b_abv = $_POST["beer_abv"];

        $query = <<<stmt
        INSERT INTO beers (name, style, type, abv) VALUES (?, ?, ?, ?);
stmt;
        $stmt = $mysql->prepare($query);
        $stmt->bind_param('sssi', $_POST["beer_name"], $b_style, $b_type, $b_abv);
        $stmt->execute();
        $last_id = $stmt->insert_id;

        foreach ($_POST["beer_found_at"] as $brewery) {
            $temp_query = <<<stmt
            SELECT id FROM breweries WHERE breweries.name = ?;
stmt;
            $stmt_2 = $mysql->prepare($temp_query);
            $stmt_2->bind_param('s', $brewery);
            $stmt_2->execute();
            $stmt_2->bind_result($id);
            $stmt_2->fetch();
            $stmt_2->close();
            $temp_query_2 = <<<stmt
            INSERT INTO serves (beer_id, brewery_id) VALUES (?, ?);
stmt;
            $stmt_3 = $mysql->prepare($temp_query_2);
            $stmt_3->bind_param('ii', $last_id, $id);
            $stmt_3->execute();
            $stmt_3->close();
        }

        echo <<<res
        <h2> Thank you for adding to the database!</h2>
res;

    ?>
    </body>
</html>
