<div class="style-breadcrumb no-y-padding">
	<ol class="breadcrumb">
		<li class=""><a href="<?php echo base_url('accueil'); ?>">Accueil</a></li>
		<li class=""><a href="<?php echo base_url('profil'); ?>">Profil utilisateurs</a></li>
		<li class="active"><?php echo $name; ?></li>
	</ol>
</div>

<section>
	<div class="section-body">

		<div class="col-md-12">
				<br/>
				<div class="row">
          <div class="col-md-12">
            <div class="col-md-6 mt-xl">
                <div class="card" style="box-shadow:none!important;">
                      <div class="card-head card-head-xs text-left style-primary">
                        <header class="">Accueil</header>
                      </div>
                      <div class="card-body height-8 scroll small-padding">
                      <?php
                        if ($accueil != false) {
                          $nb=0; $z=0;
                          foreach ($accueil->result() as $val) {
                            if ($val->men_id_menu == null) {
                              $z = 0;
                              $nb = $val->nb_sous_menu;
                      ?>
                              <?php if($nb == 0) echo '<div class="col-md-10 col-md-push-1">'; ?>
                              <div class="-ml2 mt-lg <?php $result = ($nb>0)? 'col-md-12':'col-md-7'; echo $result; ?>">
                                <p class="text-left text-bold"><i class="<?php echo$val->icone ?>"></i> <?php echo$val->nom_menu ?></p>
                              </div>
                              <?php if($nb > 0) echo '<div class="col-md-12 bl2 ml-xl -mt12">'; ?>
                      <?php
                              if($nb == 0) {
                                $i = 0;
                                echo '<div class="col-md-4 text-right ml-lg"> <div class="btn-group" data-toggle="buttons">';
                                while($i < strlen($val->droit)) {
                      ?>
                                <label class="btn btn-xs btn-dprimary" data-original-title="<?php echo get_droit($val->droit[$i]) ?>" data-toggle="tooltip" data-placement="top">
                                  <input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit[$i]) ?>"></i></label>
                      <?php
                                  $i++;
                                }
                                echo '</div></div></div>';
                              }
                            }
                            else {
                      ?>
                              <div class="col-md-12">
                                <div class="ml-xl col-md-7">
                                  <p class="text-left"><i class="<?php echo$val->icone ?>"></i><?php echo$val->nom_menu ?></p>
                                </div>
                      <?php
                                $i = 0;
                                echo '<div class="col-md-4 text-right"> <div class="btn-group" data-toggle="buttons">';
                                while($i < strlen($val->droit)) {
                      ?>
                                <label class="btn btn-xs btn-dprimary" data-original-title="<?php echo get_droit($val->droit[$i]) ?>" data-toggle="tooltip" data-placement="top">
                                  <input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit[$i]) ?>"></i></label>
                      <?php
                                  $i++;
                                }
                                echo '</div></div></div>';
                                if ($z >= $nb) {
                                  $nb = 0;
                                  echo '</div>';
                                }
                            }
                            $z++;
                          }
                        }
                      ?>

                          </div>
                      </div>
            </div>
            <div class="col-md-6 mt-xl">
                <div class="card" style="box-shadow:none!important;">
                      <div class="card-head card-head-xs text-left style-primary">
                        <header class="">Menu principal</header>
                      </div>
                      <div class="card-body height-8 scroll small-padding">
                      <?php
                        if ($menu_principal != false) {
                          $nb=0; $z=0;
                          foreach ($menu_principal->result() as $val) {
                            if ($val->men_id_menu == null) {
                              $z = 0;
                              $nb = $val->nb_sous_menu;
                      ?>
                              <?php if($nb == 0) echo '<div class="col-md-10 col-md-push-1">'; ?>
                              <div class="-ml2 mt-lg <?php $result = ($nb>0)? 'col-md-12':'col-md-7'; echo $result; ?>">
                                <p class="text-left text-bold"><i class="<?php echo$val->icone ?>"></i> <?php echo$val->nom_menu ?></p>
                              </div>
                              <?php if($nb > 0) echo '<div class="col-md-12 bl2 ml-xl -mt12">'; ?>
                      <?php
                              if($nb == 0) {
                                $i = 0;
                                echo '<div class="col-md-4 text-right ml-lg"> <div class="btn-group" data-toggle="buttons">';
                                while($i < strlen($val->droit)) {
                      ?>
                                <label class="btn btn-xs btn-dprimary" data-original-title="<?php echo get_droit($val->droit[$i]) ?>" data-toggle="tooltip" data-placement="top">
                                  <input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit[$i]) ?>"></i></label>
                      <?php
                                  $i++;
                                }
                                echo '</div></div></div>';
                              }
                            }
                            else {
                      ?>
                              <div class="col-md-12">
                                <div class="ml-xl col-md-7">
                                  <p class="text-left"><i class="<?php echo$val->icone ?>"></i><?php echo$val->nom_menu ?></p>
                                </div>
                      <?php
                                $i = 0;
                                echo '<div class="col-md-4 text-right"> <div class="btn-group" data-toggle="buttons">';
                                while($i < strlen($val->droit)) {
                      ?>
                                <label class="btn btn-xs btn-dprimary" data-original-title="<?php echo get_droit($val->droit[$i]) ?>" data-toggle="tooltip" data-placement="top">
                                  <input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit[$i]) ?>"></i></label>
                      <?php
                                  $i++;
                                }
                                echo '</div></div></div>';
                                if ($z >= $nb) {
                                  $nb = 0;
                                  echo '</div>';
                                }
                            }
                            $z++;
                          }
                        }
                      ?>

                          </div>
                      </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="col-md-6 mt-xl">
                <div class="card" style="box-shadow:none!important;">
                      <div class="card-head card-head-xs text-left style-primary">
                        <header class="">Piscine</header>
                      </div>
                      <div class="card-body height-8 scroll small-padding">
                      <?php
                        if ($piscine != false) {
                          $nb=0; $z=0;
                          foreach ($piscine->result() as $val) {
                            if ($val->men_id_menu == null) {
                              $z = 0;
                              $nb = $val->nb_sous_menu;
                      ?>
                              <?php if($nb == 0) echo '<div class="col-md-10 col-md-push-1">'; ?>
                              <div class="-ml2 mt-lg <?php $result = ($nb>0)? 'col-md-12':'col-md-7'; echo $result; ?>">
                                <p class="text-left text-bold"><i class="<?php echo$val->icone ?>"></i> <?php echo$val->nom_menu ?></p>
                              </div>
                              <?php if($nb > 0) echo '<div class="col-md-12 bl2 ml-xl -mt12">'; ?>
                      <?php
                              if($nb == 0) {
                                $i = 0;
                                echo '<div class="col-md-4 text-right ml-lg"> <div class="btn-group" data-toggle="buttons">';
                                while($i < strlen($val->droit)) {
                      ?>
                                <label class="btn btn-xs btn-dprimary" data-original-title="<?php echo get_droit($val->droit[$i]) ?>" data-toggle="tooltip" data-placement="top">
                                  <input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit[$i]) ?>"></i></label>
                      <?php
                                  $i++;
                                }
                                echo '</div></div></div>';
                              }
                            }
                            else {
                      ?>
                              <div class="col-md-12">
                                <div class="ml-xl col-md-7">
                                  <p class="text-left"><i class="<?php echo$val->icone ?>"></i><?php echo$val->nom_menu ?></p>
                                </div>
                      <?php
                                $i = 0;
                                echo '<div class="col-md-4 text-right"> <div class="btn-group" data-toggle="buttons">';
                                while($i < strlen($val->droit)) {
                      ?>
                                <label class="btn btn-xs btn-dprimary" data-original-title="<?php echo get_droit($val->droit[$i]) ?>" data-toggle="tooltip" data-placement="top">
                                  <input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit[$i]) ?>"></i></label>
                      <?php
                                  $i++;
                                }
                                echo '</div></div></div>';
                                if ($z >= $nb) {
                                  $nb = 0;
                                  echo '</div>';
                                }
                            }
                            $z++;
                          }
                        }
                      ?>

                          </div>
                      </div>
            </div>
            <div class="col-md-6 mt-xl">
                <div class="card" style="box-shadow:none!important;">
                      <div class="card-head card-head-xs text-left style-primary">
                        <header class="">Administration</header>
                      </div>
                      <div class="card-body height-8 scroll small-padding">
                      <?php
                        if ($administration != false) {
                          $nb=0; $z=0;
                          foreach ($administration->result() as $val) {
                            if ($val->men_id_menu == null) {
                              $z = 0;
                              $nb = $val->nb_sous_menu;
                      ?>
                              <?php if($nb == 0) echo '<div class="col-md-12">'; ?>
                              <div class="-ml2 mt-lg <?php $result = ($nb>0)? 'col-md-12':'col-md-7'; echo $result; ?>">
                                <p class="text-left text-bold"><i class="<?php echo$val->icone ?>"></i> <?php echo$val->nom_menu ?></p>
                              </div>
                              <?php if($nb > 0) echo '<div class="col-md-12 bl2 ml-xl -mt12">'; ?>
                      <?php
                              if($nb == 0) {
                                $i = 0;
                                echo '<div class="col-md-4 text-right ml-lg"> <div class="btn-group" data-toggle="buttons">';
                                while($i < strlen($val->droit)) {
                      ?>
                                <label class="btn btn-xs btn-dprimary" data-original-title="<?php echo get_droit($val->droit[$i]) ?>" data-toggle="tooltip" data-placement="top">
                                  <input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit[$i]) ?>"></i></label>
                      <?php
                                  $i++;
                                }
                                echo '</div></div></div>';
                              }
                            }
                            else {
                      ?>
                              <div class="col-md-12">
                                <div class="ml-xl col-md-7">
                                  <p class="text-left"><i class="<?php echo$val->icone ?>"></i><?php echo$val->nom_menu ?></p>
                                </div>
                      <?php
                                $i = 0;
                                echo '<div class="col-md-4 text-right"> <div class="btn-group" data-toggle="buttons">';
                                while($i < strlen($val->droit)) {
                      ?>
                                <label class="btn btn-xs btn-dprimary" data-original-title="<?php echo get_droit($val->droit[$i]) ?>" data-toggle="tooltip" data-placement="top">
                                  <input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit[$i]) ?>"></i></label>
                      <?php
                                  $i++;
                                }
                                echo '</div></div></div>';
                                if ($z >= $nb) {
                                  $nb = 0;
                                  echo '</div>';
                                }
                            }
                            $z++;
                          }
                        }
                      ?>

                          </div>
                      </div>
            </div>
          </div>
        </div>
    </div>
	</div>

</section>
