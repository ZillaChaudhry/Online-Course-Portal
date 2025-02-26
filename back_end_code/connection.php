<?php
$server = "localhost";
$name = "root";
$password = "";
$db = "indian_premium";

$con=new mysqli($server,$name,$password,$db);
if($con)
{

}
else
{
    echo $con->error;
}
?>