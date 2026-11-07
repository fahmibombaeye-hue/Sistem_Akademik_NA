<?php require 'includes/config.php';$ok=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
 q("INSERT INTO siswa(nama,alamat,tempat_lahir,tanggal_lahir,jurusan,foto,status) VALUES(?,?,?,?,?,?, 'pending')",
 [$_POST['nama'],$_POST['alamat'],$_POST['tempat_lahir'],$_POST['tanggal_lahir'],$_POST['jurusan'],upload('foto')]);$ok=true;}?>
<!DOCTYPE html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Pendaftaran Siswa</title>
<link rel="icon" type="image/png" href="assets/img/logo.png"><link rel="stylesheet" href="assets/css/style.css"></head><body><div class="center"><div class="card login" style="max-width:520px">
<img class="logo" src="assets/img/logo.png"><h2>Formulir Pendaftaran Siswa Baru</h2>
<?php if($ok)echo "<div class='msg'>✅ Pendaftaran terkirim! Admin akan memberi NISN & password setelah verifikasi.</div>";?>
<form method="post" enctype="multipart/form-data" style="text-align:left">
Nama Lengkap<input name="nama" required>Alamat<textarea name="alamat" required></textarea>
Tempat Lahir<input name="tempat_lahir" required>Tanggal Lahir<input type="date" name="tanggal_lahir" required>
Jurusan yang diambil<select name="jurusan"><option>IPA</option><option>IPS</option></select>
Foto (opsional)<input type="file" name="foto" accept="image/*"><button class="btn" style="width:100%">Kirim Pendaftaran</button></form>
<p style="margin-top:14px"><a href="index.php">← Kembali ke login</a></p></div></div></body></html>
