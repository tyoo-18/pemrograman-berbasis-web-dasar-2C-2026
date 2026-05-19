<?php

$artikel = [
    "html-pertama" => [
        "judul"   => "Belajar HTML Pertama Kali",
        "tanggal" => "15 Agustus 2022",
        "isi"     => "Masih ingat banget pertama kali buka W3Schools dan nyoba nulis tag HTML. Bingung kenapa harus ada tag buka dan tutup. Tapi waktu teks pertama muncul di browser, rasanya luar biasa! Dari sini saya mulai paham bahwa coding itu soal logika, bukan hafalan.",
        "gambar"  => "img/Screenshot 2026-03-31 193015.png",
        "link"    => "https://www.w3schools.com/html/"
    ],
    "error-pertama" => [
        "judul"   => "Error Pertama yang Bikin Panik",
        "tanggal" => "3 September 2022",
        "isi"     => "Waktu belajar CSS, satu jam lebih bingung kenapa style-nya nggak jalan. Ternyata cuma typo nama class satu huruf! Pelajaran penting: baca pesan error dengan teliti, dan gunakan DevTools browser untuk debug. Sejak itu saya nggak takut lagi sama error.",
        "gambar"  => "img/error.png",
        "link"    => "https://developer.mozilla.org/en-US/docs/Learn/CSS/Building_blocks/Debugging_CSS"
    ],
    "php-database" => [
        "judul"   => "Pertama Kali Konek PHP ke Database",
        "tanggal" => "20 Februari 2024",
        "isi"     => "Semester 3, tugas pertama pakai MySQL. Waktu data dari form HTML berhasil tersimpan di phpMyAdmin, rasanya seperti sulap. Momen itu benar-benar mengubah cara pandang saya soal web. Ternyata website bisa menyimpan dan mengolah data sungguhan!",
        "gambar"  => "img/Cuplikan layar 2024-01-03 195914.png",
        "link"    => "https://www.php.net/manual/en/book.mysqli.php"
    ],
    "proyek-pertama" => [
        "judul"   => "Proyek Web Pertama yang Selesai",
        "tanggal" => "10 Januari 2025",
        "isi"     => "Akhirnya berhasil selesaikan proyek web pertama untuk UAS: toko online mini dengan PHP dan MySQL. Masih banyak kekurangannya, tapi berhasil jalan dari awal sampai akhir. Pengalaman ini ngajarin saya bahwa 'selesai' lebih penting daripada 'sempurna' untuk pemula.",
        "gambar"  => "img/Screenshot (186).png",
        "link"    => "https://phptherightway.com/"
    ],
    "laravel-pertama" => [
        "judul"   => "Shock Culture Belajar Laravel",
        "tanggal" => "5 Maret 2025",
        "isi"     => "Pertama buka dokumentasi Laravel, langsung pusing: MVC, Eloquent, Artisan, Middleware... banyak banget! Tapi setelah dipelajari pelan-pelan, akhirnya ngerti kenapa framework itu ada. Laravel bikin kerja lebih rapi dan cepat. Perjalanan dari PHP biasa ke framework terasa naik kelas.",
        "gambar"  => "img/Screenshot (132).png",
        "link"    => "https://laravel.com/docs"
    ],
];

$kutipan = [
    "Setiap expert pernah jadi pemula. Jangan takut mulai!",
    "Code yang buruk hari ini lebih baik dari tidak ada code.",
    "Error bukan musuh, error adalah guru terbaik programmer.",
    "Belajar programming itu marathon, bukan sprint.",
    "Satu bug yang kamu fix = satu langkah makin paham.",
];

$kutipanAcak = $kutipan[array_rand($kutipan)];

$artikelDipilih = null;

