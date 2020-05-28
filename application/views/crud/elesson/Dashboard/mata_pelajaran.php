<?= $this->session->flashdata("message"); ?>
<div class="card text-center">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">Manajemen Kelas</h5>
    <p class="card-text">Dalam aplikasi E-Lesson terdapat beberapa kelas yang dapat diikuti oleh user.</p>
  </div>
  
</div>

<form method="post" action="<?= base_url("Dashboard_elesson/pengampuh"); ?>">
  <div class="form-group">
    <label for="formGroupExampleInput">Keterangan Pengampu</label>
    <input type="text" name="judul" class="form-control col-3" id="formGroupExampleInput" placeholder="Ex: IPA Ekosistem dll.">
  </div>

  <label for="formInputGroup">Username Pengajar</label>
<div class="input-group mb-3">
<div class="input-group mb-3 col-4">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Pengajar</label>
  </div>
  <select class="custom-select" type="text" name="pengajar" id="inputGroupSelect01">
    <?php foreach ($pengajar as $row) : ?>
    <option value="<?= $row->username ?>"><?= $row->username ?></option>
    <?php endforeach; ?>
  </select>
</div>
</div>

  <label for="formInputGroup">Pilih Matapelajaran</label>
<div class="input-group mb-3">
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
</div>

<div>
    <input type="submit" name="submit" value="Simpan">
</div>
</form>