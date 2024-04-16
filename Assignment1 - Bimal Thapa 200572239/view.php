<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details Page</title>
    <link rel="stylesheet" href="view.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="form.php">Add Customer Record</a></li>
                <li class="logo"><a href="index.html"><img src="BimoS.png"></a></li>
                <li><a href="view.php">View Customers Record</a></li>
            </ul>
        </nav>
    </header>

    <h2>Customer Details Page</h2>

    <table border="2">
        <tr> <!-- Added missing <tr> tag -->
            <th>Customerid</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Payment</th>
        </tr> <!-- Added missing <tr> tag -->

        <?php
        include("database.php");

        $sql = "SELECT * FROM Customer";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["Customerid"] . "</td>";
                echo "<td>" . $row["Firstname"] . "</td>";
                echo "<td>" . $row["Lastname"] . "</td>";
                echo "<td>" . $row["Payment"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records Found.</td></tr>";  // Corrected misspelled attribute 'colsplan' to 'colspan'
        }

        mysqli_close($conn);
        ?>
    </table>

    <footer>
        <p>Bimal Thapa 200572239</p>
    </footer>
</body>
</html>