<?php
    include 'template.php'
?>

<html>
    <head>
        <link rel="stylesheet" href="./public/css/add.css">
        <script src="./public/js/delete.js"></script>
    </head>

    <body>
        <h2>
            Please choose one of the appropriate forms below and then hit 'Delete' to delete from our database!<br>
        </h2>

        <div id="main">

            <select class="c-select" id="form_toggle">
                <option selected>Select Option To Delete...</option>
                <option>Delete brewery</option>
                <option>Delete beer</option>
            </select>
                <br>
                <br>

            <form method="POST" action="brewery_delete.php" id="f_brew_delete">
                <label for="brew_select">Brewery:</label>
                <select class="c-select" name="brew_select" id="brew_select">
                    <option selected>Select brewery...</option>
                    <?php
                    $query = <<<stmt
                    SELECT name FROM breweries;
stmt;
                    $stmt = $mysql->prepare($query);
                    $stmt->execute();
                    $stmt->bind_result($name);
                    while ( $stmt->fetch() ) {
                        echo <<<res
                        <option>$name</option>
res;
                    }
                    ?>
                </select>
                <br><br>
                <button type="submit" class="btn btn-primary" id="brew_delete">Delete</button>
            </form>

            <form method="POST" action="beer_delete.php" id="f_beer_delete">
                <label for="beer_select">Beer:</label>
                <select class="c-select" name="beer_select" id="beer_select">
                    <option selected>Select beer...</option>
                    <?php
                    $query = <<<stmt
                    SELECT name FROM beers;
stmt;
                    $stmt = $mysql->prepare($query);
                    $stmt->execute();
                    $stmt->bind_result($name);
                    while ( $stmt->fetch() ) {
                        echo <<<res
                        <option>$name</option>
res;
                    }
                    ?>
                </select>
                <br><br>
                <button type="submit" class="btn btn-primary" id="beer_delete">Delete</button>
            </form>

        </div>
    </body>
</html>
