<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="<?php echo $charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta name="keywords" content="your,keywords"> -->
    <meta name="description" content="Hotel Ivans Plaza">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title ?></title>

    <!-- <link rel="icon" type="image/png" href="<?php echo img('icon.png') ?>"/> -->
    <link type="text/css" rel="stylesheet" href="<?php echo css('bootstrap') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('materialadmin') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('font-awesome') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('material-design-iconic-font.min') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('libs/bootstrap-datepicker/datepicker3') ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo css('mine/primary') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('mine/border_spacing') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('mine/navigations_bar') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('mine/forms') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('mine/style') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo css('libs/toastr/toastr') ?>" />

    <?php foreach($print_css as $url){ ?>
        <link media="print" rel="stylesheet" type="text/css" href="<?php echo $url; ?>" />
    <?php } ?>
    <?php foreach($css as $url){ ?>
        <link type="text/css" rel="stylesheet"  href="<?php echo $url; ?>" />
    <?php } ?>

    <!-- [if lt IE 9]>
        <script type="text/javascript" src="<?php echo js('libs/utils/html5shiv') ?>"></script>
        <script type="text/javascript" src="<?php echo js('libs/utils/respond.min') ?>"></script>
    <![endif]-->
</head>

<body class="menubar-hoverable header-fixed <?php if($title != 'Detail | Compte | IVANS-PLAZA') echo " menubar-pin" ?> menubar-first <?php if($title != 'Tableau de bord | IVANS-PLAZA') echo " bg-white"; ?> ">
    <input type="hidden" id="base_url" value="<?php echo base_url(null); ?>">

    <header id="header">
        <div class="headerbar">

            <!-- Headerbar left -->
            <div class="headerbar-left">
                <ul class="header-nav header-nav-options">
                    <li class="header-nav-brand">
                        <div class="brand-holder">
                            <a href="<?php echo base_url('home') ?>" class="no-margin">
                              <span class="text-xxl text-bold style-logo name">I</span>
                              <span class="text-xl text-bold style-logo name name_suite">van</span>
                              <span class="text-xl text-bold style-logo-light name name_suite">'s</span>
                              <span class="text-xxl text-bold style-logo-light name">E</span>
                              <span class="text-xl text-bold style-logo-light name name_suite">yes</span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Headerbar right -->
            <div class="headerbar-right">
                <ul class="header-nav header-nav-options">
                    <li class="dropdown hidden-xs">
                        <a href="javascript:void(0);" class="btn btn-icon-toggle" data-toggle="dropdown">
                            <i class="md md-notifications"></i><sup class="badge style-primary">7</sup>
                        </a>
                        <ul class="dropdown-menu animation-expand">
                            <li class="dropdown-header">Nouveaux messages</li>
                            <!-- All messages-->
                            <li>
                                <a class="alert alert-callout alert-warning" href="javascript:void(0);">
                                    <img class="pull-right img-circle dropdown-avatar" src="<?php echo img('utilisateur/avatar.jpg')?>" alt="Avatar" />
                                    <strong>Jsoif Hodor</strong>
                                    <small>Réalisation de la maquette...</small>
                                </a>
                            </li>
                            <!-- Additional options-->
                            <li class="dropdown-header">Options<li>
                            <li><a href="#">Voir tous les messages<span class="pull-right"><i class="fa fa-arrow-right"></i></span></a></li>
                            <li><a href="#">Marqués comme lu<span class="pull-right"><i class="fa fa-arrow-right"></i></span></a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="header-nav header-nav-profile">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
                            <img src="<?php echo img('utilisateur/'.$this->session->userdata('photo')) ?>" />
                            <span class="profile-info">
                                <?php echo $this->session->userdata('pseudo'); ?>
                                <small><?php echo $this->session->userdata('profil'); ?></small>
                            </span>
                        </a>
                        <ul class="dropdown-menu animation-dock">
                            <li class="dropdown-header">Paramètres</li>
                            <li><a href="<?php echo base_url('utilisateur/mon_compte') ?>">Mon profil</a></li>
                            <li><a href="#">Mon blog<span class="badge style-primary2 pull-right">7</span></a></li>
                            <li><a href="#">Mes rendez-vous</a></li>
                            <li class="divider"></li>
                            <li class="_lock"><a href="javascript:void(0);"><i class="fa fa-fw fa-lock text-primary"></i>Vérrouiller</a></li>
                            <li><a href="<?php echo base_url('connexion/disconnect') ?>"><i class="fa fa-fw fa-power-off text-primary"></i>Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div id="base">
        <div class="offcanvas"></div>

        <!-- Contenu changeant -->
        <div id="content" >
            <?php echo $output ?>
        </div>

        <!-- Menu -->
        <div id="menubar" class="menubar-inverse">
            <div class="menubar-fixed-panel">
                <div>
                    <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                        <i class="md md-menu"></i>
                    </a>
                </div>
                <div class="expanded">
                    <a href="<?php echo base_url('home'); ?>" class="ml9">
                        <span class="text-xxl text-bold style-logo name">I</span>
                        <span class="text-xl text-bold style-logo name name_suite">van</span>
                        <span class="text-xl text-bold text-default-bright name name_suite">'s</span>
                        <span class="text-xxl text-bold text-default-bright name">E</span>
                        <span class="text-xl text-bold text-default-bright name name_suite">yes</span>
                    </a>
                </div>
            </div>

            <div class="menubar-scroll-panel">
                <ul id="main-menu" class="gui-controls">
                <?php
                  if ($list_menu != false) {
                    $nb=0; $i=0;
                    foreach ($list_menu->result() as $val) {
                      if (($val->sur_id_menu == null) && ($val->droit_dispo == null)) {
                ?>
                      <li class="group_menu">
                        <a class="" href="javascript:void(0);" >
                          <div class="gui-icon"><i class="<?php echo $val->icone ?>"></i></div>
                          <span class="title text-bold"><?php echo $val->nom_menu ?></span>
                        </a>
                      </li>

                <?php		}

                      if ($val->men_id_menu == null) {
                        $z=0;
                        $nb = $val->nb_sous_menu;
                        if ($nb) { if($this->m_parametre->droit_parent($val->id_menu,'C')) $z++; }
                        else { if($this->m_parametre->droit_menu($val->id_menu,'C')) $z++; }
                        $i=0;
                        if ($z) {
                ?>
                          <li class ="<?php if($nb > 0) echo 'gui-folder'?>">
                            <a class="<?php $act = ($groove == $val->nom_menu ) ? 'active' : '' ; echo $act; ?>" href="<?php if($nb == 0) { echo base_url($val->url_menu);}else{echo 'javascript:void(0)';}?>">
                              <div class="gui-icon"><i class="<?php echo $val->icone ?>"></i></div>
                              <span class="title"><?php echo $val->nom_menu ?></span>
                            </a>

                <?php 				if ($nb>0) {?>
                            <ul>
                <?php				}else{?>
                            </li>
                <?php 				}
                        }
                      }else if($this->m_parametre->droit_menu($val->id_menu,'C')){ ?>
                          <li>
                            <a class="<?php $act = ($groove == $val->nom_menu ) ? 'active' : '' ; echo $act; ?>" href="<?php echo base_url($val->url_menu); ?>" >
                              <span class="title"><i class="<?php echo $val->icone ?>"></i> <?php echo $val->nom_menu ?></span>
                            </a>
                          </li>
                <?php

                        if ($i >= $nb) {
                          $nb=0;
                  ?>
                            </ul>
                          </li>
                <?php  			}
                      }
                      $i++;
                    }
                  }
                ?>
                </ul>

                <div class="menubar-foot-panel">
                    <small class="no-linebreak hidden-folded">
                        <span class="opacity-75">Copyright &copy; 2018 Ivan'sEyes</span>
                    </small>
                </div>
            </div>

        </div>
    </div>

    <!-- JQuery -->
    <script type="text/javascript" src="<?php echo js('libs/jquery/jquery-1.11.2.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/jquery/jquery-migrate-1.2.1.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/bootstrap/bootstrap.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/spin/spin.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/autosize/jquery.autosize.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/moment/moment.min'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('libs/toastr/toastr'); ?>"></script>

    <?php foreach($js as $url){ ?>
        <script type="text/javascript" src="<?php echo $url; ?>" ></script>
    <?php } ?>

    <script type="text/javascript" src="<?php echo js('core/source/App'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/source/AppNavigation'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/source/AppOffcanvas'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/source/AppCard'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/source/AppForm'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/source/AppNavSearch'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/source/AppVendor'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('core/demo/Demo'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('printElement'); ?>"></script>
    <script type="text/javascript" src="<?php echo js('style'); ?>"></script>

    <?php foreach($end_js as $url){ ?>
        <script type="text/javascript" src="<?php echo $url; ?>" ></script>
    <?php } ?>

    <!-- <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script> -->

</body>

</html>
