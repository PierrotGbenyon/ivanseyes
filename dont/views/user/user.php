<div class="style-breadcrumb no-y-padding">
	<ol class="breadcrumb">
		<li class=""><a href="<?php echo base_url('accueil'); ?>">Accueil</a></li>
		<li class="active">Compte utilisateur</li>
	</ol>
</div>

<section>
	<div class="section-body">

		<div class="col-md-12 list">
	    <div class="card b2-p">
	        <div class="card-head card-head-xs text-left text-bold style-primary">
						<header class=""><i class="fa fa-group"></i> Liste des comptes utilisateurs</header>
					</div>

					<div class="card-body text-center">
							<?php   if ($this->m_parametre->droit_menu_url('utilisateur','C')) { ?>
			                <button class="btn btn-sm ink-reaction btn-floating-action btn-primary btn-raised new_btn" data-original-title="Nouvel utilisateur" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"><i class="fa fa-plus"></i></button>
							<?php   } ?>
						<div class="row">
	            <div class="col-lg-12">
	                <div class="table-responsive">
	                    <table id="datatable1" class="table table-striped table-hover">
	                        <thead>
	                            <tr>
																	<th class="wdth-5">#</th>
																	<th class="wdth-15 sort-alpha">Utilisateur</th>
																	<th class="sort-alpha">Profil</th>
	                                <th class="sort-alpha">Détenteur</th>
																	<th class="sort-alpha">Etat</th>
	                                <th class="wdth-5"></th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        <?php
															$i = 1;
	                            if ($list_user != false)
	                            foreach ($list_user->result() as $val) {
	                        ?>
	                                <tr class="gradeX">
	                                    <td class="text-left"><?php echo $i++ ?></td>
																			<td class="text-left"><?php echo $val->login ?></td>
																			<td class="text-left"><?php echo $val->nom_profil ?></td>
	                                    <td class="text-left"><?php echo $val->nom.' '.$val->prenom ?></td>
	                                    <td class="text-left"><?php $res = ($val->actif==1)? 'actif':'inactif'; echo $res ?></td>

	                                    <td class="text-right" id="<?php echo $val->id_user ?>">
																				<a class="action btn ink-reaction btn-icon-toggle btn-xs"data-original-title="Action" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"><i class="fa fa-cog"></i></a>
    	                            		</td>
	                                </tr>
	                        <?php } ?>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
						</div>
					</div>
			</div>
		</div>

		<div class="col-md-12 hid user">
      <div class="card b2-p">
          <div class="card-head card-head-xs text-left text-bold style-primary">
            <header class=""><i class="fa fa-group"></i> Nouvel utilisateur</header>
          </div>
          <div class="card-body text-center">
							<button class="btn ink-reaction btn-sm btn-floating-action btn-primary btn-raised back_btn" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Retour à la liste"><i class="fa fa-reply-all"></i></button>
							<div class="row no-y-padding -mt20">
								<div class="col-md-12">
									<h3 class="text-bold text-primary"> Formulaire de création d'un compte utilisateur</h3>
								</div>
							</div>
							<br/>
							<div class="row">
                <form id="new-user" class="form-horizontal form-validate" role="form">
									<div class="col-md-6">
										<div class="col-md-12 bl2">
												<div class="col-md-2 info-badge">
													<a> <span class="badge style-badge">Information sur le propriétaire</span> </a>
												</div>
												<div class="form-group col-md-12">
														<label for="nom" class="col-md-4 control-label">Nom</label>
														<div class="col-md-8">
																<input type="text" class="form-control input-sm" id="nom" name="nom" maxlength="30" required><div class="form-control-line"></div>
														</div>
												</div>
												<div class="form-group col-md-12">
														<label for="prenom" class="col-md-4 control-label">Prénoms</label>
														<div class="col-md-8">
																<input type="text" class="form-control input-sm" id="prenom" name="prenom" maxlength="50" required><div class="form-control-line"></div>
														</div>
												</div>
												<div class="form-group col-md-12">
													<label for="profil" class="col-md-4 control-label">Profil</label>
													<div class="col-md-8">
															<select id="profil" name="profil" class="profil form-control input-sm search-select" required>
																<option></option>
															<?php
																	if ($list_profile != false)
																	foreach ($list_profile->result() as $val) {
															?>
																	<option value="<?php echo $val->id_profil?>"> <?php echo $val->nom_profil ?></option>
															<?php
																	}
															?>
															</select>
													</div>
												</div>
										</div>
                  </div>

									<div class="col-md-6">
                      <div class="col-md-12 bl2">
	                        <div class="col-md-2 info-badge">
	                          <a> <span class="badge style-badge">Information de connexion</span> </a>
	                        </div>
	                        <div class="form-group col-md-12">
                              <label for="login" class="col-md-4 control-label">Nom d'utilisateur</label>
                              <div class="col-md-8">
                                  <input type="text" class="form-control input-sm" id="login" name="login" maxlength="30" required><div class="form-control-line"></div>
                              </div>
	                        </div>
	                        <div class="form-group col-md-12">
                              <label for="password" class="col-md-4 control-label">Mot de passe</label>
                              <div class="col-md-8">
                                  <input type="password" class="form-control input-sm" id="password" name="password" required><div class="form-control-line"></div>
                              </div>
	                        </div>
	                        <div class="form-group col-md-12">
                              <label for="confirm" class="col-md-4 control-label">Confirmation</label>
                              <div class="col-md-8">
                                  <input type="password" placeholder="confirmation du mot de passe" class="form-control input-sm" id="confirm" name="confirm" data-rule-equalto="#password" required><div class="form-control-line"></div>
                              </div>
	                        </div>
											</div>
                  </div>

									<div class="col-md-12 mt-xxl">
											<p class="text-left text-medium">Tous les champs avec l'astérisque <span class="red">*</span> sont à remplir obligatoirement!</p>
											<button type="submit" class="new-user btn ink-reaction btn-sm btn-floating-action btn-primary btn-loading-state" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Valider" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>
		              </div>
								</form>
            	</div>
          </div>
      </div>
    </div>

		<div class="modal fade middle" id="action" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
			<div class="modal-dialog">
					<div class="modal-content modal-action">
							<div class="modal-header">
								<!-- <button type="button" class="close closeD" data-dismiss="modal" aria-hidden="true">&times;</button> -->
									<h3 class="text-bold ml-lg">Actions</h3>
							</div>
							<div class="modal-body">
									<div class="row no-padding">
											<form id="action-form" class="form-horizontal form-validate" role="form">
												<input type="hidden" name="a-id" value=""><input type="hidden" name="etat" value=""><input type="hidden" name="a-login" value="">
												<div class="col-md-12">
													<div class="bl2 col-md-11 col-md-push-1">
															<p class="detail-info ml-lg"></p>
													</div>
												</div>
												<div class="form-group col-md-12 ">
													<?php if ($this->m_parametre->droit_menu_url('utilisateur','A')): ?>
															<div class="text-center">
																<button type="button" class="activate btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="md md-lock-outline"></i></button>
																<p class="activate-text text-bold"></p>
															</div>
													<?php endif; ?>
												</div>
											</form>
									</div>

							</div>
					</div>
			</div>
		</div>

	</div>
</section>
