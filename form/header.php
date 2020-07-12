<<<<<<< HEAD
<?php 
  require_once '../koneksi.php';
  
  require_once '../session.php';

	if(!isset($_SESSION['login_user'])){
		header("location:../index.php");
	}

	$login_session = $_SESSION['login_user'];
	
	$sql = "select id_role from login where username = '$login_session' ";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	if($row['id_role']==1){
		  include("header-petugas.php");
      }
  else if($row['id_role']==2){
			include("header-petugas.php");
      }
  else if($row['id_role']==3){
			include("header-anggota.php");
      }
  else{
		header("location:../index.php");
	}
=======
<?php 
  require_once '../koneksi.php';
  
  require_once '../session.php';

	if(!isset($_SESSION['login_user'])){
		header("location:../index.php");
	}

	$login_session = $_SESSION['login_user'];
	
	$sql = "select id_role from login where username = '$login_session' ";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	if($row['id_role']==1){
		  include("header-petugas.php");
      }
  else if($row['id_role']==2){
			include("header-petugas.php");
      }
  else if($row['id_role']==3){
			include("header-anggota.php");
      }
  else{
		header("location:../index.php");
	}
>>>>>>> e8287590865ffc0f00f45b72dc4bd066cd7e6bf6
?>