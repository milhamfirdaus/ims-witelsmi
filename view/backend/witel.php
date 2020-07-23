<?php get_view('header');?>

<!-- Start content -->
<div class="content">
  <div class="container">

    <!-- Page-Title and Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
              <a href="<?=set_url('witel#tambah');?>" class="btn btn-primary btn-md">Tambah</a>
            </div>
            <h4 class="page-title"><?=title();?></h4>
            <ol class="breadcrumb">
              <li>
                <a href="<?=set_url('dashboard');?>">Halaman Utama</a>
              </li>
              <li class="active">
                Data Witel
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
              <h4 class="m-t-0 header-title"><b>Table Witel & Datel</b></h4>
              <p class="text-muted font-13">
                <code>Input,edit,lihat,hapus</code> Data Witel & Datel</p>
              <div class="table-responsive">
                <form type="form-inline">
                  <div class="tools controls pull-left">
                      <input style="margin-right: 20px; margin-bottom: 20px;" class="form-control" type="text" autocomplete="off" id="search" name="search" placeholder=" Cari Nama witel . . .">
                  </div>
                </form>
                <table class="table m-0" id="tbl-witel">
                  <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                  <tbody>
                  </tbody>
                </table>
                <div class="controls pull-right">
                  <ul style="margin-right: 20px; margin-bottom: 20px;" id="pagination-witel" class="pagination"><ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
            </div>
            <div class="modal-body">
              <div class="row">
              <form role="form" id="form-witel" action="tambah">
                <div class="form-row">
                      <div class="form-group col-md-6">
                          <label>Nama witel</label>
                          <input class="form-control" type="text" id="witel-datel" name="witel-datel">
                      </div>
                  </div>
                  <div class="form-group col-sm-12">
                      <label>Lokasi Witel</label>
                      <textarea class="form-control" rows="7" id="lokasi" name="lokasi" ></textarea>
                  </div>
                  <input type="hidden" name="mass_action_type" id="mass_action_type"/>
                  <input type="hidden" name="hidden-id" id="hidden-id"/>
              </form>
              </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="button" id="submit-witel" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->










  </div><!-- container -->                           
</div><!-- content -->
<?php get_view('footer');?> 
