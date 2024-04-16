<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php
    include('header.php');
?>

<body>
    <h1>Register</h1>

    <p> Welcome Guest_user, here you may create data</p>

    <form action="register.php" method="post">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        Confirm Password: <input type="password" name="confirmPassword"><br>
        Email: <input type="email" name="email"><br>
        <input type="submit" name = "submit"> or <a href="login.php">Login</a>
    </form>

</html>

<?php
    date_default_timezone_set('UTC');

    require('conn.php');

    // @ is used to remove warning if variable is not set 
    // How @ works? https://www.geeksforgeeks.org/@-operator-in-php/
    $username = @$_POST['username'];
    $password = @$_POST['password'];
    $confirmPassword = @$_POST['confirmPassword'];
    $email = @$_POST['email'];
    $date = @$_POST[date("Y-m-d")];

    if (isset($_POST['submit'])) {
        // validation
        // !preg_match("/^[a-zA-Z-' ]*$/",$name)
        if ( $username && $password && $confirmPassword && $email) {

            if (strlen($username) >= 5 && !preg_match("/^[a-zA-Z-' ]*$/", $username) && strlen($password) >= 8 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($password == $confirmPassword) 
                {
                
                // inserting into database
                        if ($query = mysqli_query($conn, "INSERT INTO users (id,username, password, email, date) VALUES (NULL, '".$username."', '".$password."', '".$email."', '".$date."')")) {
                            echo "Registered successfully. Click <a href='login.php'>here</a> to login";
                        } else {
                            echo "Fail";
                        }
                }

                else {
                    echo "Passwords do not match";
                }
            }

            else
                {
                if (strlen($password) < 8) {
                    echo "Password must be at least 8 characters";
                }
                if (strlen($username) < 5) {
                    echo "Username must be at least 5 characters";
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "Email is not valid";
                }
                }
        }
        else {
            echo "Fill all fields";
        }
    }

?>
<!-- Fatal error: Uncaught mysqli_sql_exception: Access denied for user 'php_forum'@'localhost' (using password: NO) in C:\xampp\htdocs\Assignment 2 Attempt 3\register.php:24 Stack trace: #0 C:\xampp\htdocs\Assignment 2 Attempt 3\register.php(24): mysqli_connect('localhost', 'php_forum') #1 {main} thrown in C:\xampp\htdocs\Assignment 2 Attempt 3\register.php on line 24 -->

<!-- Warning: Undefined variable $conn in C:\xampp\htdocs\Assignment 2 Attempt 3\register.php on line 33
 -->

 <!-- Fatal error: Uncaught mysqli_sql_exception: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''id','username', 'password', 'email') VALUES ('','bimo', '123', 'bimalbimotha...' at line 1 in C:\xampp\htdocs\Assignment 2 Attempt 3\register.php:34 Stack trace: #0 C:\xampp\htdocs\Assignment 2 Attempt 3\register.php(34): mysqli_query(Object(mysqli), 'INSERT INTO use...') #1 {main} thrown in C:\xampp\htdocs\Assignment 2 Attempt 3\register.php on line 34 -->

 <?php
    include('footer.php');
?>