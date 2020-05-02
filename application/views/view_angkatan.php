<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?></title>
</head>
<body>
    <h3>Daftar Angkatan Jurusan Teknologi Informasi</h3>
    <table border="1">
        <tr>
            <td>No</td>
            <td>Tahun</td>            
        </tr>
    <?php 
    $no = 1;

    foreach($angkatan as $row) : 
    
    ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $row['tahun']; ?></td>            
        </tr>
    <?php 
    $no++;

    endforeach; 
    ?>
    </table>
</body>
</html>