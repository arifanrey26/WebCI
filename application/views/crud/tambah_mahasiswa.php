<div class="row">
    <div class="col-lg-7">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Tambah User</h1></div>
    <form class="user" action="<?php echo base_url().'Mahasiswa/input';?>" method="post">
        <div class="form-group">
             <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username Maximal 10 Character" require>
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-controluser" id="password" name="password" placeholder="Password Maximal 6 Character" require>
        </div>
        <div class="form-group">
            <select id="grup" class="form-control" name="grup" require>
        <?php
            foreach ($grup as $value) {
                echo "<option value='$value->id_grup'>$value->grup</option>";
            }
            ?>
    </select>
    </div>
            <div class="form-group">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Full Name" require>
            </div>
                <input type="submit" class="btn btn-success btn-icon-split" name="submit" value="Tambah">
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="Mahasiswa">Kembali</a>
            </div>
        </div>
    </div>
</div>