<?php
            
session_start();
?>

<!DOCTYPE html>
<html>
<head>   
     <title>Game.php</title>    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            color: #1d3557;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 50px;
        }

        nav li {
            display: inline-block;
            margin-right: 20px;
        }

        nav a {
            margin:0;
            padding: 10px;
            color: #1d3557;
            text-decoration: none;
            background-color: #a8dadc;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        nav a:hover {
            background-color: #1d3557;
            color: #fff;
        }

        p {
            text-align: center;
            margin-top: 50px;
            color: #457b9d;
        }

        main {
            max-width: 600px;
            margin: 0 auto;
            padding: 50px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

    </style>
</head>

<body>
    <header>
        <?php
            $name=$_SESSION['name'];
            echo "<h1> Welcome , $name";
        ?>
        <h1>Game in php!</h1>
    </header>
    <nav>
        <ul>
            <li><a href="../phpFiles/GameFiles/gameLevel1.php">Let's Begin the Play</a></li>
            <li><a href="../hirtoryPage/history.php">HistoryPage</a></li>
            <li><a href="../LogOut/logout.php">Log Out</a></li>
            </ul>
        </nav>
</body>

</html>