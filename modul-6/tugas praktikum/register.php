<?php
include 'config/koneksi.php';

$errorNama = "";
$errorUsername = "";
$errorPassword = "";
$success = "";

$nama = "";
$username = "";

if (isset($_POST['register'])) {

    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $passwordInput = $_POST['password'];

    $role = "user";

    if ($nama == "") {
        $errorNama = "Nama wajib diisi";
    }

    if (strlen($passwordInput) < 6) {
        $errorPassword = "Password minimal 6 karakter";
    }

    $cek = $conn->prepare(
        "SELECT id FROM users WHERE username = ?"
    );

    $cek->bind_param("s", $username);
    $cek->execute();

    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        $errorUsername = "Username sudah digunakan";
    }

    if (
        empty($errorNama) &&
        empty($errorUsername) &&
        empty($errorPassword)
    ) {

        $password = password_hash(
            $passwordInput,
            PASSWORD_DEFAULT
        );

        $query = $conn->prepare(
            "INSERT INTO users (nama, username, password, role)
            VALUES (?, ?, ?, ?)"
        );

        $query->bind_param(
            "ssss",
            $nama,
            $username,
            $password,
            $role
        );

        if ($query->execute()) {

            header("Location: register.php?success=1");
            exit;

        } else {
            $errorUsername = "Register gagal";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="bg-white p-8 rounded shadow w-96">

        <h1 class="text-2xl font-bold mb-4 text-center">
            Register
        </h1>

        <?php if (isset($_GET['success'])) : ?>

            <div class="bg-green-100 text-green-700 p-2 rounded mb-3 text-sm">
                Register berhasil
            </div>

        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">

                <input
                    type="text"
                    name="nama"
                    placeholder="Nama"
                    class="w-full border p-2 rounded"
                    value="<?php echo htmlspecialchars($nama); ?>"
                    required>

                <?php if (!empty($errorNama)) : ?>

                    <p class="text-red-500 text-sm mt-1">
                        <?php echo $errorNama; ?>
                    </p>

                <?php endif; ?>

            </div>

            <div class="mb-3">

                <input
                    type="text"
                    name="username"
                    placeholder="Username"
                    class="w-full border p-2 rounded"
                    value="<?php echo htmlspecialchars($username); ?>"
                    required>

                <?php if (!empty($errorUsername)) : ?>

                    <p class="text-red-500 text-sm mt-1">
                        <?php echo $errorUsername; ?>
                    </p>

                <?php endif; ?>

            </div>

            <div class="mb-3">

                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    class="w-full border p-2 rounded"

                    required>

                <?php if (!empty($errorPassword)) : ?>

                    <p class="text-red-500 text-sm mt-1">
                        <?php echo $errorPassword; ?>
                    </p>

                <?php endif; ?>

            </div>

            <button
                type="submit"
                name="register"
                class="bg-blue-500 hover:bg-blue-600 text-white w-full p-2 rounded">

                Register

            </button>

        </form>

        <p class="mt-3 text-center text-sm">
            Sudah punya akun?

            <a href="login.php" class="text-blue-500">
                Login
            </a>
        </p>

    </div>

</body>

</html>