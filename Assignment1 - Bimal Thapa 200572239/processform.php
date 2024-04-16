<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Customerid = filter_input(INPUT_POST, "Customerid", FILTER_VALIDATE_INT);
    $Firstname = filter_input(INPUT_POST, "Firstname", FILTER_SANITIZE_SPECIAL_CHARS);
    $Lastname = filter_input(INPUT_POST, "Lastname", FILTER_SANITIZE_SPECIAL_CHARS);
    $Payment = filter_input(INPUT_POST, "Payment", FILTER_VALIDATE_FLOAT);

    if ($Customerid !== false && $Firstname !== null && $Lastname !== null && $Payment !== false) {
        include("database.php");

        $insertSql = "INSERT INTO employee (Customerid, Firstname, Lastname, Payment) VALUES ('$Customerid', '$Firstname', '$Lastname', '$Payment')";
        $insertResult = mysqli_query($conn, $insertSql);

  
        if ($insertResult) {
            echo "Data inserted successfully!";
        } else {
            echo "Error inserting data: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Input not accepted";
    }
}

header("Location: view.php");
exit();

