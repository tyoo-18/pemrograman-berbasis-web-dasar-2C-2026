<?php
include 'config/auth.php';
include 'config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

$query = $conn->prepare(
    "SELECT * FROM buku WHERE id = ?"
);

$query->bind_param("i", $id);
$query->execute();

$result = $query->get_result();
$buku = $result->fetch_assoc();

$errorTahun = "";
$errorStok = "";

if (isset($_POST['update'])) {

    $judul = trim($_POST['judul']);
    $penulis = trim($_POST['penulis']);
    $penerbit = trim($_POST['penerbit']);
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    if ($tahun <= 0) {

        $errorTahun = "Tahun tidak boleh 0";
    } elseif ($tahun < 1900) {

        $errorTahun = "Tahun minimal 1900";
    } elseif ($tahun > 2026) {

        $errorTahun = "Tahun maksimal 2026";
    } 

    if ($stok < 0) {

        $errorStok = "Stok tidak boleh minus";
    }

    if (
        empty($errorTahun) &&
        empty($errorStok)
    ) {

        $update = $conn->prepare(
            "UPDATE buku SET
            judul = ?,
            penulis = ?,
            penerbit = ?,
            tahun_terbit = ?,
            stok = ?
            WHERE id = ?"
        );

        $update->bind_param(
            "sssiii",
            $judul,
            $penulis,
            $penerbit,
            $tahun,
            $stok,
            $id
        );

        if ($update->execute()) {

            header("Location: dashboard.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-5">

        <div class="bg-white p-5 rounded shadow max-w-lg mx-auto">

            <h1 class="text-2xl font-bold mb-4">
                Edit Buku
            </h1>

            <form method="POST">

                <!-- judul -->
                <div class="mb-3">

                    <input
                        type="text"
                        name="judul"
                        class="w-full border p-2 rounded"

                        value="<?php
                                echo htmlspecialchars(
                                    isset($_POST['judul'])
                                        ? $_POST['judul']
                                        : $buku['judul']
                                );
                                ?>"

                        required>

                </div>

                <div class="mb-3">

                    <input
                        type="text"
                        name="penulis"
                        class="w-full border p-2 rounded"

                        value="<?php
                                echo htmlspecialchars(
                                    isset($_POST['penulis'])
                                        ? $_POST['penulis']
                                        : $buku['penulis']
                                );
                                ?>"

                        required>

                </div>

                <div class="mb-3">

                    <input
                        type="text"
                        name="penerbit"
                        class="w-full border p-2 rounded"

                        value="<?php
                                echo htmlspecialchars(
                                    isset($_POST['penerbit'])
                                        ? $_POST['penerbit']
                                        : $buku['penerbit']
                                );
                                ?>"

                        required>

                </div>

                <!-- tahun -->
                <div class="mb-3">

                    <input
                        type="number"
                        name="tahun"
                        class="w-full border p-2 rounded"

                        value="<?php
                                echo htmlspecialchars(
                                    isset($_POST['tahun'])
                                        ? $_POST['tahun']
                                        : $buku['tahun_terbit']
                                );
                                ?>"

                        required>

                    <?php if (!empty($errorTahun)) : ?>

                        <p class="text-red-500 text-sm mt-1">
                            <?php echo $errorTahun; ?>
                        </p>

                    <?php endif; ?>

                </div>

                <!-- stok -->
                <div class="mb-3">

                    <input
                        type="number"
                        name="stok"
                        class="w-full border p-2 rounded"

                        value="<?php
                                echo htmlspecialchars(
                                    isset($_POST['stok'])
                                        ? $_POST['stok']
                                        : $buku['stok']
                                );
                                ?>"

                        required>

                    <?php if (!empty($errorStok)) : ?>

                        <p class="text-red-500 text-sm mt-1">
                            <?php echo $errorStok; ?>
                        </p>

                    <?php endif; ?>

                </div>

                <button
                    type="submit"
                    name="update"
                    class="bg-yellow-500 text-white px-4 py-2 rounded">

                    Update

                </button>

            </form>

        </div>

    </div>

</body>

</html>