<?php 
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'php_webshop_database';
 
$connection = new mysqli($servername, $username, $password, $database);

$id =  "";
$title =  "";
$brand =  "";
$descr =  "";
$price =  "";
$main_image =  "";

$errorMessage = "";

$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] = 'GET'){
    if (!isset($_GET["id"])){
        header("location: /php-webshop/index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row){
        header("location: /php-webshop/index.php");
        exit;
    }

    $title = $row["title"];
    $brand = $row["brand"];
    $descr = $row["descr"];
    $price = $row["price"];
    $main_image = $row["main_image"];
} else {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $brand = $_POST["brand"];
    $descr = $_POST["descr"];
    $price = $_POST["price"];
    $main_image = $_POST["main_image"];

    do{
        if (empty($id) || empty($title) || empty($brand) || empty($descr) || empty($price) || empty($main_image) ) {
            $errorMessage = "All fields are required";
            break;
        }

        $sql = "UPDATE products" .
                "SET title = '$title', brand = '$brand', descr = '$descr', price = '$price', main_image = '$main_image'" .
                "WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result){
            $errorMessage = "Invalid query" . $connection->error;
            break;}

            $successMessage = "The product has now been updated";

            header("location: /php-webshop/index.php");
            exit;

    } while (false);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="max-w-6xl mx-auto">
        <h1>New Product</h1>

        <?php
        if (!empty($errorMessage)){
            echo "
            <p>$errorMessage</p>";
        }
        ?>

        <form  method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
            title
            </label>
            <input id="title" name="title" value="<?php echo $title; ?>" type="text" placeholder="title" class="shadow appearance-none border rounded w-6/9 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="brand">
            brand
            </label>
            <input id="brand" name="brand" value="<?php echo $brand; ?>" type="text" placeholder="brand" class="shadow appearance-none border rounded w-6/9 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="descr">
            descr
            </label>
            <input id="descr" name="descr" value="<?php echo $descr; ?>" type="text" placeholder="descr" class="shadow appearance-none border rounded w-6/9 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
            price
            </label>
            <input id="price" name="price" value="<?php echo $price; ?>" type="text" placeholder="price" class="shadow appearance-none border rounded w-6/9 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="main_image">
            main_image
            </label>
            <input id="main_image" name="main_image" value="<?php echo $main_image; ?>" type="text" placeholder="main_image" class="shadow appearance-none border rounded w-6/9 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <?php 
        if ( !empty($successMessage)){
            echo "
            <p>$successMessage</p>
            ";
        }
        ?>

        <div>
            <button type="submit" class="bg-blue-500 py-2 px-3">submit</button>
            <button class="bg-blue-500 py-2 px-3" href="/php-webshop/index.php" role="button">cancel</button>
        </div>
        </form>
    </div>
</body>
</html>