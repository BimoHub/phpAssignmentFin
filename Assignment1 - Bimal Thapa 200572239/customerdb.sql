CREATE TABLE Customer (
    Customerid INT AUTO_INCREMENT PRIMARY KEY,
    Firstname VARCHAR(30) NOT NULL,
    Lastname VARCHAR(30) NOT NULL,
    Payment DOUBLE(10, 2) DEFAULT 0.00
);


INSERT INTO `Customer` (`Customerid`, `Firstname`, `Lastname`, `Payment`) VALUES
(1, 'Bimal', 'T', 16.55),
(2, 'A', 'T', 35.9),
(3, 'S', 'L', 14.75),
(4, 'I', 'L', 19.45),
(5, 'F', 'U', 35.21);
  
ALTER TABLE `Customer`
  MODIFY `Customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
