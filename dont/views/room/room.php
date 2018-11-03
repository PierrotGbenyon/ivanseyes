<div class="style-breadcrumb no-y-padding">
	<ol class="breadcrumb">
		<li class=""><a href="<?php echo base_url('acueil'); ?>">Accueil</a></li>
		<li class="active">Chambre</li>
	</ol>
</div>

<section>
	<div class="section-body">
    <?php   if ($this->m_parametre->droit_menu_url('room/chambre','A')) { ?>
          <button type="button" class="btn btn-sm ink-reaction btn-xs btn-raised btn-primary -ml8 new_btn" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Nouvelle chambre"><i class="fa fa-plus"></i></button>
    <?php   } ?>

  <?php
    $id =0;
      if ($liste_chambre != false)
      foreach ($liste_chambre->result() as $val) {
        if ($id != $val->id_categorie) {
          if ($id != 0) echo '</div>';
          $id = $val->id_categorie;
  ?>
          <div class="row list mb-xl">
            <p class="bb1 text-xl text-primary text-left"><?php echo $val->libelle ?></p>
            <?php if($val->id_chambre){ ?>
              <div class="col-md-2 col-xs-3">
                <div class="card style-primary">
                  <div class="card-body height-2 scroll">
                    <span class="text-bold text-lg"><?php echo $val->code ?></span><br/><br/>
                    <small id="<?php echo $val->id_chambre ?>">
                        <a class="action parameter btn btn-xs btn-icon-toggle ink-reaction pull-left -ml8 -mt16" data-original-title="Action" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"><i class="fa fa-gear"></i></a>
                    </small>
                  </div>
                 </div>
              </div>
              <?php }
            }
            else{ ?>
              <?php if($val->id_chambre){ ?>
                <div class="col-md-2 col-xs-3">
                  <div class="card style-primary">
                    <div class="card-body height-2 scroll">
                      <span class="text-bold text-lg"><?php echo $val->code ?></span><br/><br/>
                      <small id="<?php echo $val->id_chambre ?>">
                          <a class="action parameter btn btn-xs btn-icon-toggle ink-reaction pull-left -ml8 -mt16" data-original-title="Action" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"><i class="fa fa-gear"></i></a>
                      </small>
                    </div>
                   </div>
                </div>
                <?php }
                }
              }
            ?>

		<div class="modal fade middle" id="new" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
				<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<h3 class="text-bold text-primary"> Nouvelle chambre</h3>
								</div>
								<div class="modal-body">
										<div class="row">
												<form id="new-room" class="form-horizontal form-validate" role="form" >
														<div class="col-sm-12">
																<div class="form-group col-sm-12 ">
																	<label for="code" class="col-sm-3 control-label">Code</label>
																	<div class="col-sm-4">
																			<input type="text" class="form-control input-sm" id="code" name="code" maxlength="6" required><div class="form-control-line"></div>
																	</div>
																</div>
																<div class="form-group col-sm-12 ">
																	<label for="categorie" class="col-sm-3 control-label">Catégorie</label>
                                  <div class="col-sm-9">
        															<select id="categorie" name="categorie" class="categorie form-control input-sm search-select" required>
        																<option></option>
        															<?php
        																	if ($liste_categorie != false)
        																	foreach ($liste_categorie->result() as $val) {
        															?>
        																	<option value="<?php echo $val->id_categorie?>"> <?php echo $val->libelle ?></option>
        															<?php } ?>
        															</select>
        													</div>
																</div>
														</div>

														<div class="row no-y-padding">
																<button type="button" class="new-room btn ink-reaction btn-sm btn-floating-action btn-primary btn-loading-state pull-right" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Valider" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>
																<button type="button" class="close-modal btn ink-reaction btn-sm btn-floating-action btn-default-dark pull-right mr-lg" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Annuler"><i class="fa fa-undo"></i></button>
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
												<input type="hidden" name="a-id" value=""><input type="hidden" name="a-code" value="">
												<div class="col-md-12">
													<div class="bl2 col-md-11 col-md-push-1">
															<p class="detail-info ml-lg -mt5"></p>
													</div>
												</div>
												<div class="form-group col-md-12 ">
                          <div class="col-md-2"></div>
                            <?php if ($this->m_parametre->droit_menu_url('room/chambre','A')): ?>
                              <div class="col-md-3 text-center">
  															<button type="button" class="up-s btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="fa fa-pencil"></i></button>
  															<p class="text-bold">Modifier</p>
                              </div>
                            <?php endif; ?>

                            <?php if ($this->m_parametre->droit_menu_url('room/chambre','S')): ?>
                              <div class="col-md-7 text-center">
																<button type="button" class="del-s btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="fa fa-trash-o"></i></button>
																<p class="text-bold">Supprimer la chambre</p>
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
                    <h3 class="text-bold text-primary"> Mise à jour de la chambre</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="update" class="form-horizontal form-validate" role="form" >
                            <input type="hidden" name="up-id" value=""><input type="hidden" name="old-code" value="">
                            <div class="col-sm-12">
                                <div class="form-group col-sm-12 ">
                                  <label for="up-code" class="col-sm-3 control-label">Code</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control input-sm" id="up-code" name="up-code" maxlength="10" required><div class="form-control-line"></div>
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

    <div class="modal fade middle" id="del" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-action">
                <div class="modal-body">
                    <div class="row">
                        <form id="delete" class="form-horizontal form-validate" role="form" >
                            <input type="hidden" name="del-id" value=""><input type="hidden" name="del-code" value="">
                            <div class="col-sm-12">
                              <h4 class="text-danger">Voulez-vous vraiment supprimer la chambre <span class="del-lib text-bold text-primary"></span><span class="text-xxl text-danger">?</span></h4>
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
