<?php
    include 'template.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="./public/css/employees.css">
    </head>
    <body>
        <div id="main">
            <h2>
                If you are interested in getting a snapshot of the industry<br>
                at a particular location, we can provide a glimpse into the<br>
                employee data of breweries through public records. If you are<br>
                looking for the most popular beers, the employee's favorite beer<br>
                should be a good indication of what will sell well in that region!<br>
                (Select location for specific location or submit for all employees)
            </h2>

            <form class="form-inline" action="e_process.php" method="GET">

                <select class="c-select" name="e_location">
                    <option selected>Choose Brewery Location</option>
                    <?php
                    $query =<<<stmt
                    SELECT city, state FROM locations;
stmt;
                    $stmt = $mysql->prepare($query);
                    $stmt->execute();
                    $stmt->bind_result($city, $state);
                    while ( $stmt->fetch() ) {
                        echo <<<res
                        <option>$city, $state</option>
res;

                    }
                    ?>
                </select>

                <button type="submit" class="btn btn-primary">Search Brewery Locations</button>
            </form>
        </div>
    </body>
</html>
