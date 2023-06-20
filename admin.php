<?php
session_start();

if (isset($_SERVER['HTTP_REFERER']) && 
   (strpos($_SERVER['HTTP_REFERER'], 'http://localhost/php-webshop/admin_login.php') !== false ||
    strpos($_SERVER['HTTP_REFERER'], 'http://localhost/php-webshop/login.php') !== false ||
    strpos($_SERVER['HTTP_REFERER'], 'http://localhost/php-webshop/edit.php') !== false ||
    strpos($_SERVER['HTTP_REFERER'], 'http://localhost/php-webshop/delete.php') !== false ||
    strpos($_SERVER['HTTP_REFERER'], 'http://localhost/php-webshop/create.php') !== false)) {
} else {
    echo "Restricted Area: requires authentication";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySneakers</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
    <div class="max-w-6xl mx-auto">
        <h1 class="my-20 text-3xl text-center font-bold">Admin Dashboard</h1>
        <div class="flex justify-end mb-5">
            <a class="bg-blue-500 py-2 px-3 rounded-md text-white font-semibold mr-3" href="/php-webshop/create.php">New Product</a>
            <a class="bg-red-500 py-2 px-3 rounded-md text-white font-semibold" href="/php-webshop/logout.php">Logout</a>
        </div>
        <table class="border-collapse border border-gray-400 bg-white shadow-lg">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-400">
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Title</th>
                    <th class="p-3 text-left">Brand</th>
                    <th class="p-3 text-left">Description</th>
                    <th class="p-3 text-left">Price</th>
                    <th class="p-3 text-left">Main Image</th>
                    <th class="p-3 text-left">Created At</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $servername = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'php_webshop_database';
            
            $connection = new mysqli($servername, $username, $password, $database);

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM products";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            $num_products = mysqli_num_rows($result);

            echo "<h2 class='my-5'>Total Products: $num_products</h2>";

            while($row = $result->fetch_assoc()){
                echo "
                <tr class='border-b border-gray-400 hover:bg-gray-100'>
                <td class='p-3'>$row[id]</td>
                <td class='p-3'>$row[title]</td>
                <td class='p-3'>$row[brand]</td>
                <td class='p-3'>$row[descr]</td>
                <td class='p-3'>$row[price]</td>
                <td class='p-3'><img class='h-12' src='$row[main_image]'></td>
                <td class='p-3'>$row[created_at]</td>
                <td class='p-3'>
                    <div class='my-5'><a class='bg-blue-500 py-2 px-3 rounded-md text-white font-semibold mr-3' href='/php-webshop/edit.php?id=$row[id]'>Edit</a></div>
                    <div class='my-5'><a class='bg-red-500 py-2 px-3 rounded-md text-white font-semibold mt-4' href='/php-webshop/delete.php?id=$row[id]'>Delete</a></div>
                </td>
                </tr>
                ";
            }
            ?>

        </tbody>
    </table>
</div>
<footer class="bg-black text-white py-8 mt-36">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-wrap justify-between">
      <div class="w-full lg:w-1/3 mb-8 lg:mb-0">
        <h2 class="text-lg font-bold mb-4">About Us</h2>
        <p class="mb-4 pr-8">We are a leading online sneaker store, offering the latest sneakers from top brands at competitive prices.</p>
        <p><a href="#" class="text-blue-500 hover:text-blue-300">Learn More &rarr;</a></p>
      </div>
      <div class="w-full lg:w-1/3 mb-8 lg:mb-0">
        <h2 class="text-lg font-bold mb-4">Contact Us</h2>
        <p class="mb-4">123 Main Street<br>Anytown, USA 12345<br>Phone: (123) 456-7890</p>
        <p><a href="#" class="text-blue-500 hover:text-blue-300">Send Us a Message &rarr;</a></p>
      </div>
      <div class="w-full lg:w-1/3 mb-8 lg:mb-0">
        <h2 class="text-lg font-bold mb-4">Follow Us</h2>
        <p class="mb-4">Stay up to date with our latest news and promotions.</p>
        <div class="flex">
          <a href="index.php" class="text-white hover:text-blue-300 mr-4">Home</i></a>
          <a href="all_products.php" class="text-white hover:text-blue-300 mr-4">All Products</a>
          <a href="admin_login.php" class="text-white hover:text-blue-300 mr-4">Admin Login</a>
          <a href="admin.php" class="text-white hover:text-blue-300">Admin</a>
        </div>
      </div>
    </div>
    <div class="border-t border-gray-700 mt-8 pt-8 text-sm text-center">
      <p>&copy; 2023 MySneakers. All rights reserved.</p>
    </div>
  </div>
</footer>
</body>

</html>
