<!-- HOME PAGE -->

<html>
    <?php
        session_start();
        require('conn.php');
        include('header.php');
    ?>

    <head>
        <title>Home Page</title>
        <link rel="stylesheet" href="style.css">
        <center>
            
            <h1>Welcome to the home page! Here you may Read data</h1>
        
        </center>
    </head>


    <!-- Fetching data -->

    <body>

        <style>

        table

        {
            width: 1000px;
        
            text-align: center;
            color: white;
            background: linear-gradient(rgba(232, 98, 26, 0.5),rgba(2, 2, 158, 0.5));
            background-position: center;
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

                include('footer.php');

            ?>

        
    </body>

</html>