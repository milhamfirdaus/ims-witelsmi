<?php get_view('header');?>

<!-- Start content -->
<div class="content">
  <div class="container">

    <!-- Page-Title and Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
              <a href="<?=set_url('user#tambah');?>" class="btn btn-primary btn-md">Tambah</a>
            </div>
            <h4 class="page-title"><?=title();?></h4>
            <ol class="breadcrumb">
              <li>
                <a href="<?=set_url('dashboard');?>">Halaman Utama</a>
              </li>
              <li class="active">
                Data user
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
              <h4 class="m-t-0 header-title"><b>Data User</b></h4>
              <p class="text-muted font-13">
                <code>Klik NIK User untuk melihat detail data user</code>
              <div class="table-responsive">
                <form type="form-inline">
                  <div class="tools controls pull-right">
                      <input style="margin-right: 20px; margin-bottom: 20px;" class="form-control" type="text" autocomplete="off" id="search" name="search" placeholder=" Cari Nama User . . .">
                  </div>
                </form>
                <table class="table m-0" id="tbl-user">
                  <thead>
                      <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Group</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                  <tbody>
                  </tbody>
                </table>
                <div  style="float:left;">
                  <br>
                  <p id="jumlah-data">
                  </p>
                </div>
                <div class="controls pull-right">
                  <ul style="margin-right: 20px; margin-bottom: 20px;" id="pagination-user" class="pagination"><ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                
                <div class="col-sm-12">
                  <form role="form" id="form-user" action="tambah">
                    <fieldset>
                      <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group col-md-6">
                              <label>NIK</label>
                              <input class="form-control" type="number" id="nik" name="nik" required="" placeholder="NIK" autocomplete="off">
                            </div>

                            <div class="form-group col-md-6">
                              <label>Password</label>
                              <input class="form-control" type="password" name="password" id="password" required="**********" placeholder="" autocomplete="off">
                            </div>
                            <div class="form-group col-md-6">
                              <label>Nama Lengkap</label>
                              <input class="form-control" type="text" name="nama-user" id="nama-user" required="" placeholder="Nama lengkap" autocomplete="off"> 
                            </div> 

                            <div class="form-group col-md-6">
                              <label>Jabatan</label>
                              <input class="form-control" type="text" id="jabatan" name="jabatan" required="" placeholder="Jabatan">
                            </div>  

                            <div class="form-group col-md-6">
                              <label>Group</label>
                              <select class="form-control" id="group-user" name="group-user" required="" placeholder="Pilih">
                                      <option value="Admin">Admin</option>
                                      <option value="User">User</option>
                              </select>
                            </div>

                            <div class="form-group col-md-6">
                              <label>Jenis Kelamin</label>
                              <select class="form-control" id="jenis-kelamin" name="jenis-kelamin" placeholder="Pilih">
                                      <option value="Laki-Laki">Laki-Laki</option>
                                      <option value="Perempuan">Perempuan</option>
                              </select>
                            </div>

                            <div class="form-group col-md-12">
                              <label>Email</label>
                              <input class="form-control" type="email" name="email" id="email" required="" placeholder="Email">
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="form-group col-md-6">
                              <label>No Handphone</label>
                              <input class="form-control"  type="text" maxlength="13" name="handphone" id="handphone" placeholder="Nomor Handphone" required>
                            </div>

                            <div class="form-group col-sm-12">
                              <label for="email">Alamat</label>
                              <textarea class="form-control" rows="3" id="alamat" name="alamat" required="" placeholder="Alamat Lengkap"></textarea>
                            </div>
                            <!--<div class="form-group col-md-6">
                              <br><label> Ulangi Password :</label>
                              <input class="form-control" style="margin-top: 4px;" type="password" name="ulangi-password" id="ulangi-password" required="">
                            </div>-->
                        </div>
                        <input type="hidden" name="hidden-id" id="hidden-id"/>
                      </div>
                    </fieldset>
                  </form>
                  
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button type="button" id="submit-user" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





  </div><!-- container -->                           
</div><!-- content -->
<?php get_view('footer');?> 
