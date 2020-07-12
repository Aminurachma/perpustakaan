<?php
ini_set('display_errors', 0);
require_once '../koneksi.php';
require_once '../session.php';
$id_pk = mysqli_real_escape_string($con,$_GET['ID_PETUGAS']);

if ($id_pk != null){
	$judul = "Edit Petugas";
	$sql_data = "SELECT * FROM PETUGAS WHERE ID_PETUGAS = '$id_pk' ";
	//echo $sql_data;
	$result_data = mysqli_query($con,$sql_data);
	$tampil_data = mysqli_fetch_array($result_data,MYSQLI_ASSOC);
}else{
	$judul = "Input Petugas";
}
	
if(isset($_POST['btnsubmit'])) {
    
	$ID_PETUGAS = $_POST['ID_PETUGAS'];
	$NAMA_PETUGAS = $_POST['NAMA_PETUGAS'];
	$ALAMAT = $_POST['ALAMAT'];
    $NO_TELP = $_POST['NO_TELP'];
	
	$usersession = $_SESSION['login_user'];
	
	$sql = "select id_role from login where USERNAME = '$usersession' ";
	$result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  
	if ($id_pk == null){
		$query = "INSERT INTO PETUGAS(ID_PETUGAS,NAMA_PETUGAS,ALAMAT,NO_TELP,tgl_dibuat) 
						VALUES('$ID_PETUGAS','$NAMA_PETUGAS','$ALAMAT', '$NO_TELP',curdate())";
				
		if ($con->query($query)) {
					$con->close();
					header('location:data-petugas.php');
				}
		} else {
			$error = "Terjadi kesalahan saat upload file.";
			}
		}
		//selesai upload cover
	else{
		//update buku
			$query = "UPDATE PETUGAS SET NAMA_PETUGAS ='$NAMA_PETUGAS',ALAMAT = '$ALAMAT',NO_TELP = '$NO_TELP'
					WHERE ID_PETUGAS = $id_pk";
	
			if ($con->query($query)) {
				$con->close();
				header('location:data-petugas.php');
			}
	}

include("header.php");	
?>
<div id="page-wrapper">
	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $judul;?>
                    <?php echo $rowpetugas['ID_PETUGAS'];?></h1>
                </div>
                <!-- /.col-lg-12 -->
	</div>
	
	<div class="row">
		<div class="col-lg-6">
			<form class="form-horizontal" method="post">
				<div class="form-group">
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
				</div>
                <div class="form-group">
					<label class="control-label col-sm-4">Kode Petugas</label>
					<div class="col-sm-8">
					<input type="text" maxlength="128" class="form-control" name="ID_PETUGAS" value="<?php echo $tampil_data['ID_PETUGAS'];?>" required  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">Nama Petugas</label>
					<div class="col-sm-8">
					<input type="text" maxlength="128" class="form-control" name="NAMA_PETUGAS" value="<?php echo $tampil_data['NAMA_PETUGAS'];?>" required  />
					</div>
				</div>
                <div class="form-group">
					<label class="control-label col-sm-4">Alamat Petugas</label>
					<div class="col-sm-8">
					<input type="text"  class="form-control" name="ALAMAT" value="<?php echo $tampil_data['ALAMAT'];?>" required  />
					</div>
				</div>
                <div class="form-group">
					<label class="control-label col-sm-4">Nomor Telepon Petugas</label>
					<div class="col-sm-8">
					<input type="text"  class="form-control" name="NO_TELP" value="<?php echo $tampil_data['NO_TELP'];?>" required  />
					</div>
				</div>
				<div class="form-group" align="right">
				<div class="col-sm-4">
				<!-- sengaja dikosongin :D-->
				</div>
				<div class="col-sm-8">
					<a href="data-Petugas.php" class="btn btn-default">Batal</a>
					<button type="submit" name="btnsubmit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php 
include "footer.php";
?>