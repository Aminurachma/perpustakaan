<?php
include "header.php";
?>
<?php
	if($row['id_role']==1 || $row['id_role']== 2 ){
?>
<div id="page-wrapper">

	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Buku</h1>
                </div>
                <!-- /.col-lg-12 -->
	</div>
    <div class="row">
		<div class="col-lg-8 col-md-6">
        <table class="table table-responsive">
        <thead>
          <td>No.</td>
          <td>ID Buku</td>
          <td>Cover Buku</td>
          <td>Judul Buku</td>
          <td>Pengarang</td>
          <td>Penerbit</td>
          <td>Tanggal Masuk</td>
          <td>Action</td>
        </thead>
        <tbody>
          <?php
            $no = 0;
            $query = mysqli_query($con, "SELECT * FROM buku");
            while ($data = mysqli_fetch_array($query)) {
              $no++;
          ?>
          <td><?php echo $no ?></td>
          <td><?php echo $data['ID_BUKU'] ?></td>
          <td><img src="../template/img/buku/<?php echo $data['GAMBAR_BUKU']?>"></td>
          <td><?php echo $data['JUDUL_BUKU'] ?></td>
          <td><?php echo $data['PENGARANG'] ?></td>
          <td><?php echo $data['PENERBIT'] ?></td>
          <td><?php echo $data['TGL_MASUK'] ?></td>
          <td>
            <a href="input-buku.php?ID_BUKU=<?php echo $data['ID_BUKU'] ?>">Edit</a>
            <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_buku.php?id_buku=<?php echo $tampil['id_buku']; ?>' }" >Hapus</a></td>
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