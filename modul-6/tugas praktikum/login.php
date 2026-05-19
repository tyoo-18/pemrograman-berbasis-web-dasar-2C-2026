<?php
session_start();
include 'config/koneksi.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();

    $result = $query->get_result();

    if ($result->num_rows > 0) {

        $data = $result->fetch_assoc();

        if (password_verify($password, $data['password'])) {

            $_SESSION['login'] = true;
            $_SESSION['id'] = $data['id'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['role'] = $data['role'];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "Username tidak ditemukan";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="bg-white p-8 rounded shadow w-96">

        <h1 class="text-2xl font-bold mb-4 text-center">Login</h1>

        <?php if (isset($error)) : ?>
            <p class="text-red-500 text-sm mb-3"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if (isset($success)) : ?>
            <p class="text-green-500 text-sm mb-3"><?php echo $success; ?></p>
        <?php endif; ?>

        <form method="POST">

            <input type="text" name="username" placeholder="Username"
                class="w-full border p-2 mb-3 rounded" required>

            <input type="password" name="password" placeholder="Password"
                class="w-full border p-2 mb-3 rounded" required>

            <button type="submit" name="login"
                class="bg-green-500 text-white w-full p-2 rounded">
                Login
            </button>

        </form>

        <p class="mt-3 text-center">
            Belum punya akun?
            <a href="register.php" class="text-blue-500">Register</a>
        </p>

    </div>

</body>

</html>