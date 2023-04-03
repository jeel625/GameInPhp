<?php
    require('../classDatabase/Database.php');

    $userN = $_SESSION['name'];
    $password = $_SESSION['password'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>User Info</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                margin: 0;
                padding: 0;
                margin-top: 9rem;
            }
            h1 {
                text-align: center;
                color: #333;
                font-family:'Courier New', Courier, monospace;
            }
            .user-info {
                max-width: 500px;
                margin: 20px auto;
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 20px;
            }
            .user-info p {
                margin: 10px 0;
                font-size:20px;
                font-family: 'Courier New', Courier, monospace;
            }
            .user-info a {
                display: block;
                text-align: center;
                margin-top: 20px;
                color:black;
                font-size:20px;
                font-family: 'Courier New', Courier, monospace;
            }
        </style>
    </head>
    <body>
        <?php
            $connection = new mysqli('localhost', 'root', '', 'finalprojectgame');
            $sql_select_query = "SELECT * FROM login WHERE TempPassword = '$password' AND UserName = '$userN'";
            $select_query = $connection->query($sql_select_query);
            $number_of_rows = $select_query->num_rows;

            if ($number_of_rows > 0) {
                echo '<h1>User Info</h1>';
                echo '<div class="user-info">';
                while ($each_row = $select_query->fetch_array(MYSQLI_ASSOC)) {
                    echo '<p>id: ' . $each_row['id'] . '</p>';
                    echo '<p>First name: ' . $each_row['FirstName'] . '</p>';
                    echo '<p>Last name: ' . $each_row['LastName'] . '</p>';
                    echo '<p>Result: ' . $each_row['result'] . '</p>';
                    echo '<p>Number of Lives: ' . $each_row['numberOfLives'] . '</p>';
                    echo '<p>Date and Time: ' . $each_row['dateAndTime'] . '</p>';
                }
                echo '<a href="../homepage/homepage.php">Go Back To Login Page</a>';
                echo '</div>';
            } else {
                echo '<p>No user found with the given credentials.</p>';
            }
        ?>
    </body>
</html>
