<?php
require_once '../koneksi.php';
require_once '../session.php';

	$usersession = $_SESSION['login_user'];
	
	$sql = "select id_role, id from login where username = '$usersession' ";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$idnya = $row['id'];
	$roleid = $row['id_role'];
	//echo $sql;
	
	if($roleid==1){
		//admin
		$sql_profile ="SELECT 'Admin' as nama, C.role, A.tgl_dibuat AS tgl_register, 
						FROM login A 
						JOIN role C ON A.id_role = C.id_role
						WHERE A.username = 'adm'";
	}else{
	
		if($roleid==2){
			$sql_profile = "SELECT B.nama_petugas, C.role, A.tgl_dibuat AS tgl_register, 
						FROM login A 
						JOIN petugas B ON A.username = B.username
						JOIN role C ON A.id_role = C.id_role
						WHERE A.username = '$usersession'";
			$url_edit = "input-petugas.php?id=$idnya";
		}else{
			$sql_profile = "SELECT anggota.ID_ANGGOTA, anggota.NAMA_ANGGOTA, role.role, login.tgl_dibuat AS tgl_register, 
						FROM login
						JOIN anggota ON login.USERNAME = anggota.USERNAME
						JOIN role  ON login.id_role = role.id_role
						WHERE login.USERNAME = '$usersession'";
			$url_edit = "input-anggota.php?id=$idnya";
		}
		//echo $sql_profile;
	}
	
	$result = mysqli_query($con,$sql_profile);
	$tampil = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
include("header.php");	
?>
<div id="page-wrapper">
	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<table>
						<tr>
							<td>Nama :</td>
							<td><?php echo $tampil['NAMA_ANGGOTA']; ?></td>
						</tr>
						<?php
						if($row['id_role']==3){
						?>
						<tr>
							<td>No Anggota :</td>
							<td><?php echo $tampil['ID_ANGGOTA']; ?></td>
						</tr>
						<?php
						}else{
						?>
						<tr>
							<td>Role :</td>
							<td><?php echo $tampil['role']; ?></td>
						</tr>
						<?php
						}
						?>
						<tr>
							<td>Tanggal Register:</td>
							<td><?php echo $tampil['tgl_register']; ?></td>
						</tr>
			</table>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-sm-8">
			<?php
			if($roleid==1){
			?>
			<a href="ganti_password.php" class="btn btn-primary">Ubah Password</a>
			<?php
			}else if($roleid==2){
			?>
			<a href="<?php echo $url_edit;?>" class="btn btn-primary">Ubah Profile</a>
			<a href="ganti_password.php" class="btn btn-primary">Ubah Password</a>
			<?php
			}else{
			?>
			<a href="<?php echo $url_edit;?>" class="btn btn-primary">Ubah Profile</a>
			<a href="ganti_password.php" class="btn btn-primary">Ubah Password</a>
			<a href="cetak_kartu_anggota.php?id=<?php echo $idnya;?>" class="btn btn-primary">Cetak Kartu Anggota</a>
			<?php
			}
			?>
		</div>
	</div>
</div>
<?php
include("footer.php");
?>