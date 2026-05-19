<?php

function tampilkanHasil($framework, $cerita, $tools, $minat, $skill) {
    echo "<h3>Hasil Input:</h3>";
    echo "<table border='1' cellpadding='8' cellspacing='0' width='100%'>";
    echo "<tr><th>Field</th><th>Data</th></tr>";
    echo "<tr><td>Framework / Tools</td><td>" . implode(", ", $framework) . "</td></tr>";

    if (!empty($tools)) {
        echo "<tr><td>Tools Penunjang</td><td>" . implode(", ", $tools) . "</td></tr>";
    } else {
        echo "<tr><td>Tools Penunjang</td><td><i>Tidak dipilih</i></td></tr>";
    }

    echo "<tr><td>Minat Bidang</td><td>" . $minat . "</td></tr>";
    echo "<tr><td>Tingkat Skill</td><td>" . $skill . "</td></tr>";
    echo "</table>";

    echo "<br><strong>Cerita Pengalaman:</strong>";
    echo "<p>" . ($cerita) . "</p>";

    if (count($framework) > 2) {
        echo "<p style='color:green; font-weight:bold;'>&#10003; Skill Anda cukup luas di bidang development!</p>";
    }
}

$pesanError  = [];
$sudahSubmit = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sudahSubmit = true;

    $inputFramework = $_POST['framework'];
    $cerita         = $_POST['cerita'];
    $tools          = isset($_POST['tools']) ? $_POST['tools'] : [];
    $minat          = $_POST['minat'];
    $skill          = $_POST['skill'];

    if (empty($inputFramework)) {
        $pesanError[] = "Framework tidak boleh kosong!";
    }
    if (empty($cerita)) {
        $pesanError[] = "Cerita pengalaman tidak boleh kosong!";
    }
    if (empty($minat)) {
        $pesanError[] = "Minat bidang harus dipilih!";
    }
    if (empty($skill)) {
        $pesanError[] = "Tingkat skill harus dipilih!";
    }

    if (empty($pesanError)) {
        $arrayFramework = explode(",", $inputFramework);
        $arrayFramework = array_map('trim', $arrayFramework);
        $arrayFramework = array_filter($arrayFramework);      
        $dataValid      = true;
    } else {
        $dataValid = false;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Developer - Rahmad Bagus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 750px;
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
        h3 { color: #333; }

        .kotak {
            background: white;
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
        }

        table { border-collapse: collapse; width: 100%; }
        th { background: #ccc; text-align: left; }
        td, th { padding: 8px 10px; border: 1px solid #bbb; }
        tr:nth-child(even) { background: #f9f9f9; }

        label { display: block; margin-top: 12px; font-weight: bold; }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 7px;
            margin-top: 4px;
            box-sizing: border-box;
            border: 1px solid #bbb;
        }
        textarea { height: 100px; resize: vertical; }

        .grup-checkbox label,
        .grup-radio label {
            display: inline;
            font-weight: normal;
            margin-right: 15px;
        }

        .error { color: red; }
        .sukses { color: green; }
        small { color: #666; }

        input[type="submit"] {
            margin-top: 15px;
            padding: 10px 30px;
            background: #0055aa;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        input[type="submit"]:hover { background: #003d80; }
    </style>
</head>
<body>

<nav>
    <a href="index.php">Profil</a>
    <a href="timeline.php"> Timeline</a>
    <a href="blog.php"> Blog</a>
</nav>

<h1>Profil Interaktif Developer Pemula</h1>

<div class="kotak">
    <h2>Data Diri</h2>
    <table>
        <tr><th>Nama</th><td>Rahmad Bagus Setiawan</td></tr>
        <tr><th>ID Developer</th><td>DEV-2026-001</td></tr>
        <tr><th>Tempat, Tanggal Lahhir</th><td>Bangkalan, 18-12-2006</td></tr>
        <tr><th>Email</th><td>tyooo18@gmail.com</td></tr>
        <tr><th>No. WhatsApp</th><td>+62 812-3456-7890</td></tr>
    </table>
</div>

<?php if ($sudahSubmit && !empty($pesanError)): ?>
    <div class="kotak">
        <p class="error"><strong>Ada yang belum diisi:</strong></p>
        <ul class="error">
            <?php foreach ($pesanError as $e): ?>
                <li><?php echo $e; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ($sudahSubmit && isset($dataValid) && $dataValid): ?>
    <div class="kotak">
        <?php tampilkanHasil($arrayFramework, $cerita, $tools, $minat, $skill); ?>
    </div>
<?php endif; ?>


<div class="kotak">
    <h2>Form Isian Dinamis</h2>

    <form method="POST" action="index.php">

        <label>Framework / Tools yang Dikuasai: *</label>
        <small>Pisahkan dengan koma. Contoh: Laravel, React, Vue</small>
        <input type="text" name="framework"
            value="<?php echo isset($inputFramework) ? htmlspecialchars($inputFramework) : ''; ?>">

        <label>Cerita Singkat Pengalaman Membuat Website: *</label>
        <textarea name="cerita"><?php echo isset($cerita) ? htmlspecialchars($cerita) : ''; ?></textarea>

        <label>Tools Penunjang:</label>
        <div class="grup-checkbox">
            <?php
            $daftarTools = ["VS Code", "GitHub", "Figma", "Postman", "XAMPP"];
            foreach ($daftarTools as $tool):
                $cek = (isset($tools) && in_array($tool, $tools)) ? "checked" : "";
            ?>
                <label>
                    <input type="checkbox" name="tools[]" value="<?php echo $tool; ?>" <?php echo $cek; ?>>
                    <?php echo $tool; ?>
                </label>
            <?php endforeach; ?>
        </div>

        <label>Minat Bidang: *</label>
        <div class="grup-radio">
            <?php
            $pilihanMinat = ["Frontend", "Backend", "Fullstack"];
            foreach ($pilihanMinat as $p):
                $cek = (isset($minat) && $minat == $p) ? "checked" : "";
            ?>
                <label>
                    <input type="radio" name="minat" value="<?php echo $p; ?>" <?php echo $cek; ?>>
                    <?php echo $p; ?>
                </label>
            <?php endforeach; ?>
        </div>

        <label>Tingkat Skill Coding: *</label>
        <select name="skill">
            <option value="">-- Pilih Tingkat Skill --</option>
            <?php
            $pilihanSkill = ["Dasar", "Cukup", "Profesional"];
            foreach ($pilihanSkill as $s):
                $sel = (isset($skill) && $skill == $s) ? "selected" : "";
            ?>
                <option value="<?php echo $s; ?>" <?php echo $sel; ?>><?php echo $s; ?></option>
            <?php endforeach; ?>
        </select>

        <br>
        <input type="submit" value="Simpan Data">

    </form>
</div>

</body>
</html>