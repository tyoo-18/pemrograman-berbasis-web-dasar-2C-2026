<?php

// echo "Hallo World!";

// $nama = "Habibi:";
// echo "halo $nama"

$nama = $_GET['nama']; 
$nim = $_GET['nim']; 
$nilai= $_GET['nilai']; 

echo "hai nama saya $nama <br>";
echo "hai nim saya $nim <br>";
echo "hai nilai saya $nilai <br>";

if($nilai >= 85 and $nilai <= 100){
    $nilai = "A";
}elseif($nilai >=70 and $nilai <=84){
    $nilai = "B";
}elseif($nilai >=60 and $nilai <=69){
    $nilai = "C";
}elseif($nilai >=50 and $nilai <=59){
    $nilai = "D";
}else{
    $nilai = "E";
};



echo "hasilnya adalah $nilai <br><br>"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODULE 5</title>
</head>
<body>
    
<form method="GET" action="" border="1">
    <label for="nama">Nama</label>
    <input type="text" placeholder="Masukkan nama...." name="nama"> <br><br>

    <label for="nim">NIM</label>
    <input type="text" placeholder="Masukkan nim...." name="nim"> <br><br>

    <label for="nilai">nilai</label>
    <input type="number" placeholder="Masukkan nilai...." name="nilai"> <br><br>

    <button type="submit">Kirim</button>
</form>

</body>
</html>



