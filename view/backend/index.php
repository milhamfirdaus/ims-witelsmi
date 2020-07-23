<?php get_view('header');?>
<!-- Start content -->
<div class="content">
    <div class="container">

    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <button type="button" class="btn btn-default dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">Jalan Pintas<span class="m-l-5"><i class="caret"></i></span></button>
                <ul class="dropdown-menu drop-menu-right" role="menu">
                    <li><a href="barang#tambah">Tambah Barang</a></li>
                    <li><a href="user#tambah">Tambah User</a></li>
                </ul>
            </div>
            <h4 class="page-title"><?=title();?></h4>
            <p class="text-muted page-title-alt">Selamat Datang</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="widget-panel widget-style-2 bg-white" id="witel">
                <i class="md md-place text-info"></i>
                <h2 class="m-0 text-dark counter font-600"><?=$this->witel_model->count();?></h2>
                <a href="<?=set_url('witel');?>">Witel</a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-people text-custom"></i>
                <h2 class="m-0 text-dark counter font-600"><?=$this->user_model->count();?></h2>
                <a href="<?=set_url('user');?>">Admin dan User</a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="text-primary md md-computer"></i>
                <h2 class="m-0 text-dark counter font-600"><?=$this->barang_model->count();?></h2>
                <a href="<?=set_url('barang');?>">Inventaris</a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="widget-panel widget-style-2 bg-white" id="user">
                <i class="text-primary md md-launch"></i>
                <h2 class="m-0 text-dark counter font-600"><?=$this->barangkeluar_model->count();?></h2>
                <a href="<?=set_url('keluar/riwayat');?>">Barang Keluar</a>
            </div>
        </div>
    </div>

   <!-- <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <div class="row">
            <div class="col-sm-12">
              <h4 class="m-t-0 header-title"><b>Cetak Laporan</b></h4>
                <p class="text-muted font-13">
                    <code>Berdasarkan Tahun</code> 
                </p>
            </div>
          </div>
          <div class="panel panel-default">
        <div class="panel-body">

            <?php echo form_open('laporan', array('id' => 'FormLaporan')); ?>
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Dari Tanggal</label>
                            <div class="col-sm-8">
                                <input type='date' name='from' class='form-control' id='tanggal_dari' value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Sampai Tanggal</label>
                            <div class="col-sm-8">
                                <input type='date' name='to' class='form-control' id='tanggal_sampai' value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

            <div class='row'>
                <div class="col-sm-5">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-primary" style='margin-left: 0px;'>Tampilkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>

            <br />
            <div id='result'></div>
        </div>
    </div>
        </div>
      </div>
    </div> -->

    </div>    
</div> 

<script>
$('#tanggal_dari').datetimepicker({
    lang:'en',
    timepicker:false,
    format:'Y-m-d',
    closeOnDateSelect:true
});
$('#tanggal_sampai').datetimepicker({
    lang:'en',
    timepicker:false,
    format:'Y-m-d',
    closeOnDateSelect:true
});

$(document).ready(function(){
    $('#FormLaporan').submit(function(e){
        e.preventDefault();

        var TanggalDari = $('#tanggal_dari').val();
        var TanggalSampai = $('#tanggal_sampai').val();

        if(TanggalDari == '' || TanggalSampai == '')
        {
            $('.modal-dialog').removeClass('modal-lg');
            $('.modal-dialog').addClass('modal-sm');
            $('#ModalHeader').html('Oops !');
            $('#ModalContent').html("Tanggal harus diisi !");
            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok, Saya Mengerti</button>");
            $('#ModalGue').modal('show');
        }
        else
        {
            var URL = "<?=set_url('admin/laporan');?>/" + TanggalDari + "/" + TanggalSampai;
            $('#result').load(URL);
        }
    });
});
</script>
<?php get_view('footer');?> 
