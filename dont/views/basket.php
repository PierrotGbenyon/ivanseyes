<div class="style-breadcrumb no-y-padding">
	<ol class="breadcrumb">
		<li class=""><a href="<?php echo base_url('acueil'); ?>">Accueil</a></li>
		<li class="active">Corbeille</li>
	</ol>
</div>

<section>
	<div class="section-body">

    <div class="row list">
			<?php
					if ($liste_corbeille != false)
					foreach ($liste_corbeille->result() as $val) {
			?>
  			<div class="col-md-2 col-xs-3">
  				<div class="card style-default-light">
  					<div class="card-body height-3 scroll no-y-padding">
  						<span class="text-center"><i class="<?php echo $val->icone ?>"></i></span><br/>
  						<span class="text-small"><?php echo $val->description ?></span><br/><br/>
  						<span class="hid"><?php echo $val->deleted ?></span>
  						<span class="hid"><?php echo $val->model ?></span>
  						<span class="hid"><?php echo $val->id ?></span>
              <small id="<?php echo $val->id_corbeille ?>">
                  <a class="action parameter btn btn-xs btn-icon-toggle ink-reaction pull-left -ml8 -mt16" data-original-title="Actions" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"><i class="fa fa-gear"></i></a>
              </small>
  					</div>
  				 </div>
			  </div>
				<?php }?>
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
												<input type="hidden" name="a-id" value=""><input type="hidden" name="a-idd" value=""><input type="hidden" name="a-model" value=""><input type="hidden" name="a-desc" value="">
												<div class="col-md-12">
													<div class="bl2 col-md-11 col-md-push-1">
															<p class="detail-info ml-lg -mt5"></p>
													</div>
												</div>
												<div class="form-group col-md-12 ">
                          <div class="col-md-2"></div>
                            <?php if ($this->m_parametre->droit_menu_url('corbeille','R')): ?>
                              <div class="col-md-3 text-center">
  															<button type="button" class="rt-s btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="fa fa-history"></i></button>
  															<p class="text-bold">Restaurer</p>
                              </div>
                            <?php endif; ?>

                            <?php if ($this->m_parametre->droit_menu_url('corbeille','S')): ?>
                              <div class="col-md-7 text-center">
																<button type="button" class="del-s btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="fa fa-trash-o"></i></button>
																<p class="text-bold">Supprimer définitivement</p>
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

    <div class="modal fade middle" id="del" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
				<div class="modal-dialog">
						<div class="modal-content modal-action">
								<div class="modal-body">
									<div class="row">
											<form id="delete" class="form-horizontal form-validate" role="form">
												<input type="hidden" name="del-id" value=""><input type="hidden" name="del-idd" value=""><input type="hidden" name="del-desc" value=""><input type="hidden" name="del-model" value="">
												<div class="form-group col-md-12 text-center">
														<h4 class="text-danger">Etes-vous sûr de vouloir supprimer définitivement le/la <span class="del-desc text-bold text-primary"></span><span class="text-xl text-danger">?</span></h4>
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

    <div class="modal fade middle" id="rt" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
				<div class="modal-dialog">
						<div class="modal-content modal-action">
								<div class="modal-body">
									<div class="row">
											<form id="restore" class="form-horizontal form-validate" role="form" >
												<input type="hidden" name="rt-id" value=""><input type="hidden" name="rt-idd" value=""><input type="hidden" name="rt-desc" value=""><input type="hidden" name="rt-model" value="">
												<div class="form-group col-md-12 text-center">
														<h4 class="text-danger">Etes-vous sûr de vouloir restaurer le/la <span class="rt-desc text-bold text-primary"></span><span class="text-xl text-danger">?</span></h4>
												</div>
												<div class="row no-y-padding">
														<button type="button" class="restore btn ink-reaction btn-sm btn-floating-action btn-primary btn-loading-state pull-right" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Restaurer" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>
														<button type="button" data-dismiss="modal" class="btn ink-reaction btn-sm btn-floating-action pull-right mr-lg" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Annuler"><i class="fa fa-close"></i></button>
												</div>
											</form>
									</div>
								</div>
						</div>
				</div>
		</div>
