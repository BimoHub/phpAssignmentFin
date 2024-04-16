<!-- MY ACCOUNT-->
<?php

    session_start();
    require('conn.php');

    if (@$_SESSION["username"]) {

        include 'header.php';
        $username = @$_SESSION['username'];
?>


<html>

    <head>
        <title>Profile Page</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <center> 
            
            <!-- <a href = "index.php"> My Account </a> |<a href = "account.php"> Home Page</a> | <a href = "index.php?action=logout">Logout</a> 
            One common issue could be the extra spaces in the 'action = logout' part of the URL. -->
       
            <h1>Welcome to your profile page, <?php echo $_SESSION["username"] ?>! Here you may Update and Delete data</h1> 
            <h2>You may also <a href = "index.php?action=changeimage" class = "picturechangelink">change your profile picture</a></h2>

        </center>

        
        <style>

        table

        {
            width: 1000px;
        
            text-align: center;
            color: white;
            background: linear-gradient(rgba(232, 98, 26, 0.5),rgba(2, 2, 158, 0.5));
        }

        </style>
            <?php 
                echo "<center><table  border = 1 >
                <tr>
                <th>Profile Picture</th>

                <th>Id</th>

                <th>Username</th>

                <th>Password</th>

                <th>Email</th>

                <th>Description</th>

                </tr>";

                $check = mysqli_query($conn, "SELECT * FROM users");
                $rowByRow = mysqli_num_rows($check);

                while ($row = mysqli_fetch_assoc($check)) {
                    echo "<tr>";
                    echo "<td><center><img src =  '".$row['pic']."' width = '50' height = '50'></center></td>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "</tr>";

                    
                }



                echo "</center>";
            ?>
            
            <a href ='index.php?action=changepassword'>Change Password</a>
                <br><br>
            <a href ='index.php?action=delete'>Delete Account. You will be redirected to Registration page</a>

       
    </body>
</html>


<?php

    if (@$_GET['action'] == 'logout') {
        session_destroy();
        header("location:login.php");
    }

    if (@$_GET['action'] == 'delete') {
        $delete = mysqli_query($conn, "DELETE FROM users WHERE username = '" . $_SESSION['username'] . "'");
        session_destroy();
        header("location:register.php");
    }

    if (@$_GET['action'] == 'changeimage') {
        
        echo 
            "
            <form action ='index.php?action=changeimage' method = 'POST' enctype = 'multipart/form-data'>
            <br><br>Available file extensions:<b> jpg, jpeg, png </b>
            ";
        // enctype used when uploading file thru the form
        echo"<br><br>Upload a new profile picture: <input type = 'file' name = 'pic' accept = '.jpg, .jpeg, .png'><br>";
        echo"<br>Submit the change: <input type = 'submit' name = 'submit_image'>";

            if (isset($_POST['submit_image']))
            {
                $errors = array();
                
                /**
                 * This is an array of file extensions that are allowed to be uploaded.
                 * These will be the only file types that will pass the check when 
                 * checking the file extension of the file being uploaded.
                 */
                $allowedExts = array("jpg", "jpeg", "png");
                
                /**
                 * The name of the file that was uploaded. This is the file name
                 * and extension combined as one string.
                 */
                $fileName = @$_FILES['pic']['name'];
                
                /**
                 * This variable is used to determine if the file's extension
                 * is in the $allowedExts array. It does this by converting the
                 * file's extension to all lower case and then checking if it
                 * exists in the $allowedExts array.
                 */
                $file_e = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                
                /**
                 * The size of the file that was uploaded in bytes.
                 */
                $file_s = @$_FILES['pic']['size'];
                
                /**
                 * This is the temporary file location of the file that was uploaded.
                 * This is the file's location ON the server. When a file is uploaded
                 * through a form, it is first stored temporarily on the server before
                 * it is moved to its final destination. This is the temporary location
                 * of the file.
                 */
                $filetemp = @$_FILES['pic']['tmp_name'];

                if (in_array(trim($file_e), $allowedExts) === false) {
                    $errors[] = "Extension not allowed";
                }

                if ($file_s > 2097152) {
                    // 2097152 is 2MB
                    $errors[] = "File size too large";
                }

                if (empty($errors)) {
                    move_uploaded_file($filetemp, "assets/".$fileName);
                    $imageUpload = "assets/" . $fileName;
                    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '".@$_SESSION['username']."'");
                    $rowByRow = mysqli_num_rows($check);

                    while ($row = mysqli_fetch_assoc($check)) {
                        $db_Image = $row['pic'];

                    }

                    if ($query = mysqli_query($conn, "UPDATE users SET pic = '$imageUpload' WHERE username = '".@$_SESSION['username']."'")) {
                        echo "<br><br>Image uploaded successfully! Reload to see changes";
                    }
                }

                else{
                    foreach ($errors as $error) {
                        echo $error . " ";
                    }
            }
        }

        echo "</form>";
        
    }

    if (@$_GET['action'] == 'changepassword') {
        echo "<form action ='index.php?action=changepassword' method = 'POST'>";
        echo"<br><br>Old Password: <input type = 'password' name = 'oldpassword'><br>";
        echo"New Password: <input type = 'password' name = 'newpassword'><br>";
        echo"Confirm Password: <input type = 'password' name = 'confirmpassword'><br>";
        echo "Submit the change: <input type = 'submit' name = 'submit'>";
        echo "</form>";
    }

        $oldPassword = @$_POST['oldpassword'];
        $newPassword = @$_POST['newpassword'];
        $confirmPassword = @$_POST['confirmpassword'];

        // $profilepicture = @$_FILES['profilepicture']['name'];
        


    //image change
    // if (isset($_POST['submit_image']))
    // {
    //     $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$username."'");
    //     $rowByRow = mysqli_num_rows($check);
    //     while ($row = mysqli_fetch_assoc($check)) {
    //         $_GET_pic = $row['pic'];

    //         if ($query = mysqli_query($conn, "UPDATE users SET pic = '$profilepicture' WHERE username = '$username'"))
    //         {
    //             echo "<br>Profile picture changed successfully. Refresh the page to reflect changes in table.<br>";
    //         }
    //         else {
    //             echo "<br>Profile picture not changed<br>";
    //         }
            
    //     }
    // }

    if (isset($_POST['submit']))
    {
        $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$username."'");
        $rowByRow = mysqli_num_rows($check);
        while ($row = mysqli_fetch_assoc($check)) {
            $_GET_pass = $row['password'];

            if (strlen($newPassword)>7) {
                if ($oldPassword == $_GET_pass) {
                    if ($newPassword == $confirmPassword) {
                        if ($query = mysqli_query($conn, "UPDATE users SET password = '$newPassword' WHERE username = '$username'"))
                        {
                            echo "<br>Password changed successfully. Refresh the page to reflect changes in table.<br>";
                        }
                        else {
                            echo "<br>Passwords do not match<br>";
                        }
                        
                    }
                }
            }

            else {
                echo "<br>New Password must be at least 8 characters long<br>";
            }
        }
    }

} // this bracket was missing
    else {
        echo "Login to see your profile";
        
        ?>
    
    <a href = "login.php"> Login </a>

    <?php
}
include('footer.php');

?>
