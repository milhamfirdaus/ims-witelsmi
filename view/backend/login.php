<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Telkom Witel Sukabumi</title>
    <link rel="stylesheet" href="<?php echo get_directory(dirname(__FILE__),'assets/'); ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo get_directory(dirname(__FILE__),'assets/'); ?>css/user.css">
</head>

<body>
    <div class="login-card"><img src="<?php echo get_directory(dirname(__FILE__),'assets/'); ?>img/logotelkom.jpg" class="profile-img-card">
        <p class="profile-name-card">APLIKASI INVENTARIS</p>
        <form action="<?=set_url('login');?>" method="post" class="form-signin"><span class="reauth-email">PT. TELKOM WITEL SUKABUMI</span>
            
            <input class="form-control" type="text" name="nik" placeholder="NIK" autofocus="" id="nik" maxlength="15" required="" autocomplete="off" >
            <?php echo form_error('nik');?> 
            <input class="form-control" type="password" name="password" placeholder="Password" id="password" required="" autocomplete="off"> 
            <?php echo form_error('password');?>
            <div class="checkbox">
                <div class="checkbox">
                    <label>
                        <input id="remember" name="remember" value="yes" type="checkbox">Biarkan Saya tetap Login!</label>
                </div>
            </div>
            <button class="btn btn-primary btn-block btn-lg btn-signin" type="submit">Login </button>
    <script src="<?php echo get_directory(dirname(__FILE__),'assets/'); ?>js/jquery.min.js"></script>
    <script src="<?php echo get_directory(dirname(__FILE__),'assets/'); ?>bootstrap/js/bootstrap.min.js"></script>
</body>
</html>