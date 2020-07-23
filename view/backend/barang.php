<?php get_view('header');?>

<!-- Start content -->
<div class="content">
  <div class="container">

    <!-- Page-Title and Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
              <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">Pilihan <span class="caret"><i class="fa fa-arrow"></i></span></button>
                  <ul class="dropdown-menu drop-menu-right" role="menu">
                      <li><a href="<?=set_url('barang#tambah');?>">Tambah Barang</a></li>
                      <li><a href="<?=set_url('barang/laporan');?>" target="_blank">Cetak Laporan</a></li>
                  </ul>
            </div>
            <div class="btn-group pull-right m-t-15">
              <button style="margin-right: 10px;" data-toggle="dropdown" id="label-filter-barang" class="btn btn-primary dropdown-toggle waves-effect">Filter Berdasarkan Jenis  <span class="caret"></span></button>
              <ul class="dropdown-menu" id="btn-filter-barang">
                <li></li>
              </ul>
            </div>

            <h4 class="page-title"><?=title();?></h4>
            <ol class="breadcrumb">
              <li>
                <a href="<?=set_url('dashboard');?>">Halaman Utama</a>
              </li>
              <li class="active">
                Data Barang
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
              <h4 class="m-t-0 header-title"><b><?=header_title();?></b></h4>
              <p class="text-muted font-13">
                <code>Input,edit,lihat,hapus</code> Data Barang Inventaris</p>
              <div class="table-responsive">
                <form type="form-inline">
                  <div class="tools controls pull-right">
                      <input style="margin-right: 20px; margin-bottom: 20px;" class="form-control" type="text" autocomplete="off" id="search" name="search" placeholder=" Cari Nama Barang . . .">
                  </div>
                </form>
                <table class="table m-0" id="tbl-barang">
                  <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Serial Number</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Tanggal Masuk</th>
                        <th>Kondisi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                  <tbody>
                  </tbody>
                </table>
                <div class="controls pull-right">
                  <ul style="margin-right: 20px; margin-bottom: 20px;" id="pagination-barang" class="pagination"><ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
      
      
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <form role="form" id="form-barang" action="tambah">
                  <fieldset>
                    <div class="col-sm-6">
                      <div class="form-row">
                        <div class="form-group col-sm-6">
                          <label>NIK Pengguna</label>
                          <input class="form-control" type="text" list="datanik" id="nik-pengguna" name="nik-pengguna" placeholder="NIK" required>
                          <datalist id="datanik">
                          </datalist>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>SP</label>
                          <input class="form-control" type="text" id="SP" name="SP" placeholder="SMV-SPxx">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Nama Barang</label>
                          <input class="form-control" type="text" id="nama-barang" name="nama-barang" placeholder="Nama Barang">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Serial Number</label>
                          <input name="serial-number" type="text" class="form-control" id="serial-number" placeholder="Serial Number" min="1" value="" maxlength="15" />
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-sm-6">
                          <label>Jenis</label>
                          <input id="jenis-barang" name="jenis-barang" list="jenis-barang-data" class="form-control"  placeholder="Pilih Jenis" required>
                          <datalist id="jenis-barang-data"> 
                          </datalist>
                          </div>                                     
                      </div>
                      <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label class="control-label" >Jumlah Barang</label>
                              <div class="controls">                            
                                  <input class="form-control" type="number" name="jumlah" id="jumlah" min="0" placeholder="0"/>
                              </div>
                          </div>
                          <div class="form-group col-sm-6">
                              <label>Kondisi</label>
                              <input name="kondisi" list="kondisi" class="form-control" placeholder="Kondisi" placeholder="Pilih Kondisi" required>
                                <datalist id="kondisi"> 
                                  <option value="Baru">Baru</option>
                                  <option value="Rusak">Rusak</option>
                                </datalist>
                          </div>
                      </div>
                      <div class="form-group col-sm-6">
                          <label>Tanggal Masuk</label>
                          <input class="form-control" type="date" id="tanggal-masuk" name="tanggal-masuk">
                      </div>
                      <div class="form-group col-sm-12">
                          <label>Keterangan</label>
                          <textarea class="form-control" rows="6" id="keterangan-barang" name="keterangan-barang"></textarea>
                      </div>
                        <input type="hidden" name="mass_action_type" id="mass_action_type"/>
                        <input type="hidden" name="hidden-id" id="hidden-id"/>
                    </div>
                    
                    <div class="col-sm-6">                      
                      <div class="form-group col-sm-6">
                        <label class="control-label">Photo Barang</label>
                          <div class="controls">                            
                            <input type="file" name="userfile" id="userfile"/>
                          </div>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="button" id="submit-barang" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->










  </div><!-- container -->                           
</div><!-- content -->
<?php get_view('footer');?> 
