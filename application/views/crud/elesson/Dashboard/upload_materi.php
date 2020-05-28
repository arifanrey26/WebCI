<?= $this->session->flashdata("message"); ?>
<form action="<?= base_url("Dashboard_elesson/cekupload"); ?>" method="post"  enctype="multipart/form-data">
  <div class="form-group">
    <label for="formGroupExampleInput">Nama Materi Pembelajaran</label>
    <input type="text" name="materi" class="form-control col-3" id="formGroupExampleInput" placeholder="Masukkan Nama File Materi">
  </div>

  <div class="input-group mb-3 col-4">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Matapelajaran</label>
  </div>
  <select class="custom-select" type="text" name="matapelajaran" id="inputGroupSelect01">
    <?php foreach ($mapel as $row) : ?>
    <option value="<?= $row->id_matapelajaran ?>"><?= $row->nama ?></option>
    <?php endforeach; ?>
  </select>
</div>

<div class="custom-file mb-3">
  <input type="file" name="berkas" class="custom-file-input" id="customFile">
  <label class="custom-file-label col-4" for="customFile">Choose file</label>
</div>

<div><input type="submit" value="Simpan"/></div>
</form>