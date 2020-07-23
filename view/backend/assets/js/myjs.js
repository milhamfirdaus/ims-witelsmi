var path = window.location.pathname;
var host = window.location.hostname;

//1
var delay = (function(){
    var timer = 0;
    return function(callback,ms){
        clearTimeout(timer);
        timer = setTimeout(callback,ms);
    };
})();

$(function(){
    $(window).hashchange(function(){
            var hash = $.param.fragment();
        
            if (hash == 'tambah'){
                if (path.search('admin/barang/jenis') > 0){

                    /*Tampilan form mymodal*/
                    $('#myModal .modal-header #myModalLabel').text('Tambah Jenis Barang');
                    $('#myModal .modal-footer #submit-jenis').text('Tambah');
                    $('#myModal #form-jenis').attr('action', 'tambah');   
                    $('#myModal .modal-body #hidden-id').val("");
                }

                else if (path.search('admin/barang') > 0){
                    var jenis_barang = getJSON('http://'+host+path+'/jenis/ambil',{});
                    var nik = getJSON('http://'+host+path+'/action/ambil',{});
                    
                    /* Upload */
                    ajax_upload('barang');
                    
                    /* Input Pilih NIK */
                    $('#datanik option').remove();
                    if(nik.all_nik){
                      $.each(nik.all_nik, function(key, value) {
                           $('#datanik').append('<option value="'+value['nik']+'">'+value['nik']+'</option>');
                      });          
                    }

                    /* Input Pilih NIK */
                    $('#jenis-barang-data option').remove();
                    if(jenis_barang.all_jenis){
                      $.each(jenis_barang.all_jenis, function(key, value) {
                           $('#jenis-barang-data').append('<option value="'+value['nama_jenis']+'">'+value['nama_jenis']+'</option>');
                      });          
                    }

                    /*Tampilan dan fungsi pada form mymodal*/
                    $('#myModal .modal-header #myModalLabel').text('Tambah Barang');
                    $('#myModal .modal-footer #submit-barang').text('Tambah');
                    $('#myModal #form-barang').attr('action','tambah');
                    $('#myModal form').find("input[id='jenis-barang']").val("");
                    $('#myModal .modal-body #hidden-id').val("");
                }  

                else if (path.search('admin/witel') > 0){

                    /*Tampilan dan fungsi pada form mymodal*/
                    $('#myModal .modal-header #myModalLabel').text('Tambah Data Witel');
                    $('#myModal .modal-footer #submit-witel').text('Tambah');
                    $('#myModal #form-witel').attr('action','tambah');
                } 

                else if (path.search('admin/user') > 0){

                    /*Tampilan dan fungsi pada form mymodal*/
                    $('#myModal .modal-header #myModalLabel').text('Tambah User');
                    $('#myModal .modal-footer #submit-user').text('Tambah');
                    $('#myModal #form-user').attr('action','tambah');
                    $('#myModal .modal-body #hidden-id').val("");
                }

                /*Fungsi Keseluruhan untuk Hashchange Tambah*/
                $('#myModal').modal('show');
            }

            else if (hash.search('edit') == 0){
                if (path.search('admin/barang/jenis') > 0){

                    var id_jenis = geturlvar()['id'];
                    var detailjenis = getJSON('http://'+host+path+'/ambil',{id:id_jenis});
                    
                    /*Tampilan dan fungsi pada form mymodal*/                                                                                                                                                                               
                    $('#myModal form').find("input[name='nama-jenis']").val(detailjenis.data['nama_jenis']);
                    $('#myModal form').find("textarea[name='deskripsi']").val(detailjenis.data['deskripsi']);
                    $('#myModal .modal-header #myModalLabel').text('Edit Jenis');
                    $('#myModal .modal-footer #submit-jenis').text('Update');
                    $('#myModal #form-jenis').attr('action','update'); 
                    $('#myModal .modal-body #hidden-id').val(id_jenis);
                }

                else if (path.search('admin/barang') > 0){
                    
                    var id_barang = geturlvar()['id'];
                    var jenis_barang = getJSON('http://'+host+path+'/jenis/ambil',{});
                    var detailbarang = getJSON('http://'+host+path+'/action/ambil',{id:id_barang});

                    $.each(detailbarang.data['barang_attribute'],function(key,value){
                      if(key == 'file_original' && value != ''){
                        $('#userfile').before(
                            '<div class="form-row" id="form-row-file">'+
                            '   <div class="form-group">'+
                            '       <a id="file_original" target="_blank" href=""><img src="" id="gambar_barang" class="featured_image"/></a>'+
                            '   </div>'+
                            '   <div class="form-group" id="form-file" action="hapus">'+
                            '       <input type="hidden" id="file_original" name="file_original" value=""/>'+
                            '       <input type="hidden" id="file_thumbnail" name="file_thumbnail" value=""/>'+
                            '       <input type="text" class="form-control" id="file_dir_original" name="file_dir_original" value=""/ readonly>' +
                            '       <br id="spacing">'+
                            '       <button id="hapus_gambar" class="btn btn-danger btn-sm">Hapus Gambar</button>'+
                            '   </div>'+
                            '</div>'
                          );
                        $('#userfile').hide();              
                      }      

                      if(value != "") $('#'+key).attr('value', value).prop('checked', true);
                      if(value != "") $('#'+key).attr('href', value).prop('checked', true);
                      
                      if(key == 'file_thumbnail' && value != ''){
                        $('#gambar_barang').attr('src', value);
                      }
                    });    
                    
                    $('#jenis-barang-data option').remove()
                    if(jenis_barang.all_jenis){
                      $.each(jenis_barang.all_jenis, function(key, value) {
                           $('#jenis-barang-data').append('<option value="'+value['nama_jenis']+'">'+value['nama_jenis']+'</option>');
                      });          
                    }

                    ajax_upload('barang');
                    $('#myModal #form-barang #hidden-id').val(id_barang);  

                    $('#myModal form').find("input[id='nama-barang']").val(detailbarang.data['nama_barang']);
                    $('#myModal form').find("input[id='serial-number']").val(detailbarang.data['serial']);
                    $('#myModal form').find("input[name='jenis-barang']").val(detailbarang.data['nama_jenis']);
                    $('#myModal form').find("input[id='jumlah']").val(detailbarang.data['jumlah']); 
                    $('#myModal form').find("input[name='kondisi']").val(detailbarang.data['kondisi']); 
                    $('#myModal form').find("textarea[id='keterangan-barang']").val(detailbarang.data['keterangan']);
                    $('#myModal form').find("input[id='tanggal-masuk']").val(detailbarang.data['tanggal_masuk']); 
                    $('#myModal form').find("input[id='nik-pengguna']").val(detailbarang.data['nik_pengguna']); 
                    $('#myModal form').find("input[id='SP']").val(detailbarang.data['SP']);

                    //-----------------------------------------------------------//
                    $('#myModal .modal-header #myModalLabel').text('Edit Barang');
                    $('#myModal .modal-footer #submit-barang').text('Update');
                    $('#myModal #form-barang').attr('action','update'); 
                } 

                else if (path.search('admin/witel') > 0){

                    var id_witel = geturlvar()['id'];
                    var detailwitel = getJSON('http://'+host+path+'/action/ambil',{id:id_witel});
                                                                                                                                         
                    $('#myModal form').find("input[name='witel-datel']").val(detailwitel.data['witel_datel']);
                    $('#myModal form').find("textarea[name='lokasi']").val(detailwitel.data['lokasi']);
                    $('#myModal #form-witel #hidden-id').val(id_witel);

                    $('#myModal .modal-header #myModalLabel').text('Edit Data Witel');
                    $('#myModal .modal-footer #submit-witel').text('Update');
                    $('#myModal #form-witel').attr('action','update'); 
                }

                else if (path.search('admin/user') > 0){

                    var id_user = geturlvar()['id'];
                    var detailuser = getJSON('http://'+host+path+'/action/ambil',{id:id_user});
                                                                                                                                 
                    $('#myModal form').find("input[name='nik']").val(detailuser.data['nik']);
                    $('#myModal form').find("input[name='nama-user']").val(detailuser.data['nama_lengkap']);
                    $('#myModal form').find("input[id='password']").val(detailuser.data['password']);
                    $('#myModal form').find("input[name='jabatan']").val(detailuser.data['jabatan']);
                    $('#myModal form').find("textarea[name='alamat']").val(detailuser.data['alamat']);
                    $('#myModal form').find("select[name='jenis-kelamin']").val(detailuser.data['jenis_kelamin']);
                    $('#myModal form').find("input[name='handphone']").val(detailuser.data['handphone']);
                    $('#myModal form').find("select[name='group']").val(detailuser.data['group']);
                    $('#myModal form').find("input[name='email']").val(detailuser.data['email']);

                    $('#myModal #form-user #hidden-id').val(id_user);

                    $('#myModal .modal-header #myModalLabel').text('Edit Data User');
                    $('#myModal .modal-footer #submit-user').text('Update');
                    $('#myModal #form-user').attr('action','update'); 
                }

                $('#myModal').modal('show');
            }

            else if (hash.search('detail') == 0){
                if (path.search('admin/barang') > 0){

                    var id_barang = geturlvar()['id'];
                    var detailbarang = getJSON('http://'+host+path+'/action/ambil',{id:id_barang});

                    $('#myModal form').hide();
                    $('#myModal #form-barang #hidden-id').val(id_barang);
                    $('#myModal .modal-header #myModalLabel').text('Detail '+detailbarang.data['nama_barang']);
                    $('#myModal .modal-footer #submit-barang').hide();
                    $('#myModal .modal-body').prepend(
                    '<div id="lihat-notif" class="form-group col-sm-8">'+
                    '<pre>'+
                    '<b>Nama Barang</b>     : '+detailbarang.data['nama_barang']+'<br>'+
                    '<b>Serial Barang</b>   : '+detailbarang.data['serial']+'<br>'+
                    '<b>SP</b>              : '+detailbarang.data['SP']+'<br>'+
                    '<b>Jenis Barang</b>    : '+detailbarang.data['nama_jenis']+'<br>'+
                    '<b>Tanggal Masuk</b>   : '+detailbarang.data['tanggal_masuk']+'<br>'+
                    '<b>NIK Pengguna</b>    : '+detailbarang.data['nik_pengguna']+'<br>'+
                    '<b>Jumlah</b>          : '+detailbarang.data['jumlah']+'<br>'+
                    '<b>Kondisi</b>         : '+detailbarang.data['kondisi']+'<br>'+
                    '<b>Keterangan</b>      : '+detailbarang.data['keterangan']+'<br>'+
                    '</pre>'+
                    '</div>'+
                    '<div id="lihat-gambar" class="form-group col-sm-4">'+
                    '</div>'
                    );

                    $.each(detailbarang.data['barang_attribute'],function(key,value){
                      if(key == 'file_original' && value != ''){
                        $('#lihat-gambar').append(
                            '<div class="form-row" id="form-row-file">'+
                            '   <div class="form-group">'+
                            '       <img src="" id="gambar_barang" class="featured_image"/>'+
                            '<br>'+
                            '       <a class="btn btn-primary btn-sm" id="file_original" target="_blank" href="" style="margin-top: 8px;"> Lihat Gambar</a>'+
                            '   </div>'+
                            '</div>'
                          );        
                      }      

                      if(value != "") $('#'+key).attr('value', value).prop('checked', true);
                      if(value != "") $('#'+key).attr('href', value).prop('checked', true);
                      
                      if(key == 'file_thumbnail' && value != ''){
                        $('#gambar_barang').attr('src', value);
                      }
                    });
                } 

                else if (path.search('admin/user') > 0){

                    var id_user = geturlvar()['id'];
                    var detailuser = getJSON('http://'+host+path+'/action/ambil',{id:id_user});

                    $('#myModal form').hide();
                    $('#myModal #form-user #hidden-id').val(id_user);
                    $('#myModal .modal-header #myModalLabel').text('Detail '+detailuser.data['nama_lengkap']);
                    $('#myModal .modal-footer #submit-user').hide();
                    $('#myModal .modal-body').prepend(
                    '<div class="form-group col-md-12" id="lihat-notif">'+
                    '<pre>'+
                    '<b>NIK</b>                     : '+detailuser.data['nik']+'<br>'+
                    '<b>Nama Lengkap</b>            : '+detailuser.data['nama_lengkap']+'<br>'+
                    '<b>Email</b>                   : '+detailuser.data['email']+'<br>'+
                    '<b>Jabatan</b>                 : '+detailuser.data['jabatan']+'<br>'+
                    '<b>Jenis Kelamin</b>           : '+detailuser.data['jenis_kelamin']+'<br>'+
                    '<b>Nomor Handphone</b>         : '+detailuser.data['handphone']+'<br>'+
                    '<b>Alamat</b>                  : '+detailuser.data['alamat']+'<br>'+
                    '</pre>'+
                    '</div>'
                    );
                }

                else if (path.search('admin/keluar/riwayat') > 0){
                    var id_keluar = geturlvar()['id'];
                    var detailbarang = getJSON('http://'+host+path+'/ambil',{id:id_keluar});

                    $('#myModal .modal-header #myModalLabel').text('Barang Keluar :  '+detailbarang.data['nama_barang']);
                    $('#myModal .modal-body #hidden-id').val(id_keluar);
                    $('#myModal .modal-body').find('#form-view').prepend(
                    '<div class="form-group col-md-12" id="lihat-notif">'+
                    '<pre>'+
                    '<b>NIK</b>                     : '+detailbarang.data['nik']+'<br>'+
                    '<b>Nama Penanggung Jawab</b>   : '+detailbarang.data['nama']+'<br>'+
                    '<b>Nama Barang</b>             : '+detailbarang.data['nama_barang']+'<br>'+
                    '<b>Witel / Datel</b>           : '+detailbarang.data['witel_datel']+'<br>'+
                    '<b>IP Barang</b>               : '+detailbarang.data['ip']+'<br>'+
                    '<b>Tanggal Keluar</b>          : '+detailbarang.data['tanggal_keluar']+'<br>'+
                    '<b>Jumlah</b>                  : '+detailbarang.data['jumlah']+'<br>'+
                    '<b>Keterangan</b>              : '+detailbarang.data['keterangan']+'<br>'+
                    '</pre>'+
                    '</div>'
                    );
                }

                else if (path.search('admin/keluar') > 0){

                    var id_barang = geturlvar()['id'];
                    var detailbarang = getJSON('http://'+host+path+'/action/ambil',{id:id_barang});
                    
                    /* Input Pilih NIK */
                    $('#datanik option').remove();
                    if(detailbarang.all_nik){
                      $.each(detailbarang.all_nik, function(key, value) {
                           $('#datanik').append('<option value="'+value['nik']+'">'+value['nik']+'</option>');
                      });          
                    }

                    $('#datawitel option').remove();
                    if(detailbarang.all_witel){
                      $.each(detailbarang.all_witel, function(key, value) {
                           $('#datawitel').append('<option value="'+value['witel_datel']+'">'+value['witel_datel']+'</option>');
                      });          
                    }

                    $('#myModal #form-barang-keluar #hidden-id').val(id_barang);
                    $('#myModal .modal-header #myModalLabel').text('Barang Keluar : '+detailbarang.data['nama_barang']);
                    $('#myModal .modal-body #submit-barang-keluar').text('Simpan');
                    $('#myModal #form-barang-keluar').attr('action','simpan'); 
                    $('#myModal .modal-body #hidden-id').val(id_barang);
                    $('#myModal form').find("number[name='jumlah-barang']").val(detailbarang.data['jumlah']);
                    $('#myModal .modal-body #hidden-barang').val(detailbarang.data['nama_barang']);

                    $('#myModal .modal-body').find('#form-view').prepend(
                    '<div class="form-group col-md-12">'+
                    '<pre id="lihat-notif" >'+
                    '<b>Nama Barang</b>     : '+detailbarang.data['nama_barang']+'<br>'+
                    '<b>Serial Barang</b>   : '+detailbarang.data['serial']+'<br>'+
                    '<b>SP</b>              : '+detailbarang.data['SP']+'<br>'+
                    '<b>Jenis Barang</b>    : '+detailbarang.data['nama_jenis']+'<br>'+
                    '<b>Tanggal Masuk</b>   : '+detailbarang.data['tanggal_masuk']+'<br>'+
                    '<b>NIK Pengguna</b>    : '+detailbarang.data['nik_pengguna']+'<br>'+
                    '<b>Jumlah</b>          : '+detailbarang.data['jumlah']+'<br>'+
                    '<b>Keterangan</b>      : '+detailbarang.data['keterangan']+'<br>'+
                    '<b>Kondisi</b>         : '+detailbarang.data['kondisi']+'<br>'+
                    '</pre>'+
                    '</div>'
                    );
                }

                else if (path.search('admin/kerusakan/riwayat') > 0){
                    var id_barang = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/ambil',{id:id_barang}); 

                    $('#myModal .modal-header #myModalLabel').text('Barang Keluar :  '+detail.data['nama_barang']);
                    $('#myModal .modal-body #hidden-id').val(id_keluar);

                    $('#myModal .modal-body').find('#form-view').prepend(
                    '<div class="form-group col-md-12" id="lihat-notif">'+
                    '<pre>'+
                    '<b>NIK Penanggung Jawab</b>    : '+detail.data['nik']+'<br>'+
                    '<b>Nama Penanggung Jawab</b>   : '+detail.data['nama']+'<br>'+
                    '<b>Nama Barang</b>             : '+detail.data['nama_barang']+'<br>'+
                    '<b>Tanggal Kerusakan</b>       : '+detail.data['tanggal_kerusakan']+'<br>'+
                    '<b>IP Barang</b>               : '+detail.data['ip']+'<br>'+
                    '<b>Jumlah</b>                  : '+detail.data['jumlah']+'<br>'+
                    '<b>Keterangan</b>              : '+detail.data['keterangan']+'<br>'+
                    '</pre>'+
                    '</div>'
                    );             
                }

                else if (path.search('admin/kerusakan') > 0){

                    var id_barang = geturlvar()['id'];
                    var detailbarang = getJSON('http://'+host+path+'/action/ambil',{id:id_barang});
                    
                    /* Input Pilih NIK */
                    $('#datanik option').remove();
                    if(detailbarang.all_nik){
                      $.each(detailbarang.all_nik, function(key, value) {
                           $('#datanik').append('<option value="'+value['nik']+'">'+value['nik']+'</option>');
                      });          
                    }

                    $('#myModal #form-kerusakan #hidden-id').val(id_barang);
                    $('#myModal .modal-header #myModalLabel').text('Kerusakan Barang : '+detailbarang.data['nama_barang']);
                    $('#myModal .modal-body #submit-kerusakan').text('Simpan');
                    $('#myModal #form-kerusakan').attr('action','simpan'); 
                    $('#myModal .modal-body #hidden-id').val(id_barang);
                    $('#myModal form').find("number[name='jumlah-barang']").val(detailbarang.data['jumlah']);
                    $('#myModal .modal-body #hidden-barang').val(detailbarang.data['nama_barang']);

                    $('#myModal .modal-body').find('#form-view').prepend(
                    '<div class="form-group col-md-12">'+
                    '<pre id="lihat-notif" >'+
                    '<b>Nama Barang</b>     : '+detailbarang.data['nama_barang']+'<br>'+
                    '<b>Serial Barang</b>   : '+detailbarang.data['serial']+'<br>'+
                    '<b>SP</b>              : '+detailbarang.data['SP']+'<br>'+
                    '<b>Jenis Barang</b>    : '+detailbarang.data['nama_jenis']+'<br>'+
                    '<b>Tanggal Masuk</b>   : '+detailbarang.data['tanggal_masuk']+'<br>'+
                    '<b>NIK Pengguna</b>    : '+detailbarang.data['nik']+'<br>'+
                    '<b>Jumlah</b>          : '+detailbarang.data['jumlah']+'<br>'+
                    '<b>Keterangan</b>      : '+detailbarang.data['keterangan']+'<br>'+
                    '<b>Kondisi</b>         : '+detailbarang.data['kondisi']+'<br>'+
                    '</pre>'+
                    '</div>'
                    );
                }
                
                $('#myModal').modal('show');
            }

            else if (hash.search('hapus') == 0){
                if (path.search('admin/barang/jenis') > 0){
                    var id_jenis = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/ambil',{id:id_jenis});

                    $('#myModal form').hide();
                    $('#myModal .modal-header #myModalLabel').text('Hapus jenis');
                    $('#myModal .modal-footer #submit-jenis').text('Hapus');
                    $('#myModal #form-jenis').attr('action','hapus'); 
                    $('#myModal .modal-body').prepend('<p id="hapus-notif"> Apakah Anda yakin untuk menghapus Data <b>'+detail.data['nama_jenis']+'</b> ??? </p>');
                    $('#myModal #form-jenis #hidden-id').val(id_jenis);   
                } 

                else if (path.search('admin/barang') > 0){
                    var id_barang = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/action/ambil',{id:id_barang});

                    $('#myModal form').hide();
                    $('#myModal .modal-header #myModalLabel').text('Hapus Barang');
                    $('#myModal .modal-footer #submit-barang').text('Hapus');
                    $('#myModal #form-barang').attr('action','hapus'); 
                    $('#myModal .modal-body').prepend('<p id="hapus-notif"> Apakah Anda yakin untuk menghapus Data <b>'+detail.data['nama_barang']+'</b> ??? </p>');
                    $('#myModal #form-barang #hidden-id').val(id_barang);   
                } 

                else if (path.search('admin/witel') > 0){
                    var id_witel = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/action/ambil',{id:id_witel});

                    $('#myModal form').hide();
                    $('#myModal .modal-header #myModalLabel').text('Hapus Data Witel');
                    $('#myModal .modal-footer #submit-witel').text('Hapus');
                    $('#myModal #form-witel').attr('action','hapus'); 
                    $('#myModal .modal-body').prepend('<p id="hapus-notif"> Apakah Anda yakin untuk menghapus Data <b>'+detail.data['witel_datel']+'</b> ??? </p>');
                    $('#myModal #form-witel #hidden-id').val(id_witel);   
                }

                else if (path.search('admin/user') > 0){
                    var id_user = geturlvar()['id'];
                    var detailuser = getJSON('http://'+host+path+'/action/ambil',{id:id_user});

                    $('#myModal form').hide();
                    $('#myModal .modal-header #myModalLabel').text('Hapus User');
                    $('#myModal .modal-footer #submit-user').text('Hapus');
                    $('#myModal #form-user').attr('action','hapus'); 
                    $('#myModal .modal-body').prepend('<p id="hapus-notif"> Apakah Anda yakin untuk menghapus Data <b>'+detailuser.data['nik']+'</b> ??? </p>');
                    $('#myModal #form-user #hidden-id').val(id_user);   
                } 

                else if (path.search('admin/keluar/riwayat') > 0){
                    var id_keluar = geturlvar()['id'];
                    var detailkeluar = getJSON('http://'+host+path+'/ambil',{id:id_keluar});

                    $('#myModal form').hide();
                    $('#myModal .modal-header #myModalLabel').text('Hapus Data');
                    $('#myModal .modal-footer #print').hide();
                    $('#myModal .modal-footer #submit-riwayat-keluar').show();
                    $('#myModal .modal-footer #submit-riwayat-keluar').text('Hapus');
                    $('#myModal #form-riwayat-keluar').attr('action','hapus'); 
                    $('#myModal .modal-body').prepend('<p id="hapus-notif"> Apakah Anda yakin untuk menghapus Data Barang Keluar dengan nama : <b>'+detailkeluar.data['nama_barang']+'</b> ??? </p>');
                    $('#myModal #form-riwayat-keluar #hidden-id').val(id_keluar);   
                }

                else if (path.search('admin/kerusakan/riwayat') > 0){
                    var id_kerusakan = geturlvar()['id'];
                    var detail = getJSON('http://'+host+path+'/ambil',{id:id_kerusakan});

                    $('#myModal form').hide();
                    $('#myModal .modal-header #myModalLabel').text('Hapus Data');
                    $('#myModal .modal-footer #print').hide();
                    $('#myModal .modal-footer #submit-riwayat-kerusakan').show();
                    $('#myModal .modal-footer #submit-riwayat-kerusakan').text('Hapus');
                    $('#myModal #form-riwayat-kerusakan').attr('action','hapus'); 
                    $('#myModal .modal-body').prepend('<p id="hapus-notif"> Apakah Anda yakin untuk menghapus Data Kerusakan Barang : <b>'+detail.data['nama_barang']+'</b> ??? </p>');
                    $('#myModal #form-riwayat-kerusakan #hidden-id').val(id_kerusakan);   
                }

                $('#myModal').addClass('small-modal');
                $('#myModal').modal('show');
            }
            
            else if (hash.search('ambil') == 0){
                if (path.search('admin/barang/jenis') > 0){
                
                    var hal_aktif,cari = null;
                    var hash = geturlvar();

                    if (hash['cari'] && hash['hal']){
                        var cari = hash['cari'];
                        hal_aktif = hash['hal'];
                    }
                    else if(hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    ambil_jenis(hal_aktif,true,cari);
                    $("ul#pagination-jenis li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }  

                else if (path.search('admin/barang') > 0){

                    var hal_aktif, cari, jenis = null;
                    var hash = geturlvar();

                    if(hash['jenis'] && hash['hal']){
                        var jenis = hash['jenis'];
                        hal_aktif = hash['hal'];
                        $('#label-filter-barang').text(humanize("Jenis : "+jenis));
                        $('#search').val("");
                    }
                    else if (hash['cari'] && hash['hal']){
                        var cari = hash['cari'];
                        hal_aktif = hash['hal'];
                        $('#label-filter-barang').text("Filter Berdasarkan Jenis");
                    }
                    else if (hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    ambil_barang(hal_aktif,true,jenis,cari);
                    $("ul#pagination-barang li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }

                else if (path.search('admin/witel') > 0){
                
                    var hal_aktif,cari = null;
                    var hash = geturlvar();

                     if (hash['cari'] && hash['hal']){
                        var cari = hash['cari'];
                        hal_aktif = hash['hal'];
                    }
                    else if(hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    ambil_witel(hal_aktif,true,cari);
                    $("ul#pagination-witel li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }

                else if (path.search('admin/user') > 0){
                
                    var hal_aktif,group,cari = null;
                    var hash = geturlvar();

                    if(hash['group'] && hash['hal']){
                        var group =hash['group'];
                        hal_aktif = hash['hal'];
                        $('#label-filter-user').text("Group : "+group);
                        $('#search').val("");
                    }
                    else if (hash['cari'] && hash['hal']){
                        hal_aktif = hash['hal'];
                        var cari = hash['cari'];
                        $('#label-filter-group').text("Filter Berdasarkan group");
                    }
                    else if(hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    ambil_user(hal_aktif,true,group,cari);
                    $("ul#pagination-user li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }

                else if (path.search('admin/keluar/riwayat') > 0){
                    var hal_aktif, cari = null;
                    var hash = geturlvar();

                    if (hash['cari'] && hash['hal']){
                        var cari = hash['cari'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    tampil_riwayat_keluar(hal_aktif,true,cari);
                    $("ul#pagination-riwayat-keluar li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }

                else if (path.search('admin/keluar') > 0){

                    var hal_aktif, cari, jenis = null;
                    var hash = geturlvar();

                    if(hash['jenis'] && hash['hal']){
                        var jenis = hash['jenis'];
                        hal_aktif = hash['hal'];
                        $('#label-filter-barang-keluar').text(humanize("Jenis   : "+jenis));
                        $('#search').val("");
                    }
                    else if (hash['cari'] && hash['hal']){
                        var cari = hash['cari'];
                        hal_aktif = hash['hal'];
                        $('#label-filter-barang-keluar').text("Filter Berdasarkan Jenis");

                    }
                    else if (hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    tampil_barang(hal_aktif,true,jenis,cari);
                    $("ul#pagination-barang-keluar li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }

                else if (path.search('admin/kerusakan/riwayat') > 0){
                    var hal_aktif, cari = null;
                    var hash = geturlvar();

                    if (hash['cari'] && hash['hal']){
                        var cari = hash['cari'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['hal']){
                        hal_aktif=hash['hal'];
                    }
                    tampil_riwayat_kerusakan(hal_aktif,true,cari);
                    $("ul#pagination-riwayat-kerusakan li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }

                else if (path.search('admin/kerusakan') > 0){

                    var hal_aktif, cari = null;
                    var hash = geturlvar();

                    if (hash['cari'] && hash['hal']){
                        var cari = hash['cari'];
                        hal_aktif = hash['hal'];
                    }
                    else if (hash['hal']){
                        hal_aktif = hash['hal'];
                    }
                    tampil_barang_kerusakan(hal_aktif,true,cari);
                    $("ul#pagination-kerusakan li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
                }
            }

            else if (hash.search('cetak')==0){
                if (path.search('admin/dashboard') > 0){
                    $('#myModal').addClass('small-modal');
                    $('#myModal').modal('show');
                    $('#myModal #form-laporan').attr('action','cetak'); 
                }
            }

    });

    $(window).trigger('hashchange');

    /* Fungsi Ketika Modal di Hidden */
    $('#myModal').on('hidden.bs.modal',function(){
        window.history.pushState(null,null,path);

        $('#myModal').removeClass('big-modal');
        $('#myModal #userfile').show();
        $('#myModal #hapus_gambar').remove();
        $('#myModal #file_thumbnail').remove();
        $('#myModal #file_dir_original').remove();
        $('#myModal #file_original').remove();
        $('#myModal #gambar_barang').remove();
        $('#myModal #label_file').remove();
        $('#myModal #gambar').remove();
        $('#myModal #spacing').remove();
        $('#myModal #form-row-file').remove();

        $('#myModal #form-detail-barang').hide(); 
        $('#myModal #lihat-notif').remove();
        $('#myModal #lihat-gambar').remove();
        $('#myModal #hapus-notif').remove();       
        $('#myModal form').find("input[list=nik], input[list=kondisi], input[type=date], input[type=number], input[type=text], input[type=hidden], input[type=password], input[type=email], textarea").val("");
        $('#myModal .modal-footer #submit-barang').show();
        $('#myModal .modal-footer #submit-user').show();
        $('#myModal .modal-footer #submit-riwayat-keluar').hide();
        $('#myModal .modal-footer #submit-riwayat-kerusakan').hide();
        $('#myModal form').find("select").prop("selected", false); 
        $('#myModal form').show();

        
    });

    $(document).on('keyup','#search',function(){
        delay(function(){
            var searchkey =$('#search').val();
            window.location.hash = "#ambil?cari="+searchkey+"&hal=1";
        },1000);
    });

    $(document).on('keypress','#search',function(){
        delay(function(){
            var searchkey =$('#search').val();
            window.location.hash = "#ambil?cari="+searchkey+"&hal=1";
        },1000);
    });

    $(document).on('click','#submit-cetak',function(eve){
        eve.preventDefault();
        
        var action = $('#form-laporan').attr('action');
        var datatosend = $('#form-laporan').serialize();

        $.ajax('http://'+host+path+'/action/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            success:function(data){
                if(data.status =='success'){
                    $('#myModal').modal('hide');
                }
                else{
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Data Gagal Di"+action+"!",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });

    ambil_barang();
    $(document).on('click','#submit-barang',function(eve){
        eve.preventDefault();
        
        var action = $('#form-barang').attr('action');
        var datatosend = $('#form-barang').serialize();

        $.ajax('http://'+host+path+'/action/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            success:function(data){
                if(data.status =='success'){
                    
                    ambil_barang(null,false); 
                    swal({
                        title: 'Perintah Berhasil!',
                        text: 'Data Berhasil Di'+action+'!',
                        type: 'success',
                        confirmButtonColor: '#4fa7f3'
                    });
                    $('#myModal').modal('hide');
                }
                else if(data.status =='failed'&& data.errors =='error_nik'){
                    swal({
                        title: 'Perintah Gagal!',
                        text: "NIK Tidak Ada !",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value){
                    $('#'+key).attr('placeholder',value);
                    });
                }
                else{
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Data Gagal Di"+action+"!",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    ambil_jenis();
    $(document).on('click','#submit-jenis',function(eve){
        eve.preventDefault();
        var path = window.location.pathname;
        var host = window.location.hostname;
        
        var action = $('#form-jenis').attr('action');
        var datatosend = $('#form-jenis').serialize();

        $.ajax('http://'+host+path+'/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            success:function(data){
                if(data.status =='success'){
                    ambil_jenis(null,false); 
                    swal(
                        {
                            title: 'Perintah Berhasil!',
                            text: 'Data Berhasil Di'+action+'!',
                            type: 'success',
                            confirmButtonColor: '#4fa7f3'
                        }
                    );
                    $('#myModal').modal('hide');
                }
                else{
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Data Gagal Di"+action+"!",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    ambil_witel();
    $(document).on('click','#submit-witel',function(eve){
        eve.preventDefault();
        var path = window.location.pathname;
        var host = window.location.hostname;
        
        var action = $('#form-witel').attr('action');
        var datatosend = $('#form-witel').serialize();

        $.ajax('http://'+host+path+'/action/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            success:function(data){
                if(data.status =='success'){
                    ambil_witel(null,false); 
                    swal(
                        {
                            title: 'Perintah Berhasil!',
                            text: 'Data Berhasil Di'+action+'!',
                            type: 'success',
                            confirmButtonColor: '#4fa7f3'
                        }
                    );
                    $('#myModal').modal('hide');
                }
                else{
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Data Gagal Di"+action+"!",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    ambil_user();
    $(document).on('click','#submit-user',function(eve){
        eve.preventDefault();
        
        var action = $('#form-user').attr('action');
        var datatosend = $('#form-user').serialize();

        $.ajax('http://'+host+path+'/action/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            success:function(data){
                if(data.status =='success'){
                    
                    ambil_user(null,false);
                    swal(
                        {
                            title: 'Perintah Berhasil!',
                            text: 'Data Berhasil Di'+action+'!',
                            type: 'success',
                            confirmButtonColor: '#4fa7f3'
                        }
                    );
                    $('#myModal').modal('hide');

                }

                else if(data.status =='failed' && data.errors =='tidak_lengkap'){
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Isi dengan lengkap !",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                }

                else if(data.status =='failed'&& data.errors =='error_nik'){
                    swal({
                        title: 'Perintah Gagal!',
                        text: "NIK sudah digunakan !",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value){
                    $('#'+key).attr('placeholder',value);
                    });
                }

                else if(data.status =='failed'&& data.errors =='error_email'){
                    swal({
                        title: 'Perintah Gagal!',
                        text: "E-mail sudah digunakan !",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value){
                    $('#'+key).attr('placeholder',value);
                    });
                }

                else{
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Periksa kembali",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                     
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    tampil_barang();
    $(document).on('click','#submit-barang-keluar',function(eve){
        eve.preventDefault();
        
        var action = $('#form-barang-keluar').attr('action');
        var datatosend = $('#form-barang-keluar').serialize();

        $.ajax('http://'+host+path+'/action/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            success:function(data){
                if(data.status =='success'){
                    
                    tampil_barang(null,false); 
                    swal(
                        {
                            title: 'Perintah Berhasil!',
                            text: 'Data Berhasil Di'+action+'!',
                            type: 'success',
                            confirmButtonColor: '#4fa7f3'
                        }
                    );
                    $('#myModal').modal('hide');
                }

                else if(data.status =='failed'&& data.errors =='error_jumlahkurang'){
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Maaf, Stock Barang Kurang !",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value){
                    $('#'+key).attr('placeholder',value);
                    });
                }

                else if(data.status =='failed'&& data.errors =='error_jumlahtidaktersedia'){
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Maaf, Stock Barang Tidak Ada !",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value){
                    $('#'+key).attr('placeholder',value);
                    });
                }

                else if(data.status =='failed'&& data.errors =='error_inputjumlahkosong'){
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Isi kolom Jumlah Dengan Benar!",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value){
                    $('#'+key).attr('placeholder',value);
                    });
                }

                else if(data.status =='failed'&& data.errors =='error_nik'){
                    swal({
                        title: 'Perintah Gagal!',
                        text: "NIK Tidak Ada !",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value){
                    $('#'+key).attr('placeholder',value);
                    });
                }

                else if(data.status =='failed'&& data.errors =='error_witel'){
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Witel Tidak Ada !",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value){
                    $('#'+key).attr('placeholder',value);
                    });
                }

                else{
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Data Gagal Di"+action+"!",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });
    
    tampil_riwayat_keluar();
    $(document).on('click','#submit-riwayat-keluar',function(eve){
        eve.preventDefault();
        var path = window.location.pathname;
        var host = window.location.hostname;
        
        var action = $('#form-riwayat-keluar').attr('action');
        var datatosend = $('#form-riwayat-keluar').serialize();

        $.ajax('http://'+host+path+'/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            success:function(data){
                if(data.status =='success'){
                    tampil_riwayat_keluar(null,false); 
                    swal(
                        {
                            title: 'Perintah Berhasil!',
                            text: 'Data Berhasil Di'+action+'!',
                            type: 'success',
                            confirmButtonColor: '#4fa7f3'
                        }
                    );
                    $('#myModal').modal('hide');
                }
                else{
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Data Gagal Di"+action+"!",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    tampil_barang_kerusakan();
    $(document).on('click','#submit-kerusakan',function(eve){
        eve.preventDefault();
        
        var action = $('#form-kerusakan').attr('action');
        var datatosend = $('#form-kerusakan').serialize();

        $.ajax('http://'+host+path+'/action/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            success:function(data){
                if(data.status =='success'){
                    
                    tampil_barang_kerusakan(null,false); 
                    swal(
                        {
                            title: 'Perintah Berhasil!',
                            text: 'Data Berhasil Di'+action+'!',
                            type: 'success',
                            confirmButtonColor: '#4fa7f3'
                        }
                    );
                    $('#myModal').modal('hide');
                }

                else if(data.status =='failed'&& data.errors =='error_jumlahkurang'){
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Maaf, Stock Barang Kurang !",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value){
                    $('#'+key).attr('placeholder',value);
                    });
                }

                else if(data.status =='failed'&& data.errors =='error_jumlahtidaktersedia'){
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Maaf, Stock Barang Tidak Ada !",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value){
                    $('#'+key).attr('placeholder',value);
                    });
                }

                else if(data.status =='failed'&& data.errors =='error_inputjumlahkosong'){
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Isi kolom Jumlah Dengan Benar!",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value){
                    $('#'+key).attr('placeholder',value);
                    });
                }

                else if(data.status =='failed'&& data.errors =='error_nik'){
                    swal({
                        title: 'Perintah Gagal!',
                        text: "NIK Tidak Ada !",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value){
                    $('#'+key).attr('placeholder',value);
                    });
                }

                else{
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Data Gagal Di"+action+"!",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    tampil_riwayat_kerusakan();
    $(document).on('click','#submit-riwayat-kerusakan',function(eve){
        eve.preventDefault();
        var path = window.location.pathname;
        var host = window.location.hostname;
        
        var action = $('#form-riwayat-kerusakan').attr('action');
        var datatosend = $('#form-riwayat-kerusakan').serialize();

        $.ajax('http://'+host+path+'/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
            success:function(data){
                if(data.status =='success'){
                    tampil_riwayat_kerusakan(null,false); 
                    swal(
                        {
                            title: 'Perintah Berhasil!',
                            text: 'Data Berhasil Di'+action+'!',
                            type: 'success',
                            confirmButtonColor: '#4fa7f3'
                        }
                    );
                    $('#myModal').modal('hide');
                }
                else{
                    swal({
                        title: 'Perintah Gagal!',
                        text: "Data Gagal Di"+action+"!",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                    $.each(data.errors, function(key, value) {
                    $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    $(document).on('click','#hapus_gambar' ,function(eve){
        eve.preventDefault();

        var action = $('#form-file').attr('action');
        var datatosend = $('#file_dir_original');
        $.ajax('http://'+host+'/sisfo/admin/media/action/'+action,{
            dataType:'json',
            type : 'POST',
            data : datatosend,
                success:function(data){
                    if(data.status =='success'){

                        swal(
                        {
                            title: 'Berhasil!',
                            text: 'Berhasil di'+action+'!',
                            type: 'success',
                            confirmButtonColor: '#4fa7f3'
                        }
                        );

                        $('#myModal #userfile').show();
                        $('#myModal #file_thumbnail').remove();
                        $('#myModal #file_original').remove();
                        $('#myModal #file_dir_original').remove();
                        $('#myModal #gambar_barang').remove();
                        $('#myModal #label_file').remove();
                        $('#myModal #spacing').remove();
                        $('#myModal #form-row-file').remove();
                        $('#myModal #form-file').remove();
                        $(this).remove();
                    }
                    else{
                        swal('Gagal Di'+action+'!').catch(swal.noop);
                        $.each(data.errors, function(key, value) {
                        $('#'+key).attr('placeholder', value);
                        });
                    }
                }
        });      
    });

    $(document).on('click','#clear-table' ,function(eve){

        $('table#tbl-barang-keluar tbody tr').remove();
        $('table#tbl-barang-keluar thead tr').remove();
        $('#search').val("");
        $('#pagination-barang-keluar').remove();

        $('table#tbl-kerusakan tbody tr').remove();
        $('table#tbl-kerusakan thead tr').remove();
        $('#search').val("");
        $('#pagination-kerusakan').remove();
    });
});

function humanize(str){
  str = str.replace(/-/g, ' ');
  str = str.replace(/_/g, ' ');
  return str.charAt(0).toUpperCase() + str.slice(1);
}

function ambil_barang(hal_aktif,scrolltop,jenis,cari){
        if($('table#tbl-barang').length > 0){

        $.ajax('http://'+host+path+'/action/ambil',{
            dataType:'json',
            type : 'POST',
            data : {hal_aktif:hal_aktif, jenis:jenis, cari:cari},
            success:function(data){
                var no=0;
                $('table#tbl-barang tbody tr').remove();
                $.each(data.record,function(index,element){
                    no++;
                    $('table#tbl-barang').find('tbody').append(
                    '<tr>'+
                    '    <td width ="3%">'+no+'</td>'+
                    '    <td width ="17%"><a href="barang#detail?id='+element.id_barang+'">'+element.nama_barang+'</a></td>'+
                    '    <td width ="13%">'+element.serial+'</td>'+
                    '    <td width ="10%">'+element.nama_jenis+'</td>'+
                    '    <td width ="5%">'+element.jumlah+'</td>'+
                    '    <td width ="12%">'+element.tanggal_masuk+'</td>'+
                    '    <td width ="15%">'+element.kondisi+'</td>'+
                    '    <td width="12%" class="td-actions">'+
                    '        <a href="barang#edit?id='+element.id_barang+'" class="link-edit btn btn-primary btn-sm"><i class="mdi mdi-settings"></i> Edit</a>'+
                    '        <a href="barang#hapus?id='+element.id_barang+'" class="link-edit btn btn-danger btn-sm"><i class="mdi mdi-delete"></i> Hapus</a>'+
                    '    </td>'+
                    '</tr>'
                    )
                });

            /*-----------------PAGINATION----------------------------------------*/
            var pagination ='';
            var paging = Math.ceil(data.total_rows/data.perpage);

            if ( (!hal_aktif) && ($('ul#pagination-barang li').length == 0)){
                    $('ul#pagination-barang li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li><a href="barang#ambil?hal='+i+'">'+i+'</a></li>';
                    }
            }
            else if (hal_aktif && jenis){
                $('ul#pagination-barang li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li><a href="barang#ambil?jenis='+jenis+'&hal='+i+'">'+i+'</a></li>';
                    }
            }
            else if (hal_aktif && cari){
                $('ul#pagination-barang li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li><a href="barang#ambil?cari='+cari+'&hal='+i+'">'+i+'</a></li>';
                    }
            }
                $('ul#pagination-barang').append(pagination);
                $("ul#pagination-barang li:contains('"+hal_aktif+"')").addClass('active');

            
                $('#btn-filter-barang li').remove();
                $('#btn-filter-barang').append('<li><a href="barang">Semua</a></li>');

                for(var i in data.all_jenis){
                    $('#btn-filter-barang').append('<li><a href="barang#ambil?jenis='+data.all_jenis[i]['nama_jenis']+'&hal=1">'+data.all_jenis[i]['nama_jenis']+'</a></li>');
                }

                if(scrolltop == true ){
                    $('body').scrollTop(2);
                }
            }
            });
        }
}

function ambil_jenis(hal_aktif,scrolltop,cari){
        if($('table#tbl-jenis').length > 0){
            $.ajax('http://'+host+path+'/ambil', {
            dataType : 'json',
            type : 'POST',
            data : {hal_aktif:hal_aktif, cari:cari},
            success:function(data){
                var no=0;
                $('table#tbl-jenis tbody tr').remove();
                $.each(data.record,function(index,element){
                    no++;
                    $('table#tbl-jenis').find('tbody').append(
                    '<tr>'+
                    '    <td width ="4%">'+no+'</td>'+
                    '    <td width ="20%">'+element.nama_jenis+'</td>'+
                    '    <td width ="30%">'+element.deskripsi+'</td>'+
                    '    <td width="8%" class="td-actions">'+
                    '        <a href="jenis#edit?id='+element.id_jenis+'" class="link-edit btn btn-info btn-sm">Edit</a>'+
                    '        <a href="jenis#hapus?id='+element.id_jenis+'" class="link-edit btn btn-danger btn-sm">Hapus</a>'+
                    '    </td>'+
                    '</tr>'
                    )
                });

            /*-----------------PAGINATION----------------------------------------*/
            var pagination ='';
            var paging = Math.ceil(data.total_rows/data.perpage);

            if ( (!hal_aktif) && ($('ul#pagination-jenis li').length == 0)){
                    $('ul#pagination-jenis li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li><a href="jenis#ambil?hal='+i+'">'+i+'</a></li>';
                    }
            }
            else if (hal_aktif && cari){
                $('ul#pagination-jenis li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li><a href="jenis#ambil?cari='+cari+'&hal='+i+'">'+i+'</a></li>';
                    }
            }
                $('ul#pagination-jenis').append(pagination);
                $("ul#pagination-jenis li:contains('"+hal_aktif+"')").addClass('active');

                if(scrolltop == true ){
                    $('body').scrollTop(2);
                }
            }
            });
        }
}

function ambil_witel(hal_aktif,scrolltop,cari){
        
        if($('table#tbl-witel').length > 0){
            $.ajax('http://'+host+path+'/action/ambil', {
            dataType : 'json',
            type : 'POST',
            data : {hal_aktif:hal_aktif, cari:cari},
            success:function(data){
                var no=0;
                $('table#tbl-witel tbody tr').remove();
                $.each(data.record,function(index,element){
                    no++;
                    $('table#tbl-witel').find('tbody').append(
                    '<tr>'+
                    '    <td width ="4%">'+no+'</td>'+
                    '    <td width ="20%">'+element.witel_datel+'</td>'+
                    '    <td width ="30%">'+element.lokasi+'</td>'+
                    '    <td width="8%" class="td-actions">'+
                    '        <a href="witel#edit?id='+element.id_witel+'" class="link-edit btn btn-info btn-sm">Edit</a>'+
                    '        <a href="witel#hapus?id='+element.id_witel+'" class="link-edit btn btn-danger btn-sm">Hapus</a>'+
                    '    </td>'+
                    '</tr>'
                    )
                });

            /*-----------------PAGINATION----------------------------------------*/
            var pagination ='';
            var paging = Math.ceil(data.total_rows/data.perpage);

            if ( (!hal_aktif) && ($('ul#pagination-witel li').length == 0)){
                    $('ul#pagination-witel li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li><a href="witel#ambil?hal='+i+'">'+i+'</a></li>';
                    }
            }
            else if (hal_aktif && cari){
                $('ul#pagination-witel li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li><a href="witel#ambil?cari='+cari+'&hal='+i+'">'+i+'</a></li>';
                    }
            }
                $('ul#pagination-witel').append(pagination);
                $("ul#pagination-witel li:contains('"+hal_aktif+"')").addClass('active');

                if(scrolltop == true ){
                    $('body').scrollTop(2);
                }
            }
            });
        }
}

function ambil_user(hal_aktif,scrolltop,group,cari){
        if($('table#tbl-user').length > 0){
        $.ajax('http://'+host+path+'/action/ambil',{
            dataType:'json',
            type : 'POST',
            data : {hal_aktif:hal_aktif, group:group, cari:cari},
            success:function(data){
                var no = 0;
                $('table#tbl-user tbody tr').remove();
                $.each(data.record,function(index,element){
                    no++;
                    $('table#tbl-user').find('tbody').append(
                    '<tr>'+
                    '    <td width ="5%">'+no+'</td>'+
                    '    <td width ="10%"><a href="user#detail?id='+element.id_user+'">'+element.nik+' </a></td>'+
                    '    <td width ="15%">'+element.nama_lengkap+'</td>'+
                    '    <td width ="13%">'+element.group+'</td>'+
                    '    <td width ="15%">'+element.jabatan+'</td>'+
                    '    <td width="13%" class="td-actions">'+
                    '        <a href="user#edit?id='+element.id_user+'" class="link-edit btn btn-info btn-sm">Edit</a>'+
                    '        <a href="user#hapus?id='+element.id_user+'" class="link-edit btn btn-danger btn-sm">Hapus</a>'+
                    '    </td>'+
                    '</tr>'
                    )
                });
            /*-----------------PAGINATION----------------------------------------*/
            var pagination ='';
            var paging = Math.ceil(data.total_rows/data.perpage);

            if ( (!hal_aktif) && ($('ul#pagination-user li').length == 0)){
                    $('ul#pagination-user li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li><a href="user#ambil?hal='+i+'">'+i+'</a></li>';
                    }
            }
            else if (hal_aktif && group){
                $('ul#pagination-user li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li><a href="user#ambil?group='+group+'&hal='+i+'">'+i+'</a></li>';
                    }
            }
            else if (hal_aktif && cari){
                $('ul#pagination-user li').remove();
                    for(i=1; i <= paging; i++){
                        pagination = pagination+'<li><a href="user#ambil?cari='+cari+'&hal'+i+'">'+i+'</a></li>';
                    }
            }
                $('ul#pagination-user').append(pagination);
                $("ul#pagination-user li:contains('"+hal_aktif+"')").addClass('active');
                
                if(scrolltop == true ){
                    $('body').scrollTop(2);
                }
            }
            });
        }
}

function tampil_barang(hal_aktif,scrolltop,jenis,cari){
        if($('table#tbl-barang-keluar').length > 0){
        $.ajax('http://'+host+path+'/action/ambil',{
            dataType:'json',
            type : 'POST',
            data : {hal_aktif:hal_aktif, jenis:jenis, cari:cari},
            success:function(data){
                if(data.status=='notfound'){
                    swal({
                        title: 'Data yang dicari tidak ada',
                        text: "Silahkan periksa kembali",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                }
                else{
                    var no=0;
                    $('table#tbl-barang-keluar tbody tr').remove();
                    $('table#tbl-barang-keluar thead tr').remove();
                    $('table#tbl-barang-keluar').find('thead').append(
                        '   <tr>'+
                        '       <th width ="5%">No</a></th>'+
                        '       <th width ="17%">Nama Barang</a></th>'+
                        '       <th width ="13%">Serial Number</th>'+
                        '       <th width ="10%">Jenis</th>'+
                        '       <th width ="12%">Jumlah</th>'+
                        '       <th width ="10%">Kondisi</th>'+
                        '       <th width="5%" class="td-actions"> Aksi </th>'+
                        '   </tr>'
                    );
                    $.each(data.record,function(index,element){
                        no++;
                        $('table#tbl-barang-keluar').find('tbody').append(
                        '<tr>'+
                        '    <td width ="5%">'+no+'</a></td>'+
                        '    <td width ="17%">'+element.nama_barang+'</a></td>'+
                        '    <td width ="13%">'+element.serial+'</td>'+
                        '    <td width ="10%">'+element.nama_jenis+'</td>'+
                        '    <td width ="12%">'+element.jumlah+'</td>'+
                        '    <td width ="10%">'+element.kondisi+'</td>'+
                        '    <td width="5%" class="td-actions">'+
                        '        <a href="keluar#detail?id='+element.id_barang+'" class="link-edit btn btn-primary btn-sm"><i class=" fa fa-search "></i>  Pilih </a>'+
                        '    </td>'+
                        '</tr>'
                        );
                    });

                    /*-----------------PAGINATION----------------------------------------*/
                    var pagination ='';
                    var paging = Math.ceil(data.total_rows/data.perpage);

                    if ( (!hal_aktif) && ($('ul#pagination-barang-keluar li').length == 0)){
                            $('ul#pagination-barang-keluar li').remove();
                            for(i=1; i <= paging; i++){
                                pagination = pagination+'<li><a href="keluar#ambil?hal='+i+'">'+i+'</a></li>';
                            }
                    }
                    else if (hal_aktif && cari){
                        $('ul#pagination-barang-keluar li').remove();
                            for(i=1; i <= paging; i++){
                                pagination = pagination+'<li><a href="keluar#ambil?cari='+cari+'&hal='+i+'">'+i+'</a></li>';
                            }
                    }
                        $('ul#pagination-barang-keluar').append(pagination);
                        $("ul#pagination-barang-keluar li:contains('"+hal_aktif+"')").addClass('active');

                    
                        $('#btn-filter-barang li').remove();
                        $('#btn-filter-barang').append('<li><a href="barang">Semua</a></li>');

                        for(var i in data.all_jenis){
                            $('#btn-filter-barang').append('<li><a href="keluar#ambil?jenis='+data.all_jenis[i]['nama_jenis']+'&hal=1">'+data.all_jenis[i]['nama_jenis']+'</a></li>');
                        }

                        if(scrolltop == true ){
                            $('body').scrollTop(2);
                        }
                }
            }

    
            });
        }
}

function tampil_riwayat_keluar(hal_aktif,scrolltop,cari){
    if($('table#tbl-riwayat').length > 0){
    $.ajax('http://'+host+path+'/ambil',{
        dataType:'json',
        type : 'POST',
        data : {hal_aktif:hal_aktif, cari:cari},
        success:function(data){
            var no=0;
            $('table#tbl-riwayat tbody tr').remove();
            $.each(data.record,function(index,element){
                no++;
                $('table#tbl-riwayat').find('tbody').append(
                '<tr>'+
                '    <td width ="5%">'+no+'</a></td>'+
                '    <td width ="7%">'+element.nik+'</a></td>'+
                '    <td width ="10%">'+element.nama+'</td>'+
                '    <td width ="10%">'+element.nama_barang+'</td>'+
                '    <td width ="10%">'+element.ip+'</td>'+
                '    <td width ="15%">'+element.tanggal_keluar+'</td>'+
                '    <td width ="5%">'+element.jumlah+'</td>'+
                '    <td width="10%" class="td-actions">'+
                '        <a href="riwayat#detail?id='+element.id_keluar+'" class="link-edit btn btn-primary btn-sm"><i class=" fa fa-search "></i>  Detail</a>'+
                '        <a href="riwayat#hapus?id='+element.id_keluar+'" class="link-edit btn btn-danger btn-sm">Hapus</a>'+
                '    </td>'+
                '</tr>'
                );
            });

        /*-----------------PAGINATION----------------------------------------*/
        var pagination ='';
        var paging = Math.ceil(data.total_rows/data.perpage);

        if((!hal_aktif) && ($('ul#pagination-riwayat-keluar li').length == 0)){
                $('ul#pagination-riwayat-keluar li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li><a href="riwayat#ambil?hal='+i+'">'+i+'</a></li>';
                }
        }
        else if (hal_aktif && cari){
            $('ul#pagination-riwayat-keluar li').remove();
                for(i=1; i <= paging; i++){
                pagination = pagination+'<li><a href="riwayat#ambil?cari='+cari+'&hal='+i+'">'+i+'</a></li>';
            }
        }
            $('ul#pagination-riwayat-keluar').append(pagination);
            $("ul#pagination-riwayat-keluar li:contains('"+hal_aktif+"')").addClass('active');

        
            $('#btn-filter-barang li').remove();
            $('#btn-filter-barang').append('<li><a href="barang">Semua</a></li>');

            for(var i in data.all_jenis){
                $('#btn-filter-barang').append('<li><a href="keluar#ambil?jenis='+data.all_jenis[i]['nama_jenis']+'&hal=1">'+data.all_jenis[i]['nama_jenis']+'</a></li>');
            }

            if(scrolltop == true ){
                $('body').scrollTop(2);
            }
        }
    });
    }
}

function tampil_barang_kerusakan(hal_aktif,scrolltop,cari){
        if($('table#tbl-kerusakan').length > 0){
        $.ajax('http://'+host+path+'/action/ambil',{
            dataType:'json',
            type : 'POST',
            data : {hal_aktif:hal_aktif, cari:cari},
            success:function(data){
                if(data.status =='notfound'){
                    swal({
                        title: 'Data yang dicari tidak ada',
                        text: "Silahkan periksa kembali",
                        type: 'warning',
                        confirmButtonColor: '#4fa7f3',
                        confirmButtonText: 'OK'
                    });
                }
                else{
                    var no=0;
                    $('table#tbl-kerusakan tbody tr').remove();
                    $('table#tbl-kerusakan thead tr').remove();
                    $('table#tbl-kerusakan').find('thead').append(
                        '   <tr>'+
                        '       <th width ="5%">No</a></th>'+
                        '       <th width ="17%">Nama Barang</a></th>'+
                        '       <th width ="13%">Serial</th>'+
                        '       <th width ="10%">Jenis</th>'+
                        '       <th width ="12%">Jumlah</th>'+
                        '       <th width ="10%">Kondisi</th>'+
                        '       <th width="5%" class="td-actions"> Aksi </th>'+
                        '   </tr>'
                    );
                    $.each(data.record,function(index,element){
                        no++;
                        $('table#tbl-kerusakan').find('tbody').append(
                        '<tr>'+
                        '    <td width ="5%">'+no+'</a></td>'+
                        '    <td width ="17%">'+element.nama_barang+'</a></td>'+
                        '    <td width ="13%">'+element.serial+'</td>'+
                        '    <td width ="10%">'+element.nama_jenis+'</td>'+
                        '    <td width ="12%">'+element.jumlah+'</td>'+
                        '    <td width ="10%">'+element.kondisi+'</td>'+
                        '    <td width="5%" class="td-actions">'+
                        '        <a href="kerusakan#detail?id='+element.id_barang+'" class="link-edit btn btn-primary btn-sm"><i class=" fa fa-search "></i>  Pilih </a>'+
                        '    </td>'+
                        '</tr>'
                        );
                    });

                    /*-----------------PAGINATION----------------------------------------*/
                    var pagination ='';
                    var paging = Math.ceil(data.total_rows/data.perpage);

                    if ((!hal_aktif) && ($('ul#pagination-kerusakan li').length == 0)){
                        $('ul#pagination-kerusakan li').remove();
                        for(i=1; i <= paging; i++){
                            pagination = pagination+'<li><a href="kerusakan#ambil?hal='+i+'">'+i+'</a></li>';
                        }
                    }
                    else if (hal_aktif && cari){
                        $('ul#pagination-kerusakan li').remove();
                        for(i=1; i <= paging; i++){
                            pagination = pagination+'<li><a href="kerusakan#ambil?cari='+cari+'&hal='+i+'">'+i+'</a></li>';
                        }
                    }
                    $('ul#pagination-kerusakan').append(pagination);
                    $("ul#pagination-kerusakan li:contains('"+hal_aktif+"')").addClass('active');

                    $('#btn-filter-kerusakan li').remove();
                    $('#btn-filter-kerusakan').append('<li><a href="barang">Semua</a></li>');

                    if(scrolltop == true ){
                        $('body').scrollTop(2);
                    }
                } 
            } 
            });
        }
}

function tampil_riwayat_kerusakan(hal_aktif,scrolltop,cari){
    if($('table#tbl-riwayat-kerusakan').length > 0){
    $.ajax('http://'+host+path+'/ambil',{
        dataType:'json',
        type : 'POST',
        data : {hal_aktif:hal_aktif, cari:cari},
        success:function(data){
            var no=0;
            $('table#tbl-riwayat-kerusakan tbody tr').remove();
            $.each(data.record,function(index,element){
                no++;
                $('table#tbl-riwayat-kerusakan').find('tbody').append(
                '<tr>'+
                '    <td width ="5%">'+no+'</a></td>'+
                '    <td width ="7%">'+element.nik+'</a></td>'+
                '    <td width ="10%">'+element.nama+'</td>'+
                '    <td width ="13%">'+element.nama_barang+'</td>'+
                '    <td width ="10%">'+element.tanggal_kerusakan+'</td>'+
                '    <td width ="10%">'+element.jumlah+'</td>'+
                '    <td width="10%" class="td-actions">'+
                '        <a href="riwayat#detail?id='+element.id_kerusakan+'" class="link-edit btn btn-primary btn-sm"><i class=" fa fa-search "></i>  Pilih </a>'+
                '        <a href="riwayat#hapus?id='+element.id_kerusakan+'" class="link-edit btn btn-danger btn-sm">Hapus</a>'+
                '    </td>'+
                '</tr>'
                );
            });

        /*-----------------PAGINATION----------------------------------------*/
        var pagination ='';
        var paging = Math.ceil(data.total_rows/data.perpage);

        if((!hal_aktif) && ($('ul#pagination-riwayat-kerusakan li').length == 0)){
                $('ul#pagination-riwayat-kerusakan li').remove();
                for(i=1; i <= paging; i++){
                    pagination = pagination+'<li><a href="riwayat#ambil?hal='+i+'">'+i+'</a></li>';
                }
        }
        else if (hal_aktif && cari){
            $('ul#pagination-riwayat-kerusakan li').remove();
                for(i=1; i <= paging; i++){
                pagination = pagination+'<li><a href="riwayat#ambil?cari='+cari+'&hal='+i+'">'+i+'</a></li>';
            }
        }
            $('ul#pagination-riwayat-kerusakan').append(pagination);
            $("ul#pagination-riwayat-kerusakan li:contains('"+hal_aktif+"')").addClass('active');

        
            $('#btn-filter-barang li').remove();
            $('#btn-filter-barang').append('<li><a href="barang">Semua</a></li>');

            for(var i in data.all_jenis){
                $('#btn-filter-barang').append('<li><a href="kerusakan#ambil?jenis='+data.all_jenis[i]['nama_jenis']+'&hal=1">'+data.all_jenis[i]['nama_jenis']+'</a></li>');
            }

            if(scrolltop == true ){
                $('body').scrollTop(2);
            }
        }
    });
    }
}

function ajax_upload(type){
    var upload = 'tambah';
    new AjaxUpload('userfile', {
        action: '../admin/media/action/'+upload+'/'+type,
        name: 'userfile',
        responseType: "json",
        onSubmit: function(file, extension){      
            swal({
              title: 'Tunggu Sebentar',
              text: 'File Sedang Di Upload!',
              timer: 5000,
              onOpen: () => {
                swal.showLoading()
              }
            });
        },
        onComplete: function(file, response){
            if(response.success == 'TRUE'){
              if(type == 'barang') {
                $('#userfile').before(
                    '<div class="form-row" id="form-row-file">'+
                    '   <div class="form-group">'+
                    '       <img src="'+response.file_thumbnail+'" id="gambar_barang" class="featured_image"/>'+
                    '   </div>'+
                    '   <div class="form-group" id="form-file" action="hapus">'+
                    '       <input type="hidden" id="file_original" name="file_original" value="'+response.file_original+'"/>' +
                    '       <input type="hidden" id="file_thumbnail" name="file_thumbnail" value="'+response.file_thumbnail+'"/>' +
                    '       <input type="text" class="form-control" id="file_dir_original" name="file_dir_original" value="'+response.file_dir_original+'"/ readonly>' +
                    '       <br id="spacing">'+
                    '       <button id="hapus_gambar" class="btn btn-danger btn-sm">Hapus Gambar</button>'+
                    '   </div>'+
                    '</div>'
                  );
                $('#userfile').hide();
              }
              else if(type == 'kerusakan'){
                $('.image-list-wrap').append(
                    '<div class="image-single-item">'+
                    '  <a class="btn btn-primary remove-img-btn"><i class="icon-remove"></i></a>'+
                    '  <img src="'+response.file_thumbnail+'" />'+
                    '  <input type="hidden" name="post_image[]" value="'+response.img_original+'" />'+
                    '</div>'
                  );
              }
            }
            else{
                swal({
                    title: "Gagal Dilakukan!",
                    text: "File Gagal Di"+upload+"!",
                    type: 'warning',
                    confirmButtonColor: '#4fa7f3',
                    confirmButtonText: 'OK'
                });
            }         
        }
    }); 
}

function getJSON(url,data){
    return JSON.parse($.ajax({

        type :'POST',
        url : url,
        data:data,
        dataType: 'json',
        global: false,
        async: false,
        success:function(msg){
        }
        }).responseText);  
}

function geturlvar(){
    var vars=[],hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

    for (var i =0; i <hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash [1];
    }
    return vars
}














/* 
    //1 Fungsi Timer
    geturlvar merupakan fungsi untuk mengambil suatu string pada url menjadi suatu variable.


    scrolltop merupakan fungsi bawaan jquery untuk melakukan auto scroll ke atas halaman.
*/