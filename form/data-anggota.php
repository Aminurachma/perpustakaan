<?php
include "header.php";
?>
<?php
	if($row['id_role']==1 || $row['id_role']== 2 ){
?>
<div id="page-wrapper">

	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Anggota</h1>
                </div>
                <!-- /.col-lg-12 -->
	</div>
    <div class="row">
		<div class="col-lg-8 col-md-6">
        <table class="table table-responsive">
        <thead>
            <th>No</th>
		    <th>Id Anggota</th>
		    <th>Nama Anggota</th>
		    <th>Alamat</th>
		    <th>Nomor Telepon</th>
		    <th colspan="3">Action</th>
        </thead>
        <tbody>
          <?php
            $no = 0;
            $query = mysqli_query($con, "SELECT * FROM anggota");
            while ($data = mysqli_fetch_array($query)) {
              $no++;
          ?>
            <td><?php echo $no ?></td>
		    <td><?php echo $data['ID_ANGGOTA']; ?></td>
			<td><?php echo $data['NAMA_ANGGOTA']; ?></td>
			<td><?php echo $data['ALAMAT']; ?></td>
			<td>0<?php echo $data['NO_TELP']; ?></td>
          <td>
            <a href="input-anggota.php?ID_ANGGOTA=<?php echo $data['ID_ANGGOTA'] ?>">Edit</a>
            <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_anggota.php?id_anggota=<?php echo $tampil['id_anggota']; ?>' }" >Hapus</a></td>
          </td>
        </tbody>
        <?php } ?>
      </table>
        </div>
    </div>
    
    <?php }
    else if ($row['id_role']==3){
    ?>
    <div id="page-wrapper">

 
	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Buku</h1>
                </div>
                <!-- /.col-lg-12 -->
	</div>
    <div class="row">
    
    <?php
            $no = 0;
            $query = mysqli_query($con, "SELECT * FROM buku");
            while ($data = mysqli_fetch_array($query)) {
              $no++;
          ?>
		<div class="col-lg-8 col-md-6">
        <div class="col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        
                        <div class="icon-box">
                            <div class ="row">
                                <div class ="col-md-12">
                                    <img src="../template/img/buku/<?php echo $data['GAMBAR_BUKU']?>" class="card-img-top">
                                </div>
                            </div>
                            <div class ="row icon-boxs">
                                <div class="col-md-12">
                                    <h4 class="title"><?php echo $data['JUDUL_BUKU']?></h4>
                            <!-- Start Button buying -->
                                <button type="submit" class="btnAdd">
                            <!-- 		shopping cart icon-->
                               <span class="shopping-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                            <!-- 		Buy Now / ADD to Cart-->
                               <span class="buy">Add To Cart</span>
                             </button>
                                <!-- End Button buying -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
            <?php }?>
                    
        </div>
    </div>
    
    <?php } ?>


</div>
<?php 
include "footer.php";
?>