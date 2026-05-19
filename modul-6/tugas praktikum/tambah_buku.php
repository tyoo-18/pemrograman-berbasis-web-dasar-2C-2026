<?php
include 'config/auth.php';
include 'config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: dashboard.php");
    exit;
}

$errorTahun = "";
$errorStok = "";

$judul = "";
$penulis = "";
$penerbit = "";
$tahun = "";
$stok = "";

if (isset($_POST['simpan'])) {

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

        $query = $conn->prepare(
            "INSERT INTO buku
            (judul, penulis, penerbit, tahun_terbit, stok)
            VALUES (?, ?, ?, ?, ?)"
        );

        $query->bind_param(
            "sssii",
            $judul,
            $penulis,
            $penerbit,
            $tahun,
            $stok
        );

        if ($query->execute()) {

            header("Location: dashboard.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-5">

        <div class="bg-white p-5 rounded shadow max-w-lg mx-auto">

            <h1 class="text-2xl font-bold mb-4">
                Tambah Buku
            </h1>

            <form method="POST">

                <!-- judul -->
                <div class="mb-3">

                    <input
                        type="text"
                        name="judul"
                        placeholder="Judul Buku"
                        class="w-full border p-2 rounded"

                        value="<?php echo htmlspecialchars($judul); ?>"

                        required>

                </div>

                <!-- penulis -->
                <div class="mb-3">

                    <input
                        type="text"
                        name="penulis"
                        placeholder="Penulis"
                        class="w-full border p-2 rounded"

                        value="<?php echo htmlspecialchars($penulis); ?>"

                        required>

                </div>

                <!-- penerbit -->
                <div class="mb-3">

                    <input
                        type="text"
                        name="penerbit"
                        placeholder="Penerbit"
                        class="w-full border p-2 rounded"

                        value="<?php echo htmlspecialchars($penerbit); ?>"

                        required>

                </div>

                <div class="mb-3">

                    <input
                        type="number"
                        name="tahun"
                        placeholder="Tahun Terbit"
                        class="w-full border p-2 rounded"

                        value="<?php echo htmlspecialchars($tahun); ?>"

                        required>

                    <?php if (!empty($errorTahun)) : ?>

                        <p class="text-red-500 text-sm mt-1">
                            <?php echo $errorTahun; ?>
                        </p>

                    <?php endif; ?>

                </div>

                <div class="mb-3">

                    <input
                        type="number"
                        name="stok"
                        placeholder="Stok"
                        class="w-full border p-2 rounded"

                        value="<?php echo htmlspecialchars($stok); ?>"

                        required>

                    <?php if (!empty($errorStok)) : ?>

                        <p class="text-red-500 text-sm mt-1">
                            <?php echo $errorStok; ?>
                        </p>

                    <?php endif; ?>

                </div>

                <button
                    type="submit"
                    name="simpan"
                    class="bg-blue-500 text-white px-4 py-2 rounded">

                    Simpan

                </button>

            </form>

        </div>

    </div>

</body>

</html>