

<?php 
session_start();

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'php_webshop_database';


$connection = new mysqli($servername, $username, $password, $database);


if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$id = "";
$title = "";
$brand = "";
$descr = "";
$price = "";
$main_image = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /php-webshop/admin.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $connection->query($sql);

    if ($result->num_rows == 0) {
        header("location: /php-webshop/admin.php");
        exit;
    }

    $row = $result->fetch_assoc();
    $title = $row["title"];
    $brand = $row["brand"];
    $descr = $row["descr"];
    $price = $row["price"];
    $main_image = $row["main_image"];

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $brand = $_POST["brand"];
    $descr = $_POST["descr"];
    $price = $_POST["price"];
    $main_image = $_POST["main_image"];

    if (empty($id) || empty($title) || empty($brand) || empty($descr) || empty($price) || empty($main_image)) {
        $errorMessage = "All fields are required";
    } else {
        $sql = "UPDATE products SET title='$title', brand='$brand', descr='$descr', price='$price', main_image='$main_image' WHERE id=$id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $successMessage = "The product has now been updated";
            header("location: /php-webshop/admin.php");
            exit;
        }
    }
}


$connection->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="my-10 text-3xl text-center font-bold">Edit Product</h1>

        <?php
        if (!empty($errorMessage)){
            echo "
            <p class='text-red-500'>$errorMessage</p>";
        }
        ?>

        <form  method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
            Title
            </label>
            <input id="title" name="title" value="<?php echo $title; ?>" type="text" placeholder="Title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="brand">
            Brand
            </label>
            <input id="brand" name="brand" value="<?php echo $brand; ?>" type="text" placeholder="Brand" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="descr">
            Description
            </label>
            <textarea id="descr" name="descr" placeholder="Description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo $descr; ?></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
            Price
            </label>
            <input id="price" name="price" value="<?php echo $price; ?>" type="text" placeholder="Price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="main_image">
            Main Image
            </label>
            <input id="main_image" name="main_image" value="<?php echo $main_image; ?>" type="text" placeholder="Main Image URL" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <?php 
        if ( !empty($successMessage)){
            echo "
            <p class='text-green-500'>$successMessage</p>
            ";
        }
        ?>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Submit</button>
            <a class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded" href="/php-webshop/admin.php" role="button">Cancel</a>
</div>
</form>
</div>

</body>
</html>