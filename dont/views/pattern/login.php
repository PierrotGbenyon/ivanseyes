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

<body>
    <input type="hidden" id="base_url" value="<?php echo base_url(null); ?>">

      <div class="col-lg-10 col-lg-offset-1 col-md-12">
        <div  class="card no-margin style-transparent">
          <div class="card-body">
            <div class="row no-margin">
              <div class="col-sm-12 text-center bb1">
      					<span class="text-5xl text-bold style-logo name">I</span>
      					<span class="text-xxxl text-bold style-logo name name_suite">van</span>
      					<span class="text-xxxl text-bold style-logo-light name name_suite">'s</span>
      					<span class="text-5xl text-bold style-logo-light name">E</span>
      					<span class="text-xxxl text-bold style-logo-light name name_suite">yes</span>
                <br />
                <span class="text-bold text-xxl">Portail de Connexion</span>
              </div>

              <div class="col-md-6 col-md-offset-3 col-xs-12 col-sm-offset-1 col-sm-12 ">
                <br/>
                  <div class="col-md-10 col-md-offset-1 col-sm-10 col-xs-12">
                    <div class="card">
                      <div class="card-head card-head-xs text-left style-primary">
                        <header class="text-bold">Accès Réservé</header>
                      </div>
                      <div class="card-body style-default-bright">
                        <blockquote>
    											<small class="text-medium">Veuillez s'il vous plait remplir le formulaire avec vos éléments d'identification</small>
    										</blockquote>
                        <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 " style="margin-top:-6px;">
                          <form id="_login" class="form floating-label form-validate" role="form"  accept-charset="utf-8">
                              <div class="form-group">
                                <input type="text" class="form-control input-sm" id="username" name="username" required>
                                <label for="username">Nom d'utilisateur</label>
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control input-sm" id="password" name="password" required>
                                <label for="password">Mot de passe</label>
                                <p class="help-block"><a href="#">Mot de passe oublié?</a></p>
                              </div>
                              <!-- <input type="text" class="form-control input-sm" id="csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash() ?>" > -->
                              <!-- <br/> -->
                              <div class="row">
                                <div class="col-xs-6 col-xs-offset-3 text-center">
                                  <button class="btn ink-reaction btn-sm btn-floating-action btn-primary btn-loading-state _login" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Connectez-vous" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>
        												</div>
                              </div>
                          </form>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div></div></div>

    <!-- JQuery -->
    <script type="text/javascript" src="<?php echo js('libs/jquery/jquery-1.11.2.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/jquery/jquery-migrate-1.2.1.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/bootstrap/bootstrap.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/autosize/jquery.autosize.min'); ?>"></script>

    <script type="text/javascript" src="<?php echo js('libs/toastr/toastr'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/jquery-validation/dist/jquery.validate.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/jquery-validation/dist/additional-methods.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/jquery-validation/src/localization/messages_fr'); ?>"></script>

    <script type="text/javascript" src="<?php echo js('core/source/App'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/source/AppCard'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/source/AppForm'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/source/AppVendor'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/demo/Demo'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/demo/DemoUIMessages'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('function/login'); ?>"></script>

    <!-- <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script> -->

</body>

</html>
