<?php   
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include('connection.php');  

    if(isset($_POST['send']))
    {
        $username = $_POST['UserName'];  
        $password = $_POST['TempPassword']; 
        $confirmPasword=$_POST['ConfirmPassword']; 

        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select *from login where UserName = '$username'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1)
        {
            if($password==$confirmPasword)
            {
                $sql = "update login set TempPassword= '$password' where UserName = '$username'";  
                $result = mysqli_query($con, $sql);  

                if($result)
                {
                    echo "You have successfully updated your Password<br>";
                    echo "User name :".$username."<br>";
                    echo "Password  :".$password."<br>";

                    echo<<<_END
                    <html>
                        <head></head>
                        <body>
                            <a href='../../index.html'>Login Page</a>
                        </body>
                    </html>
                    _END;
                }
                else
                {
                    echo "There is Something wrong with your Username";
                }
            }
            else
            {
                echo '<script>alert("Confirm Password is not mathcing")</script>';
                echo<<<_END
                <html>
                    <head></head>
                    <body>
                        <a href='../../index.php'>Back to Login Page</a>
                    </body>
                </html>
                _END;
            }
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     
    }
?> 