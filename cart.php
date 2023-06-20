<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (isset($_POST['product_id']) && isset($_POST['product_title']) && isset($_POST['product_price'])) {
    $product_id = $_POST['product_id'];
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $_SESSION['cart'][] = array('id' => $product_id, 'title' => $product_title, 'price' => $product_price, 'quantity' => 1);
    header('Location: cart.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="max-w-6xl mx-auto">
        <div class=" mt-20">
        <h1 class="my-8 text-3xl font-bold text-center">Cart</h1>
        </div>

        <?php
        if (empty($_SESSION['cart'])) {
            echo "<p class='text-gray-700'>Your cart is empty</p>";
        } else {
            $total_price = 0;
            foreach ($_SESSION['cart'] as $item) {
                $total_price += ($item['price'] * $item['quantity']);
                echo "
                <div class='flex justify-between items-center my-4'>
                    <div>
                        <p class='text-gray-700'>$item[title]</p>
                        <p class='text-gray-700'>$item[price] DKK</p>
                    </div>
                    <div class='flex items-center'>
                        <form action='cart.php' method='POST'>
                            <input type='hidden' name='update_id' value='$item[id]'>
                            <input type='number' name='product_quantity' value='$item[quantity]' min='1' class='border border-gray-400 rounded-lg w-20 py-2 px-3 mr-4'>
                            <button type='submit' name='update_quantity' class='text-white bg-blue-500 hover:bg-blue-700 rounded-lg py-2 px-4'>Update</button>
                        </form>
                        <form action='cart.php' method='POST'>
                            <input type='hidden' name='remove_id' value='$item[id]'>
                            <button type='submit' name='remove_item' class='text-white bg-red-500 hover:bg-red-700 rounded-lg py-2 px-4 ml-4'>Remove</button>
                        </form>
                    </div>
                </div>
                ";
            }
            echo "
            <hr class='my-4'>
            <div class='flex justify-between items-center my-4'>
                <p class='text-gray-700 font-bold'>Total:</p>
                <p class='text-gray-700 font-bold'>$total_price DKK</p>
            </div>
            ";
        }
        ?>

        <?php
        if (isset($_POST['update_quantity']) && isset($_POST['update_id'])) {
            $update_id = $_POST['update_id'];
            $new_quantity = $_POST['product_quantity'];
            foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] === $update_id) {
            $item['quantity'] = $new_quantity;
            }
            }
            }
            if (isset($_POST['remove_item']) && isset($_POST['remove_id'])) {
            $remove_id = $_POST['remove_id'];
            foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['id'] === $remove_id) {
            unset($_SESSION['cart'][$index]);
            }
            }
            }
            ?>
    <div class="flex justify-end mt-8">
        <a href="all_products.php" class="border-2 rounded-md px-3 py-2 border border-black text-lg mt-3 hover:text-white hover:bg-black">Continue Shopping</a>
       
    </div>
</div>
</body>
</html>