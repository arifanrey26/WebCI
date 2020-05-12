<?php
  $getUser = $this->session->userdata('session_user');
  $getLevel = $this->session->userdata('session_level');
?>

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
                                <th>Alamat</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Aksi</th></tr>
                        </thead>
                        <tfoot><tr><th>No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Aksi</th></tr>
                        </tfoot>
                        <tbody>
                            <?php $no=1;
                                    foreach($user as $baris){ 
                            ?>
                            <tr><td><?php echo $no++ ?></td>
                                <td><?php echo $baris->username?></td>
                                <td><?php echo $baris->nama_lengkap?></td>
                                <td><?php echo $baris->alamat?></td>
                                <td><?php echo $baris->level?></td>
                                <td><?php echo $baris->blokir?></td>
                                <td>
                                    <?php
                                        if($getLevel == 1 ){
                                            echo '<a href="'.base_url('Dashboard_elesson/edit_user/'.$baris->id_admin).'" class="fa fa-edit">&nbsp;</a>';
                                            echo " ";
                                            echo '<a href="'.base_url('Dashboard_elesson/hapus_user/'.$baris->id_admin).'" class="fa fa-times">&nbsp;</a>';
                                        }
                                    ?>
                                    </td></tr>

                                    <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php if($getLevel==1){
               echo '<a href="'.base_url('Dashboard_elesson/tambah_data_user').'" class="btn btn-success btn-icon-split">';
               echo '<span class="text">Tambah Data</span>';
               echo '</a>';
            }
                ?>
                <div>
                <?php
            if($this->input->get('delete')==1)
            {
				echo "<script>alert('Data Berhasil Dihapus!');
				</script>";
            }
            else if($this->input->get('delete')==2)
            {
                echo "<script>alert('Data Anda Gagal Dihapus !');
				</script>";
            }
			?>
                </div>
            </div>
        </div>
    </body>
</html>