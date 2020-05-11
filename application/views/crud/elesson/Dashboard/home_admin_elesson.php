<?php
  $getUser = $this->session->userdata('session_user');
  $getLevel = $this->session->userdata('session_level');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Cards</title>

   <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    </head>

    <body>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables User</h6></div>
                <div class="card-body"><div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr><th>No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Grup</th>
                                <th>Aksi</th></tr>
                        </thead>
                        <tfoot><tr><th>No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Grup</th>
                                <th>Aksi</th></tr>
                        </tfoot>
                        <tbody>
                            <?php $no=1;
                                    foreach($user as $baris){ 
                            ?>
                            <tr><td><?php echo $no++ ?></td>
                                <td><?php echo $baris->username?></td>
                                <td><?php echo $baris->alamat?></td>
                                <td><?php echo $baris->level?></td>
                                <td>
                                    <?php
                                        if($getLevel == 1 ){
                                            echo '<a href="'.base_url('Dashboard_elesson/edit/'.$baris->id).'" class="fa fa-edit">&nbsp;</a>';
                                            echo " ";
                                            echo '<a href="'.base_url('Dashboard_elesson/hapus/'.$baris->id).'" class="fa fa-times">&nbsp;</a>';
                                        }
                                    ?>
                                    </td></tr>

                                    <?php } ?>
                        </tbody>
                    </table>
                </div>
                <a href="Dashboard_elesson/tambah_data_user" class="btn btn-success btn-icon-split">
                <span class="text">Tambah Data</span>
                </a>
            </div>
        </div>
    </body>
</html>