<div class="wrapper-page">

	<div class="text-center">
		<a href="index-2.html" class="logo logo-lg"><i class="md md-equalizer"></i> <span>Jonam</span> </a>
	</div>

	<form class="form-horizontal m-t-20" action="<?php echo $loginPostUrl; ?>" method="POST" data-parsley-validate novalidate>
		<?php print_r($succesMsg); ?>
		<div class="form-group">
			<div class="col-xs-12">
				<input type="text" name="userName" parsley-trigger="change" required placeholder="Username" class="form-control" id="userName">
				<i class="md md-account-circle form-control-feedback l-h-34"></i>
			</div>
		</div>

		<div class="form-group">
			<div class="col-xs-12">
				<input  type="password" name="password" parsley-trigger="change" required  placeholder="Password" class="form-control" id="password">
				<i class="md md-vpn-key form-control-feedback l-h-34"></i>
			</div>
		</div>

		<div class="form-group">
			<div class="col-xs-12">
				<div class="checkbox checkbox-primary">
					<input id="checkbox-signup" type="checkbox">
					<label for="checkbox-signup">
						Remember me
					</label>
				</div>

			</div>
		</div>

		<div class="form-group text-right m-t-20">
			<div class="col-xs-12">
				<button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit">Log In
				</button>
			</div>
		</div>

		<div class="form-group m-t-30">
			<div class="col-sm-7">
				<a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your
					password?</a>
			</div>
			<div class="col-sm-5 text-right">

			</div>
		</div>
	</form>
</div>

