<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?></title>
</head>
<body>
    <?php
    foreach($Mahasiswa as $row)
    {
        echo "Nama : ".$row['nama'];
        echo "<br/>";
        echo "Prodi : ".$row['prodi'];
        echo "<hr/>";
    }?>
</body>
</html>