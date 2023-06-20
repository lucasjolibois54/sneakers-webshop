<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'php_webshop_database';
 
$connection = new mysqli($servername, $username, $password, $database);

$title =  "";
$brand =  "";
$descr =  "";
$price =  "";
$main_image =  "";

$errorMessage = "";

$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $title =  $_POST["title"];
    $brand =  $_POST["brand"];
    $descr =  $_POST["descr"];
    $price =  $_POST["price"];
    $main_image =  $_POST["main_image"];

    do {
        if (empty($title) || empty($brand) || empty($descr) || empty($price) || empty($main_image) ) {
            $errorMessage = "All fields are required";
            break;
        }

        $sql = "INSERT INTO products (title, brand, descr, price, main_image)" .
                "VALUES ('$title', '$brand', '$descr', '$price', '$main_image')";
        $result = $connection->query($sql);

        if (!$result){
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }

        $title =  "";
        $brand =  "";
        $descr =  "";
        $price =  "";
        $main_image =  "";

        $successMessage = "The product has now been added";

        header("location: /php-webshop/admin.php");
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
    <title>Create</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Create a New Product</h1>
    
    <?php
    if (!empty($errorMessage)){
        echo "<p class='text-red-500 mb-4'>$errorMessage</p>";
    }
    ?>

    <form class="max-w-lg mx-auto" method="post">
      <div class="mb-4">
        <label class="block font-bold mb-2 text-gray-700" for="title">Title</label>
        <input id="title" name="title" value="<?php echo $title; ?>" type="text" placeholder="Enter the title" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
      </div>
      
      <div class="mb-4">
        <label class="block font-bold mb-2 text-gray-700" for="brand">Brand</label>
        <input id="brand" name="brand" value="<?php echo $brand; ?>" type="text" placeholder="Enter the brand" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
      </div>
      
      <div class="mb-4">
        <label class="block font-bold mb-2 text-gray-700" for="descr">Description</label>
        <textarea id="descr" name="descr" placeholder="Enter the description" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300"><?php echo $descr; ?></textarea>
      </div>
      
      <div class="mb-4">
        <label class="block font-bold mb-2 text-gray-700" for="price">Price</label>
        <input id="price" name="price" value="<?php echo $price; ?>" type="text" placeholder="Enter the price" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
      </div>
      
      <div class="mb-4">
        <label class="block font-bold mb-2 text-gray-700" for="main_image">Main Image URL</label>
        <input id="main_image" name="main_image" value="<?php echo $main_image; ?>" type="text" placeholder="Enter the URL of the main image" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
      </div>
      
      <?php 
      if ( !empty($successMessage)){
          echo "<p class='text-green-500 mb-4'>$successMessage</p>";
      }
      ?>

      <div class="flex justify-end">
        <button type="submit" class="bg-blue-500 py-2 px-4 text-white rounded-lg font-bold">
          Create Product
        </button>
        <a href="/php-webshop/admin.php" class="bg-gray-400 py-2 px-4 text-white rounded-lg font-bold ml-4">
          Cancel
        </a>
      </div>
    </form>
  </div>
</body>


</html>