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
              <li class="active">
                Data Kerusakan Barang
              </li>
            </ol>
        </div>
    </div>
    <!-- End -->

    <!-- Page-Content -->
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <div class="row">
            <div class="col-sm-12">
              <h4 class="m-t-0 header-title"><b>Input Data Kerusakan Barang</b></h4>
              <p class="text-muted font-13">
                <code>Cari,input,lihat,hapus</code> Data kerusakan</p>
                <form role="form" id="form-cari">
                    <label >Cari Nama Barang :</label>
                      <div class="form-inline">
                          <input type="text" margin-bottom: 20px;" autocomplete="off" id="search" name="search">
                          <a href="#" style="margin-bottom:2px;" class="btn btn-success btn-sm" id="clear-table">Reset</a>
                      </div>
                </form>
                <hr>
                <div class="table-responsive">
                <table class="table m-0" id="tbl-kerusakan">
                  <thead>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <div class="controls pull-right">
                  <ul style="margin-right: 20px; margin-bottom: 20px;" id="pagination-kerusakan" class="pagination"><ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End -->


<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <form role="form" id="form-kerusakan" action="simpan">
                  <fieldset>
                    <div class="col-sm-6" id="form-view">
                    </div>
                    <div class="col-sm-6" id="form-input">
                        <div class="form-group col-md-12">
                            <label>Tanggal Kerusakan</label>
                            <input class="form-control" type="date" placeholder="DD/MM/YYYY" id="tanggal-kerusakan" name="tanggal-kerusakan" max="">
                        </div>
                        <div class="form-group col-md-12">
                          <label>NIK</label>
                          <input class="form-control" type="text" list="datanik" id="nik" name="nik" placeholder="NIK" required>
                          <datalist id="datanik">
                          </datalist>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jumlah</label>
                            <input class="form-control" type="number" id="jumlah-kerusakan" name="jumlah-kerusakan"  min="0" value="0" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Keterangan</label>
                            <textarea class="form-control" rows="2" id="keterangan-kerusakan" name="keterangan-kerusakan"></textarea>
                        </div>
                        <input type="hidden" id="hidden-id" name="hidden-id">
                        <input type="hidden" id="hidden-barang" name="hidden-barang">
                    </div>
                  </fieldset>
                </form>
              </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                <button type="button" id="submit-kerusakan" class="btn btn-primary waves-effect waves-light">Simpan</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


  </div><!-- container -->                           
</div><!-- content -->
<?php get_view('footer');?> 
