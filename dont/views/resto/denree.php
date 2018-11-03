<div class="style-breadcrumb no-y-padding">
	<ol class="breadcrumb">
		<li class=""><a href="<?php echo base_url('accueil'); ?>">Accueil</a></li>
		<li class="active">Stock</li>
	</ol>
</div>

<section>
	<div class="section-body">

		<div class="col-md-12 list">
	    <div class="card b2-p">
	        <div class="card-head card-head-xs text-left text-bold style-primary">
						<header class=""><i class="md md-restaurant-menu"></i> Liste des denrees</header>
					</div>

					<div class="card-body text-center">
							<?php   if ($this->m_parametre->droit_menu_url('resto/stock','C')) { ?>
			                <button class="btn btn-sm ink-reaction btn-floating-action btn-primary btn-raised new_btn" data-original-title="Nouvel utilisateur" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"><i class="fa fa-plus"></i></button>
							<?php   } ?>
						<div class="row">
	            <div class="col-lg-12">
	                <div class="table-responsive">
	                    <table id="datatable1" class="table table-striped table-hover">
	                        <thead>
	                            <tr>
																	<th class="wdth-5">#</th>
																	<th class="sort-alpha">Libellé</th>
																	<th class="wdth-15 sort-alpha">Qte</th>
	                                <th class="wdth-15 sort-alpha">Seuil</th>
	                                <th class="wdth-5"></th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        <?php
															$i = 1;
	                            if ($liste_denree != false)
	                            foreach ($liste_denree->result() as $val) {
	                        ?>
	                                <tr class="gradeX">
	                                    <td class="text-left"><?php echo $i++ ?></td>
																			<td class="text-left"><?php echo $val->libelle ?></td>
																			<td class="text-left"><?php echo $val->qte.' '.$val->unite.'s' ?></td>
																			<td class="text-left"><?php echo $val->seuil.' '.$val->unite.'s' ?></td>

	                                    <td class="text-right" id="<?php echo $val->id_denree ?>">
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

    <div class="modal fade middle" id="new" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-bold text-primary"> Nouvelle denrée</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="new-stuff" class="form-horizontal form-validate" role="form" >
                            <div class="col-sm-12">
                                <div class="form-group col-sm-12 ">
                                  <label for="lib" class="col-sm-2 control-label">Libellé</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control input-sm" id="lib" name="lib" maxlength="50" required><div class="form-control-line"></div>
                                  </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group col-sm-12 ">
                                  <label for="qte" class="col-sm-1 control-label">Qté</label>
                                  <div class="col-sm-3">
                                      <input type="text" class="form-control input-sm" id="qte" name="qte" data-rule-number required><div class="form-control-line"></div>
                                  </div>
                                  <label for="seuil" class="col-sm-1 control-label">Seuil</label>
                                  <div class="col-sm-3">
                                      <input type="text" class="form-control input-sm" id="seuil" name="seuil" data-rule-number required><div class="form-control-line"></div>
                                  </div>
                                  <label for="unite" class="col-sm-1 control-label">Unité</label>
                                  <div class="col-sm-3">
                                    <select id="unite" name="unite" class="unite form-control input-sm search-select" required>
      																<option></option>
                                      <?php
      																		if ($liste_unite != false)
      																			$list = mb_split(',', $liste_unite);
      																			for ($i=0; $list[$i]; $i++) {
      																?>
      																		<option value="<?php echo $list[$i] ?>"><?php echo $list[$i] ?></option>
      																<?php } ?>
      															</select>
                                  </div>
                                </div>
                            </div>

                            <div class="row no-y-padding">
                                <button type="button" class="new-stuff btn ink-reaction btn-sm btn-floating-action btn-primary btn-loading-state pull-right" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Valider" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>
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
												<input type="hidden" name="a-id" value=""><input type="hidden" name="a-libelle" value="">
												<div class="col-md-12">
													<div class="bl2 col-md-11 col-md-push-1">
															<p class="detail-info ml-lg -mt5"></p>
													</div>
												</div>
												<div class="form-group col-md-12 ">
                          <div class="col-md-2"></div>
                          <?php if ($this->m_parametre->droit_menu_url('resto/stock','A')): ?>
                            <div class="col-md-3 text-center">
															<button type="button" class="up-s btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="fa fa-pencil"></i></button>
															<p class="text-bold">Modifier</p>
                            </div>
                          <?php endif; ?>

                          <?php if ($this->m_parametre->droit_menu_url('resto/stock','S')): ?>
                            <div class="col-md-6 text-center">
															<button type="button" class="del-s btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="fa fa-trash-o"></i></button>
															<p class="text-bold">Supprimer la denrée</p>
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

    <div class="modal fade middle" id="up" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-bold text-primary"> Mise à jour de la denrée</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="update" class="form-horizontal form-validate" role="form" >
                            <input type="hidden" name="up-id" value=""><input type="hidden" name="old-libelle" value="">
                            <div class="col-sm-12">
                                <div class="form-group col-sm-12 ">
                                  <label for="up-libelle" class="col-sm-3 control-label">Libellé</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control input-sm" id="up-libelle" name="up-libelle" maxlength="50" required><div class="form-control-line"></div>
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
                                  <h4 class="text-danger">Voulez-vous vraiment supprimer la denrée <span class="del-lib text-bold text-primary"></span><span class="text-xxl text-danger">?</span></h4>
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
