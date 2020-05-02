<div class="row"><div class="col-lg-7">
<div class="p-5"><div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Edit User</h1>
    </div><?php foreach($grup as $baris){ ?>
    <form class="grup" action="<?php echo base_url('Mahasiswa/updateGrup')?>" method="post">
    <div class="form-group">
        <input type="hidden" name="id_grup" value="<?php echo $baris->id_grup; ?>">
        <input type="text" class="form-control form-control-user" id="grup" name="grup" placeholder="Grup maximal 7 characters" value="<?php echo $baris->grup; ?>" require>
    </div>
    <input type="submit" class="btn btn-success btn-icon-split" name="submit" value="Update">
    </form><?php } ?><hr>
        <div class="text-center"><a class="small" href="<?php echo
        base_url('Mahasiswa/showGrup')?>">Kembali</a>
        </div>
    </div>
</div>
</div>