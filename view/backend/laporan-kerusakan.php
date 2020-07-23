<!DOCTYPE html>
<html>
  
<!-- Mirrored from coderthemes.com/ubold_2.2/light/components-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Mar 2017 14:09:04 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="<?php echo get_directory(dirname(__FILE__),'assets/');?>img/laporanlogo.ico">

    <title><?=title();?></title>

    <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/core.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/components.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_directory(dirname(__FILE__),'assets/');?>css/responsive.css" rel="stylesheet" type="text/css" />
  </head>

  <body onload="window.print();">

        <!-- Start content -->
        <div class="content">
          <div class="container">

            <!-- Page-Title -->
            <div class="row">
              <div class="col-sm-6">
                <h4 class="page-title m-t-10" style="text-align: center;">PT. TELKOM WITEL SUKABUMI</h4>
              </div>
              <div class="col-sm-6">
              </div>
              <div class="col-sm-6">
                <div class="pull-right m-t-10">
                    <img src="<?php echo get_directory(dirname(__FILE__),'assets/');?>img/laporanlogo.png" alt="user-img" class="img-circle">  
                  </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  <h4 class="m-t-0 header-title" style="text-align: center;"><b>Kerusakan Inventaris</b></h4>
                  <p class="text-muted m-b-30 font-13" style="text-align: center;">
                    PT. TELKOM WITEL SUKABUMI
                  </p>
                  <table class="table m-0" id="tbl-barang">
                  <thead>
                      <tr>
                        <th width ="5%">No</th>
                        <th width ="15%">Tanggal Kerusakan</th>
                        <th width ="10%">NIK</th>
                        <th width ="20%">Nama</th>
                        <th width ="20%">Barang</th>
                        <th width ="20%">Keterangan</th>
                      </tr>
                    </thead>
                  <tbody>
                    <?php
                    $i=1;
                    foreach ($kerusakan as $data) {

                    ?>
                    <tr>
                      <th width ="5%"><?=$i?></th>
                        <th width ="15%"><?=$data->tanggal_kerusakan?></th>
                        <th width ="10%"><?=$data->nik?></th>
                        <th width ="20%"><?=$data->nama?></th>
                        <th width ="20%"><?=$data->nama_barang?></th>
                        <th width ="20%"><?=$data->keterangan?></th>
                    </tr>
                    <?php
                    $i++;
                    }
                    ?>
                  </tbody>
                </table>
                </div>
              </div>
            </div>

          </div> <!-- container -->          
         </div> <!-- content -->
        </div>
  </body>
</html>