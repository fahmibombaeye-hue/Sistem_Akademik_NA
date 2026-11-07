<?php require 'includes/config.php';$err='';
if($_SERVER['REQUEST_METHOD']=='POST'){
 if(($_POST['t']??'')=='siswa'){
  $s=q("SELECT * FROM siswa WHERE nisn=? AND password=?",[$_POST['nisn'],$_POST['password']])->fetch();
  if(!$s)$err='NISN atau password salah.';
  elseif($s['status']=='blokir')$err='Akun Anda diblokir: '.$s['alasan'].'. Hubungi admin.';
  elseif($s['status']!='aktif')$err='Akun belum aktif.';
  else{$_SESSION['role']='siswa';$_SESSION['id']=$s['id'];header('Location: siswa/madrasah.php');exit;}
 }else{
  $a=q("SELECT * FROM admin WHERE username=? AND password=?",[$_POST['username'],$_POST['password']])->fetch();
  if($a){$_SESSION['role']='admin';$_SESSION['id']=$a['id'];header('Location: admin/index.php');exit;}
  $err='Username atau password admin salah.';}
}?>
<!DOCTYPE html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login SIAKAD</title>
<link rel="icon" type="image/png" href="assets/img/logo.png"><link rel="stylesheet" href="assets/css/style.css"></head><body><div class="center"><div class="card login">
<img class="logo" src="assets/img/logo.png"><h2 style="margin:0">SIAKAD</h2><p style="color:#86efac">Madrasah Aliyah Nahdlatul Arifin</p>
<div class="tabs"><button id="b1" class="on" onclick="tab(1)">Siswa</button><button id="b2" onclick="tab(2)">Admin</button></div>
<?php if($err)echo "<div class='msg err'>".e($err)."</div>";?>
<form method="post" class="pane on" id="p1"><input type="hidden" name="t" value="siswa">
<input name="nisn" placeholder="NISN" required><input type="password" name="password" placeholder="Password" required><button class="btn" style="width:100%">Masuk</button></form>
<form method="post" class="pane" id="p2"><input type="hidden" name="t" value="admin">
<input name="username" placeholder="Username Admin" required><input type="password" name="password" placeholder="Password" required><button class="btn" style="width:100%">Masuk Admin</button></form>
<p style="margin-top:16px">Belum terdaftar? <a href="daftar.php">Daftar sebagai siswa baru</a></p></div></div>
<script>function tab(n){for(let i=1;i<3;i++){document.getElementById('p'+i).classList.toggle('on',i==n);document.getElementById('b'+i).classList.toggle('on',i==n)}}
<?php if(($_POST['t']??'')=='admin')echo "tab(2);";?></script></body></html>
