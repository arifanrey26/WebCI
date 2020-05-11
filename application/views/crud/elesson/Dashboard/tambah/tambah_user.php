<div class="row">
    <div class="col-lg-7">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Tambah User</h1></div>
    <form class="user" action="<?php echo base_url().'Dashboard_elesson/proses_tambah_data_user';?>" method="post">
        <div class="form-group">
             <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username Maximal 10 Character" require>
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password Maximal 6 Character" require>
        </div>
        <div class="form-group">
             <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap" require>
        </div>
        <div class="form-group">
             <textarea name="alamat" id="alamat" cols="65" rows="10" placeholder="Alamat" require></textarea>
        </div>
        <div class="form-group">
             <input type="number" class="form-control form-control-user" id="telp" name="telp" placeholder="No Telepon" require>
        </div>
        <div class="form-group">
             <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="E-Mail" require>
        </div>
        <div class="form-group">
            <select id="grup" class="form-control" name="level" require>
                <?php
                    foreach ($tambah as $value) {
                     echo "<option value='$value->level'>$value->level</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <select id="grup" class="form-control" name="blokir" require>
                <?php
                    foreach ($tambah as $value) {
                     echo "<option value='$value->blokir'>$value->blokir</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
             <input type="text" class="form-control form-control-user" id="id_sess" name="id_session" placeholder="Id Session" require>
        </div>
                <input type="submit" class="btn btn-success btn-icon-split" name="submit" value="Tambah">
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="<?php echo base_url('Dashboard_elesson')?>">Kembali</a>
            </div>
        </div>
    </div>
</div>