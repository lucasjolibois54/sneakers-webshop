<?php 

if (isset($_GET["id"])){
    $id = $_GET["id"];


    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'php_webshop_database';
    
    
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM products WHERE id=$id";
    $connection->query($sql);
}

header("location: /php-webshop/admin_login.php");
exit;
?>