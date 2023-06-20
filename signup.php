<?php
session_start();
if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}
if (isset($_POST["signup"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    if ($password != $confirm_password) {
        $error = "Password and confirm password do not match.";
    } else {
        $conn = mysqli_connect("localhost", "root", "", "php_webshop_database");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (name, email, address, phone_number, password) VALUES ('$name','$email', '$address', '$phone_number', '$password')";
        mysqli_query($conn, $query);
        header("Location: login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 mt-36">
    <div class="max-w-md mx-auto my-12 bg-white p-8 border border-gray-300 shadow-md">
        <h1 class="text-xl font-medium mb-6 text-center">Sign Up</h1>
        <?php if (isset($error)) { echo "<p class='text-red-500 mb-4'>$error</p>"; } ?>
        <form method="post">
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="name">Name</label>
                <input class="border border-gray-300 p-2 w-full rounded-md" type="text" name="name" id="name" placeholder="Name" required pattern="[A-Za-z]+">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
                <input class="border border-gray-300 p-2 w-full rounded-md" type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="address">Address</label>
                <input class="border border-gray-300 p-2 w-full rounded-md" type="address" name="address" id="address" placeholder="Address" required pattern="[A-Za-z0-9 ,]+">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="phone_number">Phone Number</label>
                <input class="border border-gray-300 p-2 w-full rounded-md" type="tel" name="phone_number" id="phone_number" placeholder="Phone Number" required pattern="[0-9]{8}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="password">Password</label>
                <input class="border border-gray-300 p-2 w-full rounded-md" type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2" for="confirm_password">Confirm Password</label>
                <input class="border border-gray-300 p-2 w-full rounded-md" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
            </div>
            <div class="flex items-center justify-between">
                <button class="border-2 rounded-full px-3 py-2 border border-black text-lg hover:text-white hover:bg-black" type="submit" name="signup">Sign Up</button>
                <a class="text-blue-500 hover:text-blue-600 font-medium" href="login.php">Already have an account?</a>
            </div>
        </form>
    </div>
</body>
</html>