if (isset($_GET['artikel']) && array_key_exists($_GET['artikel'], $artikel)) {
    $artikelDipilih = $_GET['artikel'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Blog Developer - Rahmad Bagus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 30px auto;
            padding: 0 20px;
            background: #f2f2f2;
        }

        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #0055aa;
            font-weight: bold;
        }
        nav { background: #ddd; padding: 10px; margin-bottom: 20px; }

        h1 { color: #222; }
        h2 { color: #444; border-bottom: 2px solid #aaa; padding-bottom: 5px; }

        .wrapper {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .sidebar {
            width: 220px;
            min-width: 220px;
            background: white;
            border: 1px solid #ccc;
            padding: 15px;
        }

        .sidebar h3 { margin-top: 0; color: #333; font-size: 15px; }

        .sidebar ul { padding-left: 0; list-style: none; margin: 0; }
        .sidebar ul li { margin-bottom: 8px; }
        .sidebar ul li a {
            text-decoration: none;
            color: #0055aa;
            font-size: 14px;
        }
        .sidebar ul li a:hover { text-decoration: underline; }
        .sidebar ul li a.aktif {
            color: #cc4400;
            font-weight: bold;
        }

        .konten {
            flex: 1;
            background: white;
            border: 1px solid #ccc;
            padding: 20px;
        }

        .konten .tanggal {
            color: #888;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .konten h2 { margin-top: 0; }

        .konten img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin: 12px 0;
            border: 1px solid #ccc;
        }

        .placeholder-gambar {
            width: 100%;
            height: 160px;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            font-size: 13px;
            margin: 12px 0;
            border: 1px dashed #aaa;
        }

        .kutipan {
            background: #fffbe6;
            border-left: 4px solid #cc9900;
            padding: 10px 15px;
            margin: 15px 0;
            font-style: italic;
            color: #555;
            font-size: 14px;
        }

        .konten .referensi { font-size: 14px; margin-top: 10px; }
        .konten .referensi a { color: #0055aa; }

        .selamat-datang {
            color: #555;
            padding: 20px 0;
        }

        .nav-bawah { margin-top: 20px; }
        .nav-bawah a {
            display: inline-block;
            padding: 9px 18px;
            background: #0055aa;
            color: white;
            text-decoration: none;
            margin-right: 8px;
            font-size: 14px;
        }
        .nav-bawah a:hover { background: #003d80; }
        .nav-bawah a.abu { background: #888; }
        .nav-bawah a.abu:hover { background: #666; }
    </style>
</head>
<body>

<nav>
    <a href="index.php"> Profil</a>
    <a href="timeline.php"> Timeline</a>
    <a href="blog.php">Blog</a>
</nav>

<h1>Blog Reflektif Developer</h1>

<div class="wrapper">

    <div class="sidebar">
        <h3>Daftar Artikel</h3>
        <ul>
            <?php foreach ($artikel as $key => $data): ?>
                <?php $kelasAktif = ($artikelDipilih == $key) ? "aktif" : ""; ?>
                <li>
                    <a href="blog.php?artikel=<?php echo $key; ?>" class="<?php echo $kelasAktif; ?>">
                        <?php echo $data['judul']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="konten">

        <?php if ($artikelDipilih != null): ?>

            <?php $isi = $artikel[$artikelDipilih]; ?>

            <p class="tanggal"><?php echo $isi['tanggal']; ?></p>
            <h2><?php echo $isi['judul']; ?></h2>

            <?php if (file_exists($isi['gambar'])): ?>
                <img src="<?php echo $isi['gambar']; ?>" alt="<?php echo $isi['judul']; ?>">
            <?php else: ?>
                <div class="placeholder-gambar">
                    Gambar: <?php echo $isi['gambar']; ?><br>
                    <small>(Letakkan file gambar di folder /img/)</small>
                </div>
            <?php endif; ?>

            <p><?php echo $isi['isi']; ?></p>

            <div class="kutipan">
                <strong>Kutipan Motivasi:</strong><br>
                "<?php echo $kutipanAcak; ?>"
            </div>

            <p class="referensi">
                <strong>Referensi:</strong>
                <a href="<?php echo $isi['link']; ?>" target="_blank"><?php echo $isi['link']; ?></a>
            </p>

            <!-- Navigasi -->
            <div class="nav-bawah">
                <a href="blog.php" class="abu">Kembali ke Daftar</a>
                <a href="timeline.php" class="abu">Timeline</a>
                <a href="index.php">Profil</a>
            </div>

        <?php else: ?>

            <div class="selamat-datang">
                <h2>Selamat Datang di Blog!</h2>
                <p>Pilih salah satu artikel di sebelah kiri untuk mulai membaca.</p>
                <p style="font-size:13px; color:#888;">
                    Artikel dipilih melalui URL (metode GET).<br>
                    Contoh: <code>blog.php?artikel=html-pertama</code>
                </p>

                <div class="kutipan">
                    <strong>Kutipan Motivasi Hari Ini:</strong><br>
                    "<?php echo $kutipanAcak; ?>"
                </div>
            </div>

            <div class="nav-bawah">
                <a href="timeline.php" class="abu"> Kembali ke Timeline</a>
                <a href="index.php">Profil</a>
            </div>

        <?php endif; ?>

    </div>
</div>

</body>
</html>