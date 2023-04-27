<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Lab 10">
    <meta name="keywords" content="PHP, File, input, output">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car Form</title>
</head>
<body>
    <h1>Lab10 Add Car Form</h1>
    <?php
        htmlspecialchars($_POST["carmake"]);
        htmlspecialchars($_POST["carmodel"]);
        htmlspecialchars($_POST["price"]);
        htmlspecialchars($_POST["yom"]);

	    $make = trim($_POST["carmake"]);
        $model      = trim($_POST["carmodel"]);
        $price      = trim($_POST["price"]);
        $yom = trim($_POST["yom"]);

        require_once ("sample_settings.php");

        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

        if (!$conn) {
            echo "<p>Database connection failure</p>";
        }
        else {
            $sql_table="cars";
            $errinput = false;
        }
            if ((is_numeric($price))&&(is_numeric($yom))) {
                $query = "INSERT INTO $sql_table (make, model, price, yom) VALUES ('$make', '$model', '$price', '$yom')";
                $result = mysqli_query($conn, $query);
            }
            else {
                $errinput = true;
            }

            if ($errinput) {
                echo "<p>Please check your input!</p>";
            }
            else {
                if ($result) {
                    echo "<p>Sucessfully recorded the data.</p>";
            }
                else {
                    echo "<p>Something is wrong with ", $squery, "</p>";
            }
            mysqli_close($conn);
        }
    ?>
</body>
</html>