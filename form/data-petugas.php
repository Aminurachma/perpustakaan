<?php
	include("../koneksi.php");

include("header.php");	
?>
<div id="page-wrapper">
	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Petugas</h1>
                </div>
                <!-- /.col-lg-12 -->
	</div>
   
	<hr>
	<div class="row">
		<div class="col-lg-12">
		<table width="100%" class="table table-striped table-bordered table-hover">
			<tr>
				<th>No</th>
				<th>Nama Petugas</th>
				<th>Alamat</th>
				<th>Username</th>
				<th>Nomor Telepon</th>
				<th colspan="2">Action</th>
			</tr>
		  <?php
			
			$sql = "SELECT * FROM Petugas ";
			//echo $sql;
			$result = mysqli_query($con,$sql);
			$jum_data = mysqli_num_rows($result);
			
			$no = 1;
			while($tampil = mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $tampil['NAMA_PETUGAS']; ?></td>
						<td><?php echo $tampil['ALAMAT']; ?></td>                        
						<td><?php echo $tampil['USERNAME']; ?></td>
						<td>0<?php echo $tampil['NO_TELP']; ?></td>
						<td><a href="input-Petugas.php?ID_PETUGAS=<?php echo $tampil['ID_PETUGAS'];?>" class="btn btn-info">Edit</a></td>
						<td><a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_Petugas.php?id=<?php echo $tampil['id_t_Petugas']; ?>' }" class="btn btn-danger">Hapus</a></td>
						</td>
					</tr>
					
				<?php
				$no++;
			}
				?>
		  </table>
		  </div>
	</div>
</div>
<?php 
include "footer.php";
?>