
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="https://blksumenep.com//assets/img/favicon.png" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src=<?php echo base_url("../assets/js/plugin/webfont/webfont.min.js");?>></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href=<?php echo base_url("../assets/css/bootstrap.min.css");?>>
	<link rel="stylesheet" href="https://themekita.com/demo-atlantis-bootstrap/livepreview/examples/assets/css/atlantis.css">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Sign In To Admin</h3>
			<?php if(session()->getFlashdata('msg')):?>
                    <span style="color:red;" id="error">
						<?= session()->getFlashdata('msg') ?>
					</span>
                   
                <?php endif;?>
			<form class="login-form"  action="<?= base_url('login'); ?>" method="POST">
				
				<div class="form-group form-floating-label">
					<input id="username" name="username" onclick="rmSpan()" type="text" class="form-control input-border-bottom" required>
					<label for="username" class="placeholder">Username</label>
				</div>
				<div class="form-group form-floating-label">
					<input id="password" name="password" onclick="rmSpan()" type="password" class="form-control input-border-bottom" required>
					<label for="password" class="placeholder">Password</label>
					<div class="show-password">
						<i class="icon-eye"></i>
					</div>
				</div>
				<div class="row form-sub m-0">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="rememberme">
						<label class="custom-control-label" for="rememberme">Remember Me</label>
					</div>
					
					<a href="#" class="link float-right">Forget Password ?</a>
				</div>
				<div class="form-action mb-3">
					<button type="submit" class="btn btn-primary btn-rounded btn-login">Sign In</button>
				</div>
			</form>
		</div>
	</div>
	<script src=<?php echo base_url("../assets/js/core/jquery.3.2.1.min.js");?>></script>
	<script src=<?php echo base_url("../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js");?>></script>
	<script src=<?php echo base_url("../assets/js/core/popper.min.js");?>></script>
	<script src=<?php echo base_url("../assets/js/core/bootstrap.min.js");?>></script>
	<script src=<?php echo base_url("../assets/js/atlantis.min.js");?>></script>

	<script>
    function rmSpan(id, text, btn) {
    // hide the lorem ipsum text
    document.getElementById('error').style.display = 'none';
   
}
	</script>
</body>
</html>