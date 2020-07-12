<?php
session_start();
if (isset($_SESSION['login_user'])!="") {
 header("Location: index.php");
}
require_once 'koneksi.php';

if(isset($_POST['btn-signup'])) {
 
 $uname = strip_tags($_POST['USERNAME']);
 $upass = strip_tags($_POST['password']);
 
 $uname = $con->real_escape_string($uname);
 $upass = $con->real_escape_string($upass);
 
 $hashed_password = md5($upass);
 
 $check_account = $con->query("SELECT USERNAME FROM login WHERE USERNAME='$uname'");
 $count=$check_account->num_rows;
 
 if ($count==0) {
  
  //id_p_role 3, karena otomatis menjadi anggota jika register
  $query = "INSERT INTO login(id_role,USERNAME,password,tgl_dibuat) VALUES(3,'$uname','$hashed_password', curdate())";
	//echo $query;
  if ($con->query($query)) {
	header("location: index.php");
	
  }else {
   $error = "terjadi kesalahan !";
  }
  
 } else {
  
  
  $error = "maaf, username sudah dipakai anggota lain!";
   
 }
 
 $con->close();
}
?>
<html>
<head>
<title>Registrasi | Perpustakaan</title>
	<link rel="stylesheet" type="text/css" href="template/alert.css">
	<script src="template/js/jquery-3.1.1.min.js"></script>
	<link href="template/css/bootstrap.min.css" rel="stylesheet" />
	<link href="template/css/sb-admin-2.css" rel="stylesheet" />
	<script src="template/js/bootstrap.min.js"></script>
</head>
	<body>
	<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
					<div class="panel-heading">
                        <h3 class="panel-title">Silahkan Mendaftar</h3>
                    </div>
                    <div class="panel-body">
						<form method="post">
						<fieldset>
							<?php
							if ($error != ""){
							?>
								<div class="alert">
								<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
									<?php echo $error; ?>
								</div>
							<?php
							}
							?>
							<br>
							<br>
							<input type="text"  class="form-control" onkeypress="return isNumber(event)" placeholder="username" name="USERNAME" required  /><br>
							<input type="password" class="form-control" id="password" placeholder="Password" onkeypress="checkPassStrength()" name="password" required  />
							<br>
							Password Level : <label id="passstrength">-</label>
							<br>
							<button type="submit" name="btn-signup" class="btn btn-md btn-primary btn-block">Create Account</button> 
							<br>Sudah Punya Akun? <a href="index.php">Login disini</a>
						</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script language="javascript">
$('#password').keyup(function(e) {
     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
     var enoughRegex = new RegExp("(?=.{6,}).*", "g");
     if (false == enoughRegex.test($(this).val())) {
             $('#passstrength').html('More Characters');
     } else if (strongRegex.test($(this).val())) {
             $('#passstrength').className = 'ok';
             $('#passstrength').html('Strong!');
     } else if (mediumRegex.test($(this).val())) {
             $('#passstrength').className = 'alert';
             $('#passstrength').html('Medium!');
     } else {
             $('#passstrength').className = 'error';
             $('#passstrength').html('Weak!');
     }
     return true;
});

function isNumber(event){
  var charCode = (event.which) ? event.which : event.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57))
   return true;
 return false;
}
</script>