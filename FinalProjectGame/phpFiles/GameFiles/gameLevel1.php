<?php
if(!isset($_POST['send']))
{
    session_start();
    require("RandomTextNumbersGenerattor.php");

    $userN=$_SESSION['name'];
    $password=$_SESSION['password'];

    $connection = new mysqli('localhost', 'root', '','finalprojectgame');
    $sql_select_query = "SELECT * FROM login WHERE TempPassword= '$password' and UserName = '$userN'";
    $select_query = $connection->query($sql_select_query);
    $number_of_rows = $select_query->num_rows;

    for ($j = 0; $j < $number_of_rows; ++$j) {
        $each_row = $select_query->fetch_array(MYSQLI_ASSOC);
        $numberOfLives=$each_row['numberOfLives']."<br>";
    }
    ?>
    <?php 
    if($numberOfLives<=0)
    {
        echo "You do not have more life to play this game !!!";
        echo "<a href='../../homepage/homepage.php'>Go To Home page</a>";
    }
    else
    {
        echo<<<_END
        <html>
            <head>
                <title>Game Level 1</title>
                <style>
                body{
                    background-image: url('./coast.jpeg');
                    padding-top:100px;
                }
                h1 {
                    text-align: center;
                    font-size: 24px;
                    margin-top: 30px;
                    color: #ADD8E6;
                }
    
                form {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    margin-top: 30px;
                }
    
                input[type="text"] {
                    padding: 10px;
                    margin-bottom: 20px;
                    font-size: 16px;
                    border-radius: 5px;
                    border: 1px solid #ccc;
                    width: 300px;
                    text-align: center;
                }
    
                input[type="submit"] {
                    padding: 10px;
                    border: none;
                    border-radius: 5px;
                    font-size: 20px;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }
    
                input[type="submit"]:hover {
                    color: #8b0000;
                }
                </style>
            </head>
            <body>
            <h1 id='game'>This is Game Level 1</h1> 
            <h1>Random Generated Letters  : 
        _END;
        ?>
        <?php
            $randomString=generateRandomString();
            for($i=0;$i<count($randomString);$i++)
            {
                echo $randomString[$i]." ";
            }
            echo "</h1>";
        ?>  
                </h1>
                <form method="post" action="gameLevel1.php">
                    <h1 style="margin-top:10px;">Sort Letters in Ascending Order :
                    <input type="hidden" name="randomString[]" value="<?php echo $randomString[0] ?>" /> 
                    <input type="hidden" name="randomString[]" value="<?php echo $randomString[1]?>" />
                    <input type="hidden" name="randomString[]" value="<?php echo $randomString[2]?>" />
                    <input type="hidden" name="randomString[]" value="<?php echo $randomString[3] ?>" />
                    <input type="hidden" name="randomString[]" value="<?php echo $randomString[4] ?>" />
                    <input type="hidden" name="randomString[]" value="<?php echo $randomString[5] ?>" />
                    
                    <input type="text" name="userInput"><br><br>
                    <input type="submit" name="send" value="SEND IT" style="color:black;background-color: #E6E6FA;width:200px;height:40px;font-size:20px" required="required"/>
                </form>
                </h1>
                </body>
            </html>
        <?php
    }
}
else
{   
    require("GameDataChecker.php");
    $randomString=$_POST['randomString'];


    // for($i=0;$i<count($randomString);$i++)
    // {
    //     echo $randomString[$i]."    ";
    // }

    echo "<br>";
    $input_letters=$_POST['userInput'];
    $input_letters = explode(',', $input_letters);

    //for($i=0;$i<count($input_letters);$i++)
    //{
    //    echo $input_letters[$i]."    ";
    //}
    //echo "<br>";
    
    
    if(isLettersInAscList($randomString,$input_letters))
    {
        include('../../classDatabase/Database.php');  
        echo<<<_END
        <html>
            <head>
                <title>Game Level 1</title>
                <style>
                body{
                    padding-top:100px;
                }
                img{
                    width:50%;
                    height:50%;
                    margin-left:25%;
                }
                h1 {
                    text-align: center;
                    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                    font-size: 40px;
                    margin-top: 30px;
                    color: black;
                }
                a {
                
                    font-size: 34px;
                    margin-top: 30px;
                    color: black;
                    text-decoration:none;
                }
                a:hover {
                    color: crimson;
                    decoration_type:border;
                }
                </style>
            </head>
            <body>
        _END;
        echo "<img src=\"./360_F_267115523_nhJWtLVlhtYtqGkfVOIzhOCAjQRrejVI.jpg\">";
        echo "<h1> You have completed Level 1!! <br>";
        echo "<a href='../../homepage/homepage.php'>Go Back To Login Page</a><br>";
        echo "<a href='../GameFiles/gameLevel2.php'>Go To Next Level</a>";
    }
    else
    {
        include('../../classDatabase/Database.php');  

        $userN=$_SESSION['name'];
        $password=$_SESSION['password'];

        $connection = new mysqli('localhost', 'root', '','finalprojectgame');
        $sql_select_query = "SELECT * FROM login WHERE TempPassword= '$password' and UserName = '$userN'";
        $select_query = $connection->query($sql_select_query);
        $number_of_rows = $select_query->num_rows;

        for ($j = 0; $j < $number_of_rows; ++$j) {
            $each_row = $select_query->fetch_array(MYSQLI_ASSOC);
            $numberOfLives=$each_row['numberOfLives']."<br>";
        }

        $numberOfLives=$numberOfLives-1;
        echo<<<_END
        <html>
            <head>
                <title>Game Level 1</title>
                <style>
                body{
                    background-image: url('./coast.jpeg');
                    padding-top:100px;
                }
                h1 {
                    text-align: center;
                    font-size: 24px;
                    margin-top: 30px;
                    color: #ADD8E6;
                }
                a {
                    margin-left:37.5rem;
                    font-size: 24px;
                    margin-top: 30px;
                    color: #ADD8E6;
                    text-decoration:none;
                }
                a:hover {
                    color: #8b0000;
                }
                </style>
            </head>
            <body>
        _END;
        echo"<h1>Number of lives : $numberOfLives </h1>";
        $userN=$_SESSION['name'];
        $password=$_SESSION['password'];

        $connection = new mysqli('localhost', 'root', '','finalprojectgame');
        $sql_select_query = "UPDATE login SET numberOfLives ='$numberOfLives'  WHERE TempPassword= '$password' and UserName = '$userN'";
        $select_query = $connection->query($sql_select_query);

        if($numberOfLives==0)
        {
            echo "Now You dont't have more life to play this game !!!";

            $connection = new mysqli('localhost', 'root', '','finalprojectgame');
            $sql_select_query = "UPDATE login SET result ='Fail'  WHERE TempPassword= '$password' and UserName = '$userN'";
            $select_query = $connection->query($sql_select_query);

            echo "<a href='../../homepage/homepage.php'>Go to home page</a>";
        }

        echo "<h1> Failed </h1><br>";
        echo "<a href='../../homepage/homepage.php'>Go Back To Login Page</a>";
    }
    echo "<br>";
}
?>