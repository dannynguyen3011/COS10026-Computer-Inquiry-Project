<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Creating Web Application Lab 10">
    <meta name="keywords" content="PHP, MySQL">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieving records to HTML</title>
</head>
<body>
    <h1>Creating Web Application - Lab 10</h1>
    <?php
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
            $query = "SELECT make, model, price FROM cars ORDER BY make, model";

            // Execute the query and store result into the result pointer
            $result = mysqli_query($conn, $query);

            // Checks if the execution was successful
            if (!$result) {
                echo "<p>Something is wrong with ", $squery, "</p>";
            } else {
                // Display the retrived records
                echo "<table border=\"1\">\n";
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