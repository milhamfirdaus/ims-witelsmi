<?php get_view('header');?>

<!-- Start content -->
<div class="content">
  <div class="container">

    <!-- Page-Title and Header -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title"><?=title();?></h4>
            <ol class="breadcrumb">
              <li>
                <a href="<?=set_url('dashboard');?>">Halaman Utama</a>
              </li>
              <li>
                <a href="<?=set_url('keluar');?>">Barang Keluar</a>
              </li>
              <li class="active">
                Riwayat Barang Keluar
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
              <h4 class="m-t-0 header-title"><b>Riwayat Barang Keluar</b></h4>
              <p class="text-muted font-13">
                <code>Lihat,cari,hapus</code>Barang Keluar</p>
              <div class="table-responsive">
                <form type="form-inline">
                  <div class="controls pull-right">
                      <div class="btn-group">
                        <button data-toggle="dropdown" id="label-filter-riwayat" class="btn btn-primary btn-sm dropdown-toggle"> Filter Berdasarkan Jenis  <span class="caret"></span></button>
                        <ul class="dropdown-menu" id="btn-filter-riwayat">
                          <li></li>
                        </ul>
                      </div>        
                  </div>
                  <div class="tools controls pull-left">
                      <input style="margin-right: 20px; margin-bottom: 20px;" class="form-control" type="text" autocomplete="off" id="search" name="search" placeholder=" Cari Nama Barang . . .">
                  </div>
                </form>
                <table class="table m-0" id="tbl-riwayat">
                  <thead>
                      <tr>
                        <th width ="17%">NIK Penerima</a></th>
                        <th width ="13%">ID Barang</th>
                        <th width ="10%">ID Witel</th>
                        <th width ="12%">IP</th>
                        <th width ="10%">Tanggal Keluar</th>
                        <th width ="10%">Jumlah</th>
                        <th width="5%" class="td-actions"> Aksi </th>
                      </tr>
                    </thead>
                  <tbody>
                  </tbody>
                </table>
                <div class="controls pull-right">
                  <ul style="margin-right: 20px; margin-bottom: 20px;" id="pagination-riwayat" class="pagination"><ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      












  </div><!-- container -->                           
</div><!-- content -->
<?php get_view('footer');?> 
