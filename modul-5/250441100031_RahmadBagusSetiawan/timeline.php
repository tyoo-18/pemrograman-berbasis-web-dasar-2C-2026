<?php

function formatTahun($tahun) {
    $tahunPenting = [2023, 2025];

    if (in_array($tahun, $tahunPenting)) {
        return "<span style='color: #cc7700; font-weight: bold;'>; " . $tahun . " (Milestone!)</span>";
    } else {
        return "<span style='color: #555;'>" . $tahun . "</span>";
    }
}

$riwayatBelajar = [
    [
        "tahun"  => 2021,
        "judul"  => "Pertama Kali Kenal Coding",
        "cerita" => "Waktu SMP kelas 9, iseng download Python dan nyoba bikin 'Hello World'. Bingung tapi penasaran."
    ],
    [
        "tahun"  => 2022,
        "judul"  => "Belajar HTML & CSS Otodidak",
        "cerita" => "Mulai belajar HTML dan CSS lewat YouTube. Berhasil bikin halaman profil pertama, seneng banget waktu itu!"
    ],
    [
        "tahun"  => 2023,
        "judul"  => "Masuk SMK Jurusan Rekayasa Perangkat Lunak",
        "cerita" => "Semester 1 belajar algoritma dan dasar pemrograman Python secara formal."
    ],
    [
        "tahun"  => 2024,
        "judul"  => "Belajar PHP & MySQL",
        "cerita" => "Mulai belajar PHP dan MySQL. Pertama kali bikin sistem login sederhana - banyak error tapi makin paham."
    ],
    [
        "tahun"  => 2024,
        "judul"  => "Proyek Pertama: Toko Online Mini",
        "cerita" => "Tugas UAS: bikin website toko online dengan PHP, MySQL, Bootstrap. Meski masih sederhana, ini pertama kali proyek web selesai!"
    ],
    [
        "tahun"  => 2025,
        "judul"  => "Mulai Belajar Laravel & React",
        "cerita" => "Uji Kompetensi dan mulai eksplorasi Laravel dan React. Semangat terus!"
    ],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Timeline - Rahmad Bagus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
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

        .item {
            background: white;
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            position: relative;
        }

        .item .tahun { font-size: 13px; margin-bottom: 5px; }
        .item h3 { margin: 5px 0; color: #222; }
        .item p { color: #555; margin: 5px 0 0; font-size: 14px; }

        .nav-bawah { margin-top: 30px; }
        .nav-bawah a {
            display: inline-block;
            padding: 10px 20px;
            background: #0055aa;
            color: white;
            text-decoration: none;
            margin-right: 10px;
        }
        .nav-bawah a:hover { background: #003d80; }
        .nav-bawah a.abu { background: #888; }
        .nav-bawah a.abu:hover { background: #666; }
    </style>
</head>
<body>

<nav>
    <a href="index.php">Profil</a>
    <a href="timeline.php">Timeline</a>
    <a href="blog.php">Blog</a>
</nav>

<h1>Timeline Perjalanan Belajar Coding</h1>
<p style="color:#666;">Riwayat belajar dari array asosiatif PHP, ditampilkan pakai foreach.</p>

<div class="timeline">
    <?php foreach ($riwayatBelajar as $data): ?>
        <div class="item">
            <div class="tahun"><?php echo formatTahun($data['tahun']); ?></div>
            <h3><?php echo $data['judul']; ?></h3>
            <p><?php echo $data['cerita']; ?></p>
        </div>
    <?php endforeach; ?>
</div>

<div class="nav-bawah">
    <a href="index.php" class="abu">Kembali ke Profil</a>
    <a href="blog.php">Menuju Blog Developer</a>
</div>

</body>
</html>