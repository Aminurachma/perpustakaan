<?php
ini_set('display_errors', 0);
require_once '../koneksi.php';
require_once '../session.php';
$id_bk = mysqli_real_escape_string($con,$_GET['ID_BUKU']);

if ($id_bk != null){
	$judul = "Edit Buku";
	$sql_data = "SELECT * FROM buku WHERE ID_BUKU = '$id_bk' ";
	//echo $sql_data;
	$result_data = mysqli_query($con,$sql_data);
	$tampil_data = mysqli_fetch_array($result_data,MYSQLI_ASSOC);
}else{
	$judul = "Input Buku";
}
	
if(isset($_POST['btnsubmit'])) {
    
	$ID_BUKU = $_POST['ID_BUKU'];
	$JUDUL_BUKU = $_POST['JUDUL_BUKU'];
	$PENGARANG = $_POST['PENGARANG'];
    $PENERBIT = $_POST['PENERBIT'];
	$ID_PETUGAS = $IDPETUGAS;
	
	$usersession = $_SESSION['login_user'];
	
	$sql = "select id_role from login where username = '$usersession' ";
	$result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  
	if ($id_bk == null){
		//mulai proses upload cover
		$target_dir = "../template/img/buku/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				//echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				$error = "File bukan file gambar.";
				$uploadOk = 0;
			}
			
		// Check if file already exists
		if (file_exists($target_file)) {
			$error = "File sudah ada.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			$error = "File terlalu besar, harus dibawah 500 kb.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
			$error = "File harus ber-ektensi JPG, JPEG atau PNG";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$error = "Gagal upload file cover.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				$cover = basename( $_FILES["fileToUpload"]["name"]);
			
				//insert buku
				$query = "INSERT INTO buku(ID_BUKU,JUDUL_BUKU,PENGARANG,PENERBIT,GAMBAR_BUKU,TGL_MASUK,ID_PETUGAS,KET) 
						VALUES('$ID_BUKU','$JUDUL_BUKU','$PENGARANG', '$PENERBIT','$cover',curdate(),'PK001', 'Tersedia')";
				
				if ($con->query($query)) {
					$con->close();
					header('location:data_buku.php');
				}
		} else {
			$error = "Terjadi kesalahan saat upload file.";
			}
		}
		//selesai upload cover
	}else{
		//update buku
			$cover = $tampil_data['GAMBAR'];
			$query = "UPDATE buku SET JUDUL_BUKU_buku ='$JUDUL_BUKU',PENGARANG = '$PENGARANG',PENERBIT = '$PENERBIT',GAMBAR = '$cover',TGL_MASUK = curdate(),ID_PETUGAS = '$ID_PETUGAS',KET = 'Tersedia'
					WHERE ID_BUKU = $id_bk";
	
			if ($con->query($query)) {
				$con->close();
				header('location:data_buku.php');
			}
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
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
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
					<label class="control-label col-sm-4">Kode Buku</label>
					<div class="col-sm-8">
					<input type="text" maxlength="128" class="form-control" name="ID_BUKU" value="<?php echo $tampil_data['ID_BUKU'];?>" required  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">Judul Buku</label>
					<div class="col-sm-8">
					<input type="text" maxlength="128" class="form-control" name="JUDUL_BUKU" value="<?php echo $tampil_data['JUDUL_BUKU'];?>" required  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">Pengarang</label>
					<div class="col-sm-8">
					<input type="text" maxlength="64" class="form-control" name="PENGARANG" value="<?php echo $tampil_data['PENGARANG'];?>" required  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">Penerbit</label>
					<div class="col-sm-8">
					<input type="text" maxlength="64" class="form-control" name="PENERBIT" value="<?php echo $tampil_data['PENERBIT'];?>" required  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">Cover Buku</label>
					<div class="col-sm-8">
					<input type="file" name="fileToUpload" id="fileToUpload">
					</div>
				</div>
				<div class="form-group" align="right">
				<div class="col-sm-4">
				<!-- sengaja dikosongin :D-->
				</div>
				<div class="col-sm-8">
					<a href="data_buku.php" class="btn btn-default">Batal</a>
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