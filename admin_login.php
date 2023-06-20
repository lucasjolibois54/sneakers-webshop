<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: admin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $conn = mysqli_connect("localhost", "root", "", "php_webshop_database");
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    if ($user && password_verify($password, $user["password"])) {
       // $_SESSION["user_id"] = $user["id"];
        if ($user["email"] == "admin@admin.com") {
            header("Location: admin.php");
            exit;
        } else {
            $error = "Restricted Area: You are not an admin!";
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 mt-36">
    <div class="max-w-md mx-auto my-16 bg-white p-8 rounded-md shadow-md">
        <h1 class="text-2xl text-center mb-4 font-bold">Admin Login</h1>
        <?php if (isset($error)) { echo "<p class='text-red-500 mb-4'>$error</p>"; } ?>
        <form method="post" class="space-y-4">
            <div class="flex flex-col">
                <label for="email" class="text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required class="border-2 border-gray-300 p-2 rounded-md">
            </div>
            <div class="flex flex-col">
                <label for="password" class="text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required class="border-2 border-gray-300 p-2 rounded-md">
            </div>
            <button type="submit" class="border-2 rounded-full px-3 py-2 border border-black text-lg  hover:text-white hover:bg-black">Login</button>
        </form>
    </div>
</body>
</html>
