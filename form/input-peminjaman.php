<?php
ini_set('display_errors', 0);
require_once '../koneksi.php';
require_once '../session.php';
$id_pk = mysqli_real_escape_string($con,$_GET['ID_PEMINJAMAN']);

if ($id_pk != null){
	$judul = "Edit Peminjaman";
	$sql_data = "SELECT * FROM PEMINJAMAN WHERE ID_PEMINJAMAN = '$id_pk' ";
	//echo $sql_data;
	$result_data = mysqli_query($con,$sql_data);
	$tampil_data = mysqli_fetch_array($result_data,MYSQLI_ASSOC);
}else{
	$judul = "Input Peminjaman";
}
	
if(isset($_POST['btnsubmit'])) {
    
    
	$ID_BUKU = $_POST['ID_BUKU'];
	$ID_PEMINJAMAN = $_POST['ID_PEMINJAMAN'];
    $ID_ANGGOTA = $_POST['ID_ANGGOTA'];
    
	$usersession = $_SESSION['login_user'];
	
	$sql = "select id_role from login where USERNAME = '$usersession' ";
	$result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  
	if ($id_pk == null){
		$query = "INSERT INTO peminjaman(ID_PEMINJAMAN,ID_BUKU,ID_PETUGAS,ID_ANGGOTA,TGL_PEMINJAMAN,TGL_PENGEMBALIAN) 
						VALUES('PJ-00002','BP001','PK001','AP001',curdate(), ''";
				
		if ($con->query($query)) {
					$con->close();
					header('location:data-peminjaman.php');
				}
		} else {
			$error = "Terjadi kesalahan saat upload file.";
			}
		}
		//selesai upload cover
	else{
		//update buku
			$query = "UPDATE peminjaman SET ID_BUKU ='$ID_BUKU',ID_PETUGAS = '$ID_PETUGAS',ID_ANGGOTA = '$I_ANGGOTA'
					WHERE ID_PEMINJAMAN = $id_pk";
	
			if ($con->query($query)) {
				$con->close();
				header('location:data-PEMINJAMAN.php');
			}
	}

include("header.php");	
?>
<div id="page-wrapper">
	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $judul;?>
                    <?php echo $rowPEMINJAMAN['ID_PEMINJAMAN'];?></h1>
                </div>
                <!-- /.col-lg-12 -->
	</div>
    <?php
    //generate no peminjaman
			$sql_2 = "SELECT IFNULL(MAX(ID_PEMINJAMAN),0) AS nopj FROM peminjaman ";
			$result_2 = mysqli_query($con,$sql_2);
			$row_2 = mysqli_fetch_array($result_2,MYSQLI_ASSOC);
			$temp = $row_2['nopj'];
			//echo $temp."<br>";
			
			if($temp > 0){
				$ID_PEMINJAMAN = "PJ-00001"; //$awal.$lahir.$tahun;
			}else{
				//$awal = "PJ-";
				$temp_pj = substr($temp[0],1);
                $temp_pji= (int) $temp_pj;
                $temp_pji =$temp_pji+2;
                $ID_PEMINJAMAN = "PJ-".str_pad($temp_pji, 5, "0", STR_PAD_LEFT);
               // echo $ID_PEMINJAMAN;
            }
            
	?>
	<div class="row">
		<div class="col-lg-6">
        <form class="form-horizontal" method="post" id="formpinjam">
				<div class="form-group">
					<label class="control-label col-sm-4">ID Peminjaman</label>
					<div class="col-sm-8">
                    <input type="text" maxlength="15" class="form-control" value="<?php echo $ID_PEMINJAMAN;?><?php echo $tampil_data['ID_PEMINJAMAN'];?>" id="ID_PEMINJAMAN" name="ID_PEMINJAMAN" required  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">ID Petugas</label>
					<div class="col-sm-8">
					<input type="text" maxlength="15" class="form-control" value="PK001<?php echo $tampil_data['ID_PETUGAS'];?>" id="ID_PETUGAS" name="ID_PETUGAS" required  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">Tanggal Peminjaman</label>
					<div class="col-sm-8">
					<p class="form-control-static"><?php echo date("Y-m-d");?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">ID Anggota</label>
					<div class="col-sm-8">
					<!--<select class="form-control" name="noanggota">
						<?php 
							/*$sql_ag = "SELECT ID_ANGGOTA FROM anggota";
							$result_ag = mysqli_query($con,$sql_ag);
							while($tampil_ag = mysqli_fetch_array($result_ag,MYSQLI_ASSOC)){ */
							?>	
						<option value="<?php //echo $tampil_ag['ID_ANGGOTA']; ?>"><?php //echo $tampil_ag['ID_ANGGOTA'] ?></option>
							<?php 
							//}
							?>
					</select> -->
					<input type="text" maxlength="15" class="form-control" value="<?php echo $tampil_data['ID_ANGGOTA'];?>" id="ID_ANGGOTA" name="ID_ANGGOTA" required  />
					</div>
				</div>
                <div class="form-group">
                <label class="control-label col-sm-4">Judul Buku</label>
                <div class="col-sm-8">
			<select name="ID_BUKU"class="form-control">
				 <option>- Select Judul Buku -</option>
 				 <?php
  					include'../session.php';

  						$select = mysqli_query($con, "select ID_BUKU,JUDUL_BUKU from buku ");  
  						while($row=mysqli_fetch_array($select))
  								{
                               echo "<option>".$row['ID_BUKU']."</option>";
                            }
 				 ?>
 					</select>
 				</div>
                 </div>
				<div class="form-group">
					<label class="control-label col-sm-4">Tanggal Kembali</label>
					<div class="col-sm-8">
					<p class="form-control-static"><?php echo $tampil_data['TGL_PENGEMBALIAN'];?></p>
					</div>
				</div>
				<div class="form-group" align="right">
				<div class="col-sm-4">
				<!-- sengaja dikosongin :D-->
				</div>
				<div class="col-sm-8">
					<a href="data-peminjaman.php" class="btn btn-default">Kembali</a>
					<?php
					if($id_pj == null){
					?>
					<button type="reset" class="btn btn-default">Batal</button>
					<button type="submit" name="btnsubmit" class="btn btn-primary">Simpan</button>
                    <?php } ?>
			</form>
		</div>
	</div>
</div>
<?php 
include "footer.php";
?>