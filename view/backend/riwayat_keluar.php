<?php get_view('header');?>

<!-- Start content -->
<div class="content">
  <div class="container">

    <!-- Page-Title and Header -->
    <div class="row">
        <div class="col-sm-12">
          <div class="btn-group pull-right m-t-15">
              <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">Cetak<span class="m-l-5"><i class="fa fa-arrow"></i></span></button>
                  <ul class="dropdown-menu drop-menu-right" role="menu">
                      <li><a href="<?=set_url('keluar/laporan');?>" target="_blank">Cetak Laporan</a></li>
                  </ul>
            </div>
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
                  </div>
                  <div class="tools controls pull-left">
                      <input style="margin-right: 20px; margin-bottom: 20px;" class="form-control" type="text" autocomplete="off" id="search" name="search" placeholder=" Cari Nama Barang . . .">
                  </div>
                </form>
                <table class="table m-0" id="tbl-riwayat">
                  <thead>
                      <tr>
                        <th width ="5%">No</a></th>
                        <th width ="7%  ">NIK</a></th>
                        <th width ="15%">Nama</th>
                        <th width ="13%">Nama Barang</th>
                        <th width ="12%">IP Barang</th>
                        <th width ="10%">Tanggal Keluar</th>
                        <th width ="10%">Jumlah</th>
                        <th width="5%" class="td-actions"> Aksi </th>
                      </tr>
                    </thead>
                  <tbody>
                  </tbody>
                </table>
                <div class="controls pull-right">
                  <ul style="margin-right: 20px; margin-bottom: 20px;" id="pagination-riwayat-keluar" class="pagination"><ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      



                






<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <form role="form" id="form-riwayat-keluar" action="simpan">
                  <fieldset>
                    <div class="col-sm-12" id="form-view">
                    </div>
                    <input type="hidden" id="hidden-id" name="hidden-id">
                  </fieldset>
                </form>
              </div>
            <div class="modal-footer">
                <button type="button" id="print" class="btn btn-primary waves-effect waves-light">Print</button>
                <button type="button" id="submit-riwayat-keluar" class="btn btn-danger waves-effect waves-light">Print</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


  </div><!-- container -->                           
</div><!-- content -->

<?php get_view('footer');?> 
