<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?></title>
</head>
<body>
    <h3>Daftar Prodi Jurusan Teknologi Informasi</h3>
    <table border="1">
        <tr>
            <td>No</td>
            <td>Prodi</td>
            <td>Keterangan</td>
        </tr>
    <?php 
    $no = 1;

    foreach($prodi as $row) : 
    
    ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $row['prodi']; ?></td>
            <td><?= $row['keterangan']; ?></td>
        </tr>
    <?php 
    $no++;

    endforeach; 
    ?>
    </table>
</body>
</html>