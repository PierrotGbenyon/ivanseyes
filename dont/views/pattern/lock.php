<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="<?php echo $charset ?>">
    <meta name="description" content="Hotel Ivans Plaza">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title ?></title>

    <!-- <link rel="icon" type="image/png" href="<?php echo img('icon.png') ?>"/> -->
    <link type="text/css" rel="stylesheet" href="<?php echo css('bootstrap') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('materialadmin') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('font-awesome') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('material-design-iconic-font.min') ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo css('mine/primary') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('mine/border_spacing') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('mine/forms') ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo css('mine/navigations_bar') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('mine/style') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('libs/toastr/toastr') ?>" />


    <!-- [if lt IE 9]>
        <script type="text/javascript" src="<?php echo js('libs/utils/html5shiv') ?>"></script>
        <script type="text/javascript" src="<?php echo js('libs/utils/respond.min') ?>"></script>
    <![endif]-->
</head>

<body class="lock">
  <input type="hidden" id="base_url" value="<?php echo base_url(null); ?>">

    <section class="section-account" style="margin-top: 17% !important">
			<div class="card contain-xs style-transparent">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12">
							<img class="img-circle border-white" src="<?php echo img('utilisateur/'.$this->session->userdata('photo')) ?>" alt=""  style="width: 130px; height: 130px;"/>
							<h2 class="text-primary"><?php echo $this->session->userdata('pseudo') ?></h2>
							<form id="_ulock" class="form" accept-charset="utf-8">
								<div class="form-group floating-label">
									<div class="input-group">
										<div class="input-group-content">
											<input type="password" id="pass" class="form-control input-sm" name="pass">
											<label for="password">Mot de passe</label>
											<p class="help-block text-bold"><a href="<?php echo base_url('connexion/disconnect'); ?>">Vous n'êtes pas <strong><?php echo $this->session->userdata('pseudo') ?></strong>?</a></p>
										</div>
										<div class="input-group-btn">
											<button class="_ulock btn btn-floating-action btn-default-dark btn-loading-state btn-primary" data-toggle="tooltip" data-trigger="hover" data-original-title="Dévérrouillez" data-placement="bottom" data-loading-text="<i class='white fa fa-spinner fa-spin'></i>"><i class="fa fa-unlock"></i></button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>


    <script type="text/javascript" src="<?php echo js('libs/jquery/jquery-1.11.2.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/jquery/jquery-migrate-1.2.1.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/bootstrap/bootstrap.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/autosize/jquery.autosize.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/toastr/toastr'); ?>"></script>

    <script type="text/javascript" src="<?php echo js('core/source/App'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/source/AppCard'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/source/AppForm'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/source/AppVendor'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/demo/Demo'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/demo/DemoUIMessages'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('function/lock'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('style'); ?>"></script>


</body>

</html>
