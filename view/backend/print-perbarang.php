<link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/core.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/components.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/icons.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/pages.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/responsive.css" rel="stylesheet" type="text/css" />
<head>
	 <title><?=title();?></title>
</head>
<body onload="window.print();">
	<div class="content">
  <div class="container">

    <!-- Page-Title and Header -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title"><?=title();?></h4>
            <ol class="breadcrumb">
              <li>
                
              </li>
            </ol>
        </div>
    </div>
    <!-- End -->

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <div class="row">
            <div class="col-sm-12">
	            	<div class="col-sm-3">   
	                 </div>
	                 <div class="col-sm-3">   
	            	<h4 class="m-t-0 header-title"><b>Laporan Barang Masuk</b></h4>  
	                 </div>
	                 <div class="col-sm-3">  
	                  <img src="<?php echo get_directory(dirname(__FILE__),'assets/');?>img/laporanlogo.png" alt="user-img" class="img-circle">  
	                 </div>
              <p class="text-muted font-13">
                <code></code> </p>
              <div class="table-bordered">
                <table class="table m-0" id="tbl-barang">
                  <thead>
                      <tr>
                        <th width ="5%">No</th>
                        <th width ="10%">Nama Barang</th>
                        <th width ="10%">Serial Number</th>
                        <th width ="10%">Jenis</th>
                        <th width ="10%">Jumlah</th>
                        <th width ="15%">Tanggal Masuk</th>
                        <th width ="10%">Kondisi</th>
                      </tr>
                    </thead>
                  <tbody>
                  	<?php
                  	$i=1;
                  	foreach ($barang as $row) {

                  	?>
                  	<tr>
                  		<th width ="5%"><?=$i?></th>
                        <th width ="15%"><?=$row->nama_barang?></th>
                        <th width ="10%"><?=$row->serial?></th>
                        <th width ="10%"><?=$row->nama_jenis?></th>
                        <th width ="10%"><?=$row->jumlah?></th>
                        <th width ="15%"><?=$row->tanggal_masuk?></th>
                        <th width ="10%"><?=$row->kondisi?></th>
                  	</tr>
                  	<?php
                  	$i++;
                  	}
                  	?>
                  </tbody>
                </table>
                <div class="controls pull-left">
                </div>
                <div class="controls pull-right">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
     


	</div><!-- container -->                           
	</div><!-- content -->
</body>
