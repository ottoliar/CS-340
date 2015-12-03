<?php
include 'template.php'
?>

<html>
<head>
    <link rel="stylesheet" href="./public/css/add.css">
</head>
    <body>
        <?php
            $query = <<<stmt
                    DELETE FROM beers WHERE beers.name = ?;
stmt;
            $stmt = $mysql->prepare($query);
            $stmt->bind_param('s', $_POST["beer_select"]);
            if ( !$stmt->execute() ) {
                echo <<<res
                    <h2>Something went wrong! Please try again.</h2>
res;
            } else {
                echo <<<res
                    <h2>Beer was successfully deleted!</h2>
res;
            }
            $stmt->close();
        ?>
    </body>
</html>
