<?php
    include 'template.php';
?>


<html>
    <head>
        <link rel="stylesheet" href="./public/css/home.css">
    </head>
    <body>
        <div id="main">
            <h2>Welcome to the Micro-Brewery Database!</h2>
            <h3>
                <p>
                    We are committed to giving you the best & most accurate
                    information on micro-breweries.  Whether you want to find
                    local beers or find what beers are popular with the employees,
                    we have got you covered! We also provide a list of salaries for
                    of the brewery employees, along with amenities that the brewery
                    provides.  Please help us expand our database for future use by
                    clicking the 'add' tab above and then entering your information!
                </p>
            </h3>
            <h4>
                Top 3 Rated Breweries:
            </h4>
            <ol>
                <?php
                $query = <<<stmt
                SELECT name, rating FROM breweries
                ORDER BY rating DESC limit 3;
stmt;
                $stmt = $mysql->prepare($query);
                $stmt->execute();
                $stmt->bind_result($name, $rating);
                while ($stmt->fetch()) {
                    echo <<<res
                    <li>Name: $name Rating: $rating/5</li>
res;
                }
                ?>
            </ol>
        </div>
    </body>
</html>