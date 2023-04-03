<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ConnectingToDatabase
{
    public $userName="";
    public $password="";
    public $email="";
    public $confirmPasswword="";
    public $fname="";
    public $lname="";

    function __construct($userName,$password,$confirmPassword,$lname,$fname,$email)
    {
        $this->fname=$fname;
        $this->lname=$lname;
        $this->email=$email;
        $this->userName = $userName;
        $this->password = $password;
        $this->confirmPasswword=$confirmPassword;
    }

    function getDatabaseConnectionUser()
    {
        global $connection;
        //Login info 

        //Attempt to connect to MySQL using MySQLi
        //If connection to the MySQL failed display an error message
        if ($connection->connect_error)
            die("Connection to MySQL failed! <br>" . mysqli_connect_error());
        return $connection;
    }

    function verifyConnection($connection)
    {
        //Attempt to connect to the Database
        $check_connect_to_db = mysqli_select_db($connection, 'finalprojectgame'); //repeat-1
        //If connection to the Database failed create the database
        if ($check_connect_to_db === FALSE) {
            //SQL query
            $sql_create_db = "CREATE DATABASE finalprojectgame";
            //Execute the query
            $create_db = $connection->query($sql_create_db); //repeat-2
            //If the Database creation failed display an error message  
            if ($create_db === FALSE)
                die("Attempt to create the DB failed!<br/>" . $connection->error);
            //If the Database creation succeed connect to it
            else {
                $check_connect_to_db = mysqli_select_db($connection, 'finalprojectgame'); //repeat-1
                //If connection to the database created failed display an error message
                if ($check_connect_to_db === FALSE)
                    die("Connection to the DB failed!<br/> " . $connection->error);
            }
        }
    }

    function insertUsertoSignInForm($userName,$password,$lname,$fname,$email,$connection)
    {
        $sql_select_query = "SELECT * FROM login WHERE  UserName = '$userName'";
        $select_query = $connection->query($sql_select_query);
        $number_of_rows = $select_query->num_rows;
        
        if($number_of_rows==1)
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
                #err{
                   border:0.4px solid crimson;
                   width:40%; 
                   margin:auto;
                }
                h2{
                    text-align: center;
                    font-size: 24px;
                    margin-top: 30px;
                    color: gold;
                } 
                h1{
                    text-align: center;
                    font-size: 24px;
                    margin-top: 30px;
                    color: #ADD8E6;
                    text-decoration:none;
                }       
                a{
                    text-align: center;
                    font-size: 24px;
                    margin-top: 30px;
                    color: gold;
                    text-decoration:none;
                }
                a:hover{
                    color: crimson;
                    cursor:pointer;
                }                
                </style>
                </head>
                <body>
            _END;
            echo "<div id =\"err\">";
            echo "<h2>This User name is Exists Please...Choose Another User -Name Thank you!!</h2>";
            echo '<h1><a  href="../../index.php">Go Back To Login Page</a></h1>';
            echo"</div>";

        }
        else
        {
            $sql_insert_query = "INSERT INTO login (UserName,TempPassword,LastName,FirstName,Email)
            VALUES ('$userName','$password','$lname','$fname','$email')";

            $insert_query = $connection->query($sql_insert_query); 

            if ($insert_query === FALSE)
                die("Data insertion to the Table failed!<br>" . $connection->error);
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
                            </style>
                            </head>
                            <body>
                    _END;
                echo "<h1 style='color:crimson'> Thanks For the Registration , $userName</h1>";
                }
        }
    }

    function selectUsers($connection)
    {
        $sql_select_query = "SELECT * FROM login";
        //Execute the query
        $select_query = $connection->query($sql_select_query); //repeat-2
        //If data selection failed, display an error message
        if ($select_query === FALSE)
            die("Data selection from the Table failed!<br/>" . $connection->error);
        else {
            return $select_query;
        }
    }

    function displayUsers($select_query, $connection)
    {
        $number_of_rows = $select_query->num_rows;
        //Use a loop to display the rows one by one
        echo "<table>";
        echo "<tr><td>ID</td><td>User Name</td><td>Password</td><td>Full Name</td><td>Email</td></tr>";
        for ($j = 0; $j < $number_of_rows; ++$j) {
            echo "<tr>";
            //Assign the records of each row to an associative array
            $each_row = $select_query->fetch_array(MYSQLI_ASSOC);
            //Display each the record corresponding to each column
            echo "<td>" . $each_row['id'] . "</td>";
            echo "<td>" . $each_row['UserName'] . "</td>";
            echo "<td>" . $each_row['TempPassword'] . "</td>";
            echo "<td>" . $each_row['FirstName'] . "</td>";
            echo "<td>" . $each_row['LastName'] . "</td>";
            echo "<td>" . $each_row['Email'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    function connectTable($connection)
    {
        $flag=false;
        try 
        {
            $sql_desc_table = "DESC login";
            $check_table_exists = $connection->query($sql_desc_table); 
            if ($check_table_exists === FALSE) 
            {
                $sql_create_table = "CREATE TABLE login(
                                                        id int NOT NULL AUTO_INCREMENT, 
                                                        UserName varchar(50) not null, 
                                                        TempPassword varchar(50) not null, 
                                                        LastName varchar(55) NOT NULL, 
                                                        FirstName varchar(55) not null,
                                                        Email varchar(50) not null,
                                                        result int default 'Incomplete',
                                                        numberOfLives int DEFAULT 6,
                                                        dateAndTime date null,
                                                        PRIMARY KEY (id) 
                CHARACTER SET utf8 COLLATE utf8_general_ci;";
                        $create_table = $connection->query($sql_create_table); 
                        
                if ($create_table === FALSE)
                    die("Creation of the Table users failed!<br>" . $connection->error);
                else
                    $flag=true;
            }
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo "There is Error Regarding creation of tables";
        }
        return $flag?true:false;
    }
    function checkingNames()
    {
        $pattern = '/(?:^(?:[0-9!@#$%^&*()_+=-]))/';
        if((preg_match($pattern, $this->fname)==1)&&(preg_match($pattern, $this->lname)==1))
        {
            echo "<script>alert('FirstName and LastName cannot Start with Digits')</script>";
            echo<<<_END
            <html>
                <head></head>
                <body>
                    <a href='../../index.html'>Back to Login Page</a>
                </body>
            </html>
            _END;
            return false;
        }
        else
            return true;
    }
    function checkingPassword()
    {
       if(!($this->password==$this->confirmPasswword))
       {
            echo "<script>alert('Confirm Password Should match ')</script>";
            echo<<<_END
            <html>
                <head></head>
                <body>
                    <a href='../../index.php'>Back to Login Page</a>
                </body>
            </html>
            _END;
            return false;
       }
       else
        return true;
    }
}

if (isset($_POST['send'])) {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Registration Form</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="container">
            <h1 class="blueText">Registration List</h1>
            <hr />
            <?php

}

$connection = new mysqli('localhost', 'root', '');

$database = new ConnectingToDatabase($_POST['UserName'], $_POST['TempPassword'],$_POST['ConfirmPassword'],$_POST['LastName'],$_POST['FirstName'],$_POST['Email']);
$database->getDatabaseConnectionUser();
$database->verifyConnection($connection);
$database->connectTable($connection);
if($database->checkingNames() && $database->checkingPassword())
{
    $database->insertUsertoSignInForm( $database->userName,$database->password,$database->lname,$database->fname,$database->email,$connection);
    $select_query = $database->selectUsers($connection);
    $select_query->close();
    $connection->close();
}
?>
        <div style = "text-align:center;margin-top:1.5rem;"id="back">
        <?php
        echo<<<_END
        <html>
                        <head>
                            <title>Game Level 1</title>
                            <style>
                input[type="submit"] {
                    width:10%;
                    background-color:brown;
                    color:#8b0000;
                    padding: 10px;
                    border: none;
                    border-radius: 5px;
                    font-size: 20px;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }
                input[type="submit"]:hover {
                    color: white;
                }
                </style>
                </head>
                </html>
        _END;
        ?>
            <a href="../../index.php"><input type="submit" value="Login!"></a>
        </div>
    </div>
</body>

</html>