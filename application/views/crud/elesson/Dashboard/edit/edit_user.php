<div class="row">
    <div class="col-lg-7">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Tambah User</h1></div>
    <form class="user" action="<?php echo base_url().'Dashboard_elesson/proses_edit_data_user';?>" method="post">
        <div class="form-group">
             <input type="h" class="form-control form-control-user" id="username" name="id_admin"  value="<?php echo $user['id_admin'];?>" require>
        </div>
        <div class="form-group">
             <input type="text" class="form-control form-control-user" id="username" name="username"  value="<?php echo $user['username'];?>" require>
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user" id="password" name="password" value="<?php echo $user['password'];?>" require>
        </div>
        <div class="form-group">
             <input type="text" class="form-control form-control-user" id="nama" name="nama" value="<?php echo $user['nama_lengkap'];?>" require>
        </div>
        <div class="form-group">
             <textarea name="alamat" id="alamat" cols="65" rows="10" value="<?php echo $user['alamat'];?>" require></textarea>
        </div>
        <div class="form-group">
             <input type="number" class="form-control form-control-user" id="telp" name="telp" value="<?php echo $user['no_telp'];?>" require>
        </div>
        <div class="form-group">
             <input type="email" class="form-control form-control-user" id="email" name="email" value="<?php echo $user['email'];?>" require>
        </div>
        <div class="form-group">
             <input type="text" class="form-control form-control-user" id="id_sess" name="id_session" value="<?php echo $user['id_session'];?>" require>
        </div>

        <div class="form-group">
            <select id="level" class="form-control" name="level" require>
                <option value="1">Admin</option>
                <option value="2">Pengajar</option>
                <option value="3">User</option>
            </select>
        </div>
        <div class="form-group">
            <select id="blokir" class="form-control" name="blokir" require>
                <?php
                    foreach ($blokir as $value) {
                     echo "<option value='$value->id_blokir'>$value->blokir</option>";
                    }
                ?>
            </select>
        </div>
        
                <input type="submit" class="btn btn-success btn-icon-split" name="submit" value="Update">
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="<?php echo base_url('Dashboard_elesson')?>">Kembali</a>
            </div>
        </div>
    </div>
</div>