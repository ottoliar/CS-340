<?php
    include 'template.php';
?>

<html>

    <head>
        <link rel="stylesheet" href="./public/css/add.css">
        <script src="./public/js/add.js"></script>
    </head>

    <body>
        <h2>
            Please choose one of the appropriate forms below and then hit 'Add' to add to our database!<br>
            NOTE: You must fill out only one form at a time, and the form must be filled out completely.
        </h2>

        <div id="main">

            <select class="c-select" id="form_toggle">
                <option selected>Select Option To Add...</option>
                <option>Add brewery</option>
                <option>Add beer</option>
            </select>
                <br>
                <br>
            <form method="POST" action="brewery_add.php" id="f_brew_add">
                <label for="brew_name">Brewery Name</label>
                <input type="text" name="brew_name" id="brew_name">

                <label for="brew_city">City</label>
                <input type="text" name="brew_city" id="brew_city">

                <label for="brew_state">State</label>
                <select id="brew_state" name="brew_state">
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
                    <br><br>
                <label for="brew_amenities">Brewery Amenities (Ctrl + Click for multiple)</label>
                <select multiple class="c_select" id="brew_amenities" name="brew_amenities[]">
                    <?php
                    $query = <<<stmt
                    SELECT feature FROM amenities;
stmt;
                    $stmt = $mysql->prepare($query);
                    $stmt->execute();
                    $stmt->bind_result($feature);
                    while ( $stmt->fetch() ) {
                        echo <<<res
                        <option>$feature</option>
res;
                    }
                    ?>
                </select>

                <label for="brew_rating">Brewery Rating</label>
                <select class="c-select" id="brew_rating" name="brew_rating">
                    <option selected>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
                    <br>
                    <br>
                <button type="submit" class="btn btn-primary" id="brew_add">Add Brewery</button>
            </form>

            <form method="POST" action="beer_add.php" id="f_beer_add">
                <label for="beer_name">Beer Name</label>
                <input type="text" name="beer_name" id="beer_name">

                <label for="beer_type">Beer Type</label>
                <select class="c_select" id="beer_type" name="beer_type">
                    <option selected>Select Type...</option>
                    <option>Ale</option>
                    <option>Lager</option>
                </select>

                <label for="beer_style">Beer Style</label>
                <input type="text" name="beer_style" id="beer_style">

                <label for="beer_abv">ABV%</label>
                <input type="number" name="beer_abv" min="1" max="20">
                    <br><br>
                <label for="beer_found_at">Found At (Ctrl + Click for multiple)</label>
                <select multiple class="c_select" id="beer_found_at" name="beer_found_at[]">
                    <?php
                        $query = <<<stmt
                        SELECT name FROM breweries;
stmt;
                        $stmt = $mysql->prepare($query);
                        $stmt->execute();
                        $stmt->bind_result($name);
                        while( $stmt->fetch() ) {
                            echo <<<res
                            <option>$name</option>
res;
                        }
                    ?>
                </select>
                    <br>
                    <br>
                <button type="submit" class="btn btn-primary" id="beer_add">Add Beer</button>
            </form>

        </div>

    </body>
</html>
