<?php
include 'config/auth.php';
include 'config/koneksi.php';

$data = $conn->query("SELECT * FROM buku");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-5">

        <div class="flex justify-between items-center mb-5">
            <div>
                <h1 class="text-3xl font-bold">Sistem Perpustakaan</h1>
                <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['nama']); ?></p>
            </div>

            <a href="logout.php"
                class="bg-red-500 text-white px-4 py-2 rounded">
                Logout
            </a>
        </div>

        <?php if ($_SESSION['role'] == 'admin') : ?>

            <a href="tambah_buku.php"
                class="bg-blue-500 text-white px-4 py-2 rounded inline-block mb-4">
                Tambah Buku
            </a>

        <?php endif; ?>

        <div class="bg-white p-5 rounded shadow">

            <table class="w-full border">
                <tr class="bg-gray-200">
                    <th class="border p-2">No</th>
                    <th class="border p-2">Judul</th>
                    <th class="border p-2">Penulis</th>
                    <th class="border p-2">Penerbit</th>
                    <th class="border p-2">Tahun</th>
                    <th class="border p-2">Stok</th>
                    <th class="border p-2">Aksi</th>
                </tr>

                <?php
                $no = 1;
                while ($row = $data->fetch_assoc()) :
                ?>

                    <tr>
                        <td class="border p-2"><?php echo $no++; ?></td>
                        <td class="border p-2"><?php echo htmlspecialchars($row['judul']); ?></td>
                        <td class="border p-2"><?php echo htmlspecialchars($row['penulis']); ?></td>
                        <td class="border p-2"><?php echo htmlspecialchars($row['penerbit']); ?></td>
                        <td class="border p-2"><?php echo htmlspecialchars($row['tahun_terbit']); ?></td>
                        <td class="border p-2"><?php echo htmlspecialchars($row['stok']); ?></td>

                        <td class="border p-2">

                            <?php if ($_SESSION['role'] == 'admin') : ?>

                                <a href="edit_buku.php?id=<?php echo $row['id']; ?>"
                                    class="bg-yellow-400 px-3 py-1 rounded text-white mr-4">
                                    Edit
                                </a>

                                <a href="hapus_buku.php?id=<?php echo $row['id']; ?>"
                                    onclick="return confirm('Yakin hapus data?')"
                                    class="bg-red-500 px-3 py-1 rounded text-white">
                                    Hapus
                                </a>

                            <?php else : ?>

                                <span class="text-gray-500">Hanya lihat</span>

                            <?php endif; ?>

                        </td>
                    </tr>

                <?php endwhile; ?>

            </table>

        </div>

    </div>

</body>

</html>