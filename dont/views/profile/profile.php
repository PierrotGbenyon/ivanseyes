<div class="style-breadcrumb no-y-padding">
	<ol class="breadcrumb">
		<li class=""><a href="<?php echo base_url('acueil'); ?>">Accueil</a></li>
		<li class="active">Profil utilisateurs</li>
	</ol>
</div>

<section>
	<div class="section-body">

    <div class="row list">
			<?php
					if ($list_profile != false)
					foreach ($list_profile->result() as $val) {
			?>
  			<div class="col-md-3 col-xs-4">
  				<div class="card style-primary">
  					<div class="card-body height-4 scroll">
  						<span class="text-bold text-lg"><?php echo $val->nom_profil ?></span><br/>
              <span><?php echo $val->desc_profil ?></span><br/><br/>
              <small id="<?php echo $val->id_profil ?>">
								<a class="action parameter btn btn-xs btn-icon-toggle ink-reaction pull-left -ml8 -mt16" data-original-title="Action" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"><i class="fa fa-gear"></i></a>
              </small>
  					</div>
  				 </div>
			  </div>
				<?php } ?>

				<?php   if ($this->m_parametre->droit_menu_url('profil','A')) { ?>
				<div class="col-md-1 col-sm-2 col-xs-3">
  				<div class="card style-default-light">
  					<div class="card-body text-center">
							<button type="button" class="btn btn-sm ink-reaction btn-floating-action btn-xs btn-raised btn-primary -ml8 new_btn" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Nouveau profil"><i class="fa fa-plus"></i></button>
  					</div>
  				 </div>
			  </div>
				<?php   } ?>
    </div>

		<div class="col-md-12 hid profile">
      <div class="card b2-p">
          <div class="card-head card-head-xs text-left style-primary">
            <header class=""><i class="fa fa-user"></i> Nouveau profil</header>
          </div>
          <div class="card-body text-center">
							<button class="btn ink-reaction btn-sm btn-floating-action btn-primary btn-raised back_btn" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Retour à la liste"><i class="fa fa-reply-all"></i></button>
							<div class="row no-y-padding -mt20">
								<div class="col-md-12">
									<h3 class="text-bold text-primary"> Formulaire de création d'un nouveau profil</h3>
								</div>
							</div>
							<br/>
							<div class="row">
                <form id="new-profile" class="form-horizontal form-validate" role="form">
                  <div class="col-md-12">
                      <div class="col-md-12 bl2">
	                        <div class="col-md-12 info-badge">
	                          <a> <span class="badge style-badge">Information sur le profil</span> </a>
	                        </div>
													<div class="form-group col-md-12">
                              <label for="name" class="col-md-2 control-label">Dénomination</label>
                              <div class="col-md-4">
                                  <input type="text" placeholder="nom du profil" class="form-control input-sm" id="name" name="name" maxlength="50" required><div class="form-control-line"></div>
                              </div>
                              <label for="description" class="col-md-2 control-label">Decription</label>
                              <div class="col-md-4">
																	<input type="text" placeholder="une brève description" class="form-control input-sm" id="description" name="description" maxlength="150" required><div class="form-control-line"></div>
															</div>
                          </div>
											</div>
											<br/>
	                </div>

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
																				while($i < strlen($val->droit_dispo)) {
															?>
																				<label class="btn btn-xs btn-lprimary" data-original-title="<?php echo get_droit($val->droit_dispo[$i]) ?>" data-toggle="tooltip" data-placement="top">
																					<input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit_dispo[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit_dispo[$i]) ?>"></i></label>
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
																				while($i < strlen($val->droit_dispo)) {
															?>
																				<label class="btn btn-xs btn-lprimary" data-original-title="<?php echo get_droit($val->droit_dispo[$i]) ?>" data-toggle="tooltip" data-placement="top">
																					<input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit_dispo[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit_dispo[$i]) ?>"></i></label>
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
																				while($i < strlen($val->droit_dispo)) {
															?>
																				<label class="btn btn-xs btn-lprimary" data-original-title="<?php echo get_droit($val->droit_dispo[$i]) ?>" data-toggle="tooltip" data-placement="top">
																					<input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit_dispo[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit_dispo[$i]) ?>"></i></label>
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
																				while($i < strlen($val->droit_dispo)) {
															?>
																				<label class="btn btn-xs btn-lprimary" data-original-title="<?php echo get_droit($val->droit_dispo[$i]) ?>" data-toggle="tooltip" data-placement="top">
																					<input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit_dispo[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit_dispo[$i]) ?>"></i></label>
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
																				while($i < strlen($val->droit_dispo)) {
															?>
																				<label class="btn btn-xs btn-lprimary" data-original-title="<?php echo get_droit($val->droit_dispo[$i]) ?>" data-toggle="tooltip" data-placement="top">
																					<input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit_dispo[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit_dispo[$i]) ?>"></i></label>
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
																				while($i < strlen($val->droit_dispo)) {
															?>
																				<label class="btn btn-xs btn-lprimary" data-original-title="<?php echo get_droit($val->droit_dispo[$i]) ?>" data-toggle="tooltip" data-placement="top">
																					<input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit_dispo[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit_dispo[$i]) ?>"></i></label>
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
																				while($i < strlen($val->droit_dispo)) {
															?>
																				<label class="btn btn-xs btn-lprimary" data-original-title="<?php echo get_droit($val->droit_dispo[$i]) ?>" data-toggle="tooltip" data-placement="top">
																					<input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit_dispo[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit_dispo[$i]) ?>"></i></label>
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
																				while($i < strlen($val->droit_dispo)) {
															?>
																				<label class="btn btn-xs btn-lprimary" data-original-title="<?php echo get_droit($val->droit_dispo[$i]) ?>" data-toggle="tooltip" data-placement="top">
																					<input class="form-control input-sm" name="right" id="" value="<?php echo $val->id_menu.'@'.$val->droit_dispo[$i] ?>" type="checkbox"><i class="icon <?php echo get_icon($val->droit_dispo[$i]) ?>"></i></label>
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

									<div class="col-md-12 mt-xl">
											<button type="button" class="new-profile btn ink-reaction btn-sm btn-floating-action btn-primary btn-loading-state" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Valider" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>
		              </div>
								</form>
            	</div>
          </div>
      </div>
    </div>

		<form method="post" action="<?php echo base_url('profil/consult')?>">
			<input type="hidden" value="" name="dt-id">
			<input type="hidden" value="" name="dt-name">
			<button type="submit" class="dt-sub hid"></button>
		</form>

	</div>

		<div class="modal fade middle" id="action" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content modal-action">
							<div class="modal-header">
								<h3 class="text-bold ml-lg">Actions</h3>
							</div>
							<div class="modal-body">
									<div class="row no-padding">
											<form id="action-form" class="form-horizontal form-validate" role="form">
												<input type="hidden" name="a-id" value=""><input type="hidden" name="a-name" value="">
												<div class="col-md-12">
													<div class="bl2 col-md-11 col-md-push-1">
															<p class="detail-info ml-lg -mt5"></p>
													</div>
												</div>
												<div class="form-group col-md-12 ">
													<div class="col-md-1"></div>
													<div class="col-md-4 text-center">
														<button type="button" class="dt-s btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="fa fa-bullseye"></i></button>
														<p class="text-bold">Consulter les droits</p>
													</div>
														<?php if ($this->m_parametre->droit_menu_url('profil','A')): ?>
															<div class="col-md-2 text-center">
																<button type="button" class="up-s btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="fa fa-pencil"></i></button>
																<p class="text-bold">Modifier</p>
															</div>
														<?php endif; ?>

														<?php if ($this->m_parametre->droit_menu_url('profil','S')): ?>
															<div class="col-md-5 text-center">
																<button type="button" class="del-s btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="fa fa-trash-o"></i></button>
																<p class="text-bold">Supprimer le profil</p>
															</div>
														<?php endif; ?>
													</div>
												</div>
											</form>
									</div>

							</div>
					</div>
				</div>
		</div>

		<div class="modal fade middle" id="up" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
				<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<h4 class="text-bold text-second-primary"> Mise à jour </h4>
								</div>
								<div class="modal-body">
										<div class="row">
												<form id="update-profile-form" class="form-horizontal form-validate" role="form" >
														<div class="col-sm-12">
																<div class="form-group col-sm-12 ">
																		<label for="up_code" class="col-sm-1 control-label">Code</label>
																		<div class="col-sm-3">
																				<input type="text" placeholder="Nom" class="form-control input-sm" id="up_code" name="up_code" maxlength="50" required><div class="form-control-line"></div>
																		</div>
                                    <label for="up_level" class="col-sm-1 control-label">Niveau </label>
																		<div class="col-sm-3">
                                      <select id="up_level" class="form-control input-sm" readonly>
                                      <?php
                                          if ($list_level != false)
                                            foreach ($list_level->result() as $val)
                                            {
                                      ?>
                                          <option value="<?php echo $val->intitule_niv ?>"><?php echo $val->intitule_niv ?></option>
                                      <?php } ?>
                                      </select>
                                    </div>
                                    <label for="up-classroom" class="col-sm-1 control-label">Salle</label>
																		<div class="col-sm-3">
                                      <select id="up_classroom" class="form-control input-sm">
                                      <?php
                                          if ($list_classroom != false)
                                            foreach ($list_classroom->result() as $val)
                                            {
                                      ?>
                                          <option value="<?php echo $val->code_salle ?>"><?php echo $val->code_salle ?></option>
                                      <?php } ?>
                                      </select>
                                    </div>
																</div>
														</div>

														<div class="row no-y-padding">
																<button type="button" class="update-profile btn ink-reaction btn-sm btn-floating-action btn-primary btn-loading-state pull-right" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Valider" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>
																<button type="button" class="btn ink-reaction btn-sm btn-floating-action text-primary pull-right margin-right-lg" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Annuler"><i class="fa fa-undo"></i></button>
														</div>
                            <br/>
                        </form>
										</div>
                    <div class="row">
                      <div class="col-md-11 col-md-push-1 border-l2">
                          <div class="col-sm-12 info-badge">
                              <a> <span class="badge style-badge">Liste des classes</span></a>
                          </div>
                          <div class="col-sm-12">
                              <table class="table table-condensed list-profile">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Niveau</th>
                                    <th>Salle</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                          </div>
                      </div>
                    </div>
								</div>
						</div>
				</div>
		</div>

		<div class="modal fade middle" id="del" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
				<div class="modal-dialog">
						<div class="modal-content modal-action">
								<div class="modal-body">
									<div class="row">
											<form id="delete" class="form-horizontal form-validate" role="form" >
												<input type="hidden" id="del-id" name="del-id" value=""><input type="hidden" id="del-name" name="del-name" value="">
												<div class="form-group col-md-12 text-center">
														<h4 class="text-danger">Voulez-vous vraiment supprimer le profil  <span class="del-name text-bold text-primary"></span><span class="text-xl text-danger">?</span></h4>
												</div>
												<div class="row no-y-padding">
														<button type="button" class="delete btn ink-reaction btn-sm btn-floating-action btn-primary btn-loading-state pull-right" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Supprimer" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>
														<button type="button" data-dismiss="modal" class="btn ink-reaction btn-sm btn-floating-action pull-right mr-lg" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Annuler"><i class="fa fa-close"></i></button>
												</div>
											</form>
									</div>
								</div>
						</div>
				</div>
		</div>


</section>
