<?php
	include("../koneksi.php");
	$where = " WHERE 1=1 ";

	$txtNo = "";
	$txtNama = "";
	$txtTgl = "";
	
	if(isset($_GET['txtNo'])){
		$txtNo = mysqli_real_escape_string($con,$_GET['txtNo']);
		if($txtNo != ""){
			$where .= " AND no_peminjaman LIKE '%$txtNo%' ";
		}
	}
	
	if(isset($_GET['txtNama'])){
		$txtNama = mysqli_real_escape_string($con,$_GET['txtNama']);
		if($txtNama != ""){
			$where .= " AND anggota LIKE '%$txtNama%' ";
		}
	}
	
	if(isset($_GET['txtTgl'])){
		$txtTgl = mysqli_real_escape_string($con,$_GET['txtTgl']);
		if($txtTgl != ""){
			$where .= " AND tgl_pinjam = '$txtTgl' ";
		}
	}
						
	include("header.php");	
?>
<div id="page-wrapper">
	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Peminjaman</h1>
                </div>
                <!-- /.col-lg-12 -->
	</div>
   <div class="row">
		<div class="col-lg-8 col-md-6">
		<form method="GET">
		<table>
		  <tr>
			<td>No Peminjaman&nbsp;</td>
			<td><input type="text" class="form-control"  name="txtNo" value="<?php echo $txtNo; ?>"></td>
			<td>&nbsp;Tanggal Peminjaman&nbsp;</td>
			<td><input type="text" class="form-control"  id="txtTgl" name="txtTgl" value="<?php echo $txtTgl; ?>"></td>
		  </tr>
		  <tr colspan="2">
			<td>ID Anggota&nbsp;</td>
			<td><input type="text" class="form-control"  name="txtNama" value="<?php echo $txtNama; ?>"></td>
		  </tr>
		  <tr style="height:50px">
			<td></td>
			<td valign="middle"><button type="submit" class="btn btn-small btn-primary btn-block">Cari</button></td>
			<td></td>
			<td></td>
		  </tr>
		</table>
		</form>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12">
		<table class="table table-striped table-bordered table-hover">
			<tr>
				<th>No</th>
				<th>ID Peminjaman</th>
				<th>ID Petugas</th>
				<th>ID Buku</th>
				<th>ID Anggota</th>
				<th>Tanggal Pinjam</th>
				<th>Tanggal Kembali</th>
				<th colspan="2">Action</th>
			</tr>
		  <?php
          $sql = "SELECT * FROM peminjaman ";
          //echo $sql;
          $result = mysqli_query($con,$sql);
          $jum_data = mysqli_num_rows($result);
          
			$no = 1;
			while($tampil = mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $tampil['ID_PEMINJAMAN']; ?></td>
						<td><?php echo $tampil['ID_PETUGAS']; ?></td>
						<td><?php echo $tampil['ID_BUKU']; ?></td>
						<td><?php echo $tampil['ID_ANGGOTA']; ?></td>
						<td><?php echo $tampil['TGL_PEMINJAMAN']; ?></td>
						<td><?php echo $tampil['TGL_PENGEMBALIAN']; ?></td>
						<td><a href="input-peminjaman.php?ID_PEMINJAMAN=<?php echo $tampil['ID_PEMINJAMAN'];?>" class="btn btn-info">Edit</a></td>
						<td><a href="detil-peminjaman.php?ID_PEMINJAMAN=<?php echo $tampil['ID_PEMINJAMAN'];?>" class="btn btn-warning">Detil</a></td>
					</tr>
					
				<?php
				$no++;
			}
				?>
		  </table>
		  <br>
		  </div>
	</div>
</div>
<?php 
include "footer.php";
?>
<script type="text/javascript">
		$(document).ready(function(e) {
		$("#txtTgl").datepicker({dateFormat: "yy-mm-dd"});
	});
</script>