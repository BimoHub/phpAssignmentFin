<html>

    <?php
        include('header.php');
    ?>

    <head>
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

       
        <form action="login.php" method="post">
            <h2>Login</h2>
            <input type="text" name="username" placeholder="Username">
            <br>
            <input type="password" name="password" placeholder="Password">
            <br>
            <input type="submit" name="login" value="Login"> or <a href="register.php">Register (Create Data)</a> 

        </form>

    </body>

</html>

<?php
    session_start();
    require('conn.php');

    $username = @$_POST['username'];
    $password = @$_POST['password'];

    if (isset($_POST['login'])) {
        if ($username && $password) {
            $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$username."'");
            $rowByRow = mysqli_num_rows($check);

            if ($rowByRow != 0) 
            {
                while ($row = mysqli_fetch_assoc($check)) {
                    $db_Username = $row['username'];
                    $db_Password = $row['password'];
                }

                if ($username == $db_Username && $password == $db_Password) {
                    echo "Login successful";
                    @$_SESSION["username"] = $username;
                    header("Location: index.php"); 
                }

                else {
                    echo "Wrong username or password";
                }
            }

            else {
                die("Username does not exist");
            }

        }
        else {
            echo "Enter username and password";
        }
    }
        
?>

<?php
        include('footer.php');
?>
