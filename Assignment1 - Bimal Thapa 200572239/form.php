<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="form.css">
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

   <h1>Customer Data Entry</h1>
  <form action="processform.php" method="post">
  
   <label for="Customerid"> Customerid:</label><br>
    <input type="number" name="Customerid"><br>
   
   <label for="Firstname"> Firstname:</label><br> 
   <input type="text" name="Firstname"><br>

   <label for="Lastname"> Lastname:</label><br>
   <input type="text" name="Lastname"><br>

   <Label for="Payment"> Paid amount:</Label><br>
   <input type="number" name="Payment"><br>

  <input type="submit" value="Log" class="submit-butt">

  </form>
  <footer>
    <p>Bimal Thapa 200572239</p>
</footer>
</body>
</html>


