<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySneakers</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>

<header>
        <nav class="flex flex-wrap items-center justify-between w-full  py-8 text-lg text-gray-700 px-20">
          <div>
            <a href="index.php">
            <p class="font-semibold text-xl">MySneakers</p>
            </a>
          </div>
            
        <div class="hidden w-full md:flex md:items-center md:w-auto" >
        <ul class="menu">
      <li>
        <a href="#">Products</a>
        <ul class="sub-menu">
          <li><a href="all_products.php">All</a></li>
          <li>
            <a href="#">Brands</a>
            <ul class="sub-sub-menu">
              <li>
                <a href="all_products.php">All</a>
              </li>
              <li>
                <a href="jordans.php">Jordans</a>
              </li>
              <li>
                <a href="nike.php">Nike</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    <li><a href="login.php#">Login</a></li>
    <li><a href="logout.php#">Logout</a></li>
    <li><a href="cart.php#">Cart</a></li>
  </ul>
            </div>
        </nav>
      </header>

    <div class="bg-gray-100">
      
    <div class="grid grid-cols-5 gap-4 max-w-7xl md:ml-28 pl-8 pr-8 pt-32 md:pt-64">
  <div class="col-span-4"> 
  <h1 class="text-4xl md:text-5xl font-bold mb-5">// All Products</h1>
  </div>
</div></div>

    <div class=" max-w-8xl md:ml-28 md:mr-28 pl-8 pr-8">
    <!-- <div class=" mx-28 px-8"> -->
        <br/>
            <div class='grid grid-cols-1 md:grid-cols-4 gap-10'>
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

                while($row = $result->fetch_assoc()){
                    echo "

                    
                    <div>
                        <img src=$row[main_image] alt=$row[title] className='h-96 w-full object-cover object-center group-hover:opacity-75'/>
                   
                <h3 className='mt-4 text-sm text-gray-700'>$row[title]</h3>
                <p className='mt-1 text-lg font-medium text-gray-900'>$row[price] DKK.</p>
                <form method='POST' action='cart.php'>
                <input type='hidden' name='product_id' value='$row[id]'>
                <input type='hidden' name='product_title' value='$row[title]'>
                <input type='hidden' name='product_price' value='$row[price]'>
                <button type='submit' class='border-2 rounded-md px-3 py-2 border border-black text-lg mt-3'>Add to Cart</button>
                </form>
                </div> 
                    ";
                }
                ?>
</div>
            
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



    <script src="main.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
            <script>
                AOS.init(duration= 3000);
              </script>
</body>
</html>