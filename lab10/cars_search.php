<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Creating Web Application Lab 10">
    <meta name="keywords" content="PHP, MySQL">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars search record</title>
</head>
<body>
    <h1>Cars search record</h1>
    <?php
        htmlspecialchars($_POST["carmake"]);
        htmlspecialchars($_POST["carmodel"]);
        htmlspecialchars($_POST["price"]);
        htmlspecialchars($_POST["yom"]);
        
        $make = trim($_POST["carmake"]);
        $model = trim($_POST["carmodel"]);
        $price = trim($_POST["price"]);
        $yom = trim($_POST["yom"]);

        require_once ("sample_settings.php");  //connection info

        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

        // Checks if connection is successful
        if (!$conn) {
            // Display an error message
            echo "<p>Database connection failure</p>"; // not in production script
        }
        else {
            // Upon successful connection

            $sql_table="cars";

            // Set up the SQL command to query or add data into the table
            $query = "SELECT make, model, price FROM cars WHERE make like '%$make%' and model like '%$model%' and price like '%$price%' and yom like '%$yom%'";


            // Execute the query and store result into the result pointer
            $result = mysqli_query($conn, $query);

            // Checks if the execution was successful
            if (!$result) {
                echo "<p>There is an error in search!</p>";
            }
            else {
                // Display the retrived records
                echo "<table style='border: 1px;'>\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">Make</th>\n";
                echo "<th scope=\"col\">Model</th>\n";
                echo "<th scope=\"col\">Price</th>\n";
                echo "</tr>\n";

                // Rertrieve current record pointed by the result pointer
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n";
                    echo "<td>", $row["make"], "</td>\n";
                    echo "<td>", $row["model"], "</td>\n";
                    echo "<td>", $row["price"], "</td>\n";
                    echo "</tr>\n";
                }
                echo "</table>\n";

                // Free up the memory after using the result pointer
                mysqli_free_result($result);
            }

            // Close the database connection
            mysqli_close($conn);
        }
    ?>
</body>
</html>