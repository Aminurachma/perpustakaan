<?php 
include("../koneksi.php");
include("../session.php");
include("header.php");
?>


<?php
$user_check = $_SESSION['login_user'];

$sql = "select id_role as id_role from login where username = '$user_check' ";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$sql_pj = "select count(*) as JUM from peminjaman";
$result_pj = mysqli_query($con,$sql_pj);
$row_pj = mysqli_fetch_array($result_pj,MYSQLI_ASSOC);

$sql_ag = "select count(*) as JUM from anggota";
$result_ag = mysqli_query($con,$sql_ag);
$row_ag = mysqli_fetch_array($result_ag,MYSQLI_ASSOC);

$sql_bk = "select count(*) as JUM from buku";
$result_bk = mysqli_query($con,$sql_bk);
$row_bk = mysqli_fetch_array($result_bk,MYSQLI_ASSOC);

$sql_peminjaman = "select count(*) as JUM from peminjaman   ";
$result_peminjaman = mysqli_query($con,$sql_peminjaman);
$row_peminjaman = mysqli_fetch_array($result_peminjaman,MYSQLI_ASSOC);

if ($row['id_role']== 1 || $row['id_role']== 2){
?>
<div id="page-wrapper">
	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
	</div>
	
	<div class="row">
		<div class="col-lg-3 col-md-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $row_pj['JUM'];?></div>
										<div>Peminjaman</div>
									</div>
								</div>
							</div>
							<a href="data-peminjaman.php">
								<div class="panel-footer">
									<span class="pull-left">Lihat Detail</span>
									<span class="pull-right"></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
		</div>
		
		<div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row_ag['JUM'];?></div>
                                    <div>Anggota Baru</div>
                                </div>
                            </div>
                        </div>
                        <a href="data-anggota.php">
                            <div class="panel-footer">
                                <span class="pull-left">Lihat Detail</span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
        </div>
		
		<div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row_bk['JUM'];?></div>
                                    <div>Buku Baru</div>
                                </div>
                            </div>
                        </div>
                        <a href="data-buku.php">
                            <div class="panel-footer">
                                <span class="pull-left">Lihat Detail</span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
         </div>
	</div>
</div>
<?php
	}else{
?>
<div id="page-wrapper">
	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
	</div>
	
	<div class="row">
		<div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row_peminjaman['JUM'];?></div>
                                    <div>Total Peminjaman</div>
                                </div>
                            </div>
                        </div>
                        <a href="history_peminjaman.php?id=<?php echo $row_jb['ID'];?>">
                            <div class="panel-footer">
                                <span class="pull-left">Lihat Detail</span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
        </div>
	</div>
</div>
<?php
	}
?>

<?php 
include("footer.php");
?>