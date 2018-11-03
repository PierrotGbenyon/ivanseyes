<div class="style-breadcrumb no-y-padding">
	<ol class="breadcrumb">
		<li class=""><a href="<?php echo base_url('acueil'); ?>">Accueil</a></li>
		<li class="active">Catégorie</li>
	</ol>
</div>

<section>
	<div class="section-body">

    <div class="row list">
			<?php
					if ($liste_categorie != false)
					foreach ($liste_categorie->result() as $val) {
			?>
  			<div class="col-md-2 col-xs-3">
  				<div class="card style-primary">
  					<div class="card-body height-3 scroll">
  						<span class="text-bold text-lg"><?php echo $val->libelle ?></span><br/>
  						<span class="<?php echo $val->prix ?>"><?php echo number_format($val->prix,0,',',' ').' F CFA'?></span><br/><br/>
              <small id="<?php echo $val->id_categorie ?>">
                  <a class="action parameter btn btn-xs btn-icon-toggle ink-reaction pull-left -ml8 -mt16" data-original-title="Actions" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"><i class="fa fa-gear"></i></a>
              </small>
  					</div>
  				 </div>
			  </div>
				<?php }
				 			if ($this->m_parametre->droit_menu_url('room/categorie','A')) { ?>
				<div class="col-md-1 col-xs-2">
  				<div class="card style-default-light">
  					<div class="card-body text-center">
							<button type="button" class="btn btn-sm ink-reaction btn-floating-action btn-xs btn-raised btn-primary -ml8 new_btn" data-toggle="tooltip" data-target="#new" data-placement="bottom" data-trigger="hover" data-original-title="Nouvelle categorie"><i class="fa fa-plus"></i></button>
  					</div>
  				 </div>
			  </div>
				<?php   } ?>
    </div>

		<div class="modal fade middle" id="new" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
				<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<h3 class="text-bold text-primary"> Nouvelle catégorie</h3>
								</div>
								<div class="modal-body">
										<div class="row">
												<form id="new-category" class="form-horizontal form-validate" role="form" >
														<div class="col-sm-12">
																<div class="form-group col-sm-12 ">
																	<label for="prix" class="col-sm-3 control-label">Prix</label>
																	<div class="col-sm-6">
																			<input type="text" class="form-control input-sm" id="prix" name="prix" data-rule-number required><div class="form-control-line"></div>
																	</div>
																</div>
														</div>
														<div class="col-sm-12">
																<div class="form-group col-sm-12 ">
																	<label for="libelle" class="col-sm-3 control-label">Désignation</label>
																	<div class="col-sm-9">
																			<input type="text" class="form-control input-sm" id="libelle" name="libelle" maxlength="10" required><div class="form-control-line"></div>
																	</div>
																</div>
														</div>

														<div class="row no-y-padding">
																<button type="button" class="new-category btn ink-reaction btn-sm btn-floating-action btn-primary btn-loading-state pull-right" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Valider" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>
																<button type="button"  data-dismiss="modal" class=" btn ink-reaction btn-sm btn-floating-action btn-default-dark pull-right mr-lg" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Annuler"><i class="fa fa-undo"></i></button>
														</div>
                            <br/>
                        </form>
										</div>
                </div>
						</div>
				</div>
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
												<input type="hidden" name="a-id" value=""><input type="hidden" name="a-libelle" value=""><input type="hidden" name="a-prix" value="">
												<div class="col-md-12">
													<div class="bl2 col-md-11 col-md-push-1">
															<p class="detail-info ml-lg -mt5"></p>
													</div>
												</div>
												<div class="form-group col-md-12 ">
                          <div class="col-md-1"></div>
                            <?php if ($this->m_parametre->droit_menu_url('room/categorie','A')): ?>
                              <div class="col-md-3 text-center">
  															<button type="button" class="up-s btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="fa fa-pencil"></i></button>
  															<p class="text-bold">Modifier</p>
                              </div>
                              <div class="col-md-3 text-center">
  															<button type="button" class="us-s btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="fa fa-dollar"></i></button>
  															<p class="text-bold">Changer le prix</p>
                              </div>
                            <?php endif; ?>

                            <?php if ($this->m_parametre->droit_menu_url('room/categorie','S')): ?>
                              <div class="col-md-5 text-center">
																<button type="button" class="del-s btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="fa fa-trash-o"></i></button>
																<p class="text-bold">Supprimer la catégorie</p>
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
                    <h3 class="text-bold text-primary"> Mise à jour de la catégorie</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="update" class="form-horizontal form-validate" role="form" >
                            <input type="hidden" name="up-id" value=""><input type="hidden" name="old-libelle" value="">
                            <div class="col-sm-12">
                                <div class="form-group col-sm-12 ">
                                  <label for="up-libelle" class="col-sm-3 control-label">Désignation</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control input-sm" id="up-libelle" name="up-libelle" maxlength="10" required><div class="form-control-line"></div>
                                  </div>
                                </div>
                            </div>

                            <div class="row no-y-padding">
                                <button type="button" class="update btn ink-reaction btn-sm btn-floating-action btn-primary btn-loading-state pull-right" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Valider" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>
                                <button type="button" data-dismiss="modal" class="btn ink-reaction btn-sm btn-floating-action btn-default-dark pull-right mr-lg" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Annuler"><i class="fa fa-undo"></i></button>
                            </div>
                            <br/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade middle" id="us" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-bold text-primary"> Mise à jour du prix</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="usdate" class="form-horizontal form-validate" role="form" >
                            <input type="hidden" name="us-id" value=""><input type="hidden" name="us-libelle" value="">
														<div class="col-sm-12">
																<div class="form-group col-sm-12 ">
																	<label for="us-prix" class="col-sm-3 control-label">Prix</label>
																	<div class="col-sm-9">
																			<input type="text" class="form-control input-sm" id="us-prix" name="us-prix" data-rule-number required><div class="form-control-line"></div>
																	</div>
																</div>
														</div>

                            <div class="row no-y-padding">
                                <button type="button" class="usdate btn ink-reaction btn-sm btn-floating-action btn-primary btn-loading-state pull-right" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Valider" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>
                                <button type="button" data-dismiss="modal" class="btn ink-reaction btn-sm btn-floating-action btn-default-dark pull-right mr-lg" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Annuler"><i class="fa fa-undo"></i></button>
                            </div>
                            <br/>
                        </form>
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
                            <input type="hidden" name="del-id" value=""><input type="hidden" name="del-libelle" value="">
                            <div class="col-sm-12">
                              <h4 class="text-danger">Voulez-vous vraiment supprimer la categorie <span class="del-lib text-bold text-primary"></span><span class="text-xxl text-danger">?</span></h4>
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
