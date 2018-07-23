<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$w = $_POST['pt'];
$date = $_POST['date'];
$discount = $_POST['discount'];

$result = mysql_query("SELECT * FROM products WHERE product_id= '$b' AND empresa_id = $sesionEmpresaID");
//echo "SELECT * FROM products WHERE product_id= '$b'";

while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
$asasa=$row['pricesale'];
$code=$row['code'];
$gen=$row['name'];
$name=$row['product_name'];
$p=$row['marginsale'];
}

//edit qty
$result = mysql_query("UPDATE products 
        SET qty=qty-$c
		WHERE product_id='$b' AND empresa_id = $sesionEmpresaID");
//echo "UPDATE products SET qty=qty-$c WHERE product_id='$b'";

$fffffff=$asasa-$discount;
$d=$fffffff*$c;
$profit=$p*$c;
// query
$result = mysql_query("INSERT INTO sales_order (invoice,product,qty,amount,name,price,profit,product_code,gen_name,date) VALUES ('$a','$b','$c','$d','$name','$asasa','$profit','$code','$gen','$date')");

//echo "INSERT INTO sales_order (invoice,product,qty,amount,name,price,profit,product_code,gen_name,date) VALUES ('$a','$b','$c','$d','$name','$asasa','$profit','$code','$gen','$date')";

header("location: ventas.php?id=$w&invoice=$a");


?>