<div class="style-breadcrumb no-y-padding">
	<ol class="breadcrumb">
		<li class=""><a href="<?php echo base_url('accueil'); ?>">Accueil</a></li>
		<li class="active">Solde</li>
	</ol>
</div>

<section>
	<div class="section-body">

		<div class="col-md-12 list">
	    <div class="card border-lr2_gr">
	        <div class="card-head card-head-xs text-left text-bold style-primary">
						<header class=""><i class="fa fa-money"></i> Solde journalier</header>
					</div>

					<div class="card-body text-center">
							<?php   if ($this->m_parametre->droit_menu_url('caisse','C')) if (!$this->m_parametre->is_chest()){  ?>
			                <button class="btn btn-sm ink-reaction btn-floating-action btn-primary btn-raised new_btn" data-original-title="Ouvrir la caisse" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"><i class="fa fa-plus"></i></button>
							<?php   } ?>
						<div class="row">
	            <div class="col-lg-12">
	                <div class="table-responsive">
	                    <table id="datatable1" class="table table-striped table-hover">
	                        <thead>
	                            <tr>
																	<th class="wdth-15 sort-alpha">Date</th>
																	<th class="sort">Solde initial</th>
	                                <th class="sort">Solde final</th>
																	<!-- <th class="sort wdth-10">Opérations</th> -->
	                                <th class="wdth-5"></th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        <?php
															$i = 1;
	                            if ($liste_caisse != false)
	                            foreach ($liste_caisse->result() as $val) {
	                        ?>
	                                <tr class="gradeX">
																			<td class="text-left"><?php if ($val->date_c == date('Y-m-d')) echo 'Aujourd\'hui'; else echo $val->date_caisse; ?></td>
																			<td class="text-left"><?php echo number_format($val->montant_ov,0,',',' ').'F CFA' ?></td>
	                                    <td class="text-left"><?php echo number_format($val->montant_fr,0,',',' ').'F CFA' ?></td>
	                                    <!-- <td class="text-left"><?php echo $val->nb?></td> -->

	                                    <td class="text-right" id="<?php echo $val->id_caisse ?>">
																				<a class="action btn ink-reaction btn-icon-toggle btn-xs" data-original-title="Action" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"><i class="fa fa-cog"></i></a>
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
										<h3 class="text-bold text-primary"> Ouvrir la caisse</h3>
								</div>
								<div class="modal-body">
										<div class="row">
												<form id="new-box" class="form-horizontal form-validate" role="form" >
														<div class="col-sm-12">
                              <?php if($old) {?>
                                <div class="checkbox checkbox-styled checkbox-info ml-xl">
                                  <label>
                                    <input name="choix" type="checkbox" value="<?php if($old_solde) echo $old_solde; ?>">
                                    <span>Ouvrir avec le solde final de la caisse précédente</span>
                                  </label>
                                </div>
                              <?php }?>
																<div class="form-group col-sm-12 ">
																	<label for="date_c" class="col-sm-3 control-label">Date</label>
																	<div class="col-sm-4">
																			<input type="text" class="form-control input-sm" id="date_c" name="date_c" value="<?php echo date('d M Y',local_to_gmt());?>" readonly><div class="form-control-line"></div>
																	</div>
																</div>
																<div class="form-group col-sm-12 ">
																	<label for="mt" class="col-sm-3 control-label">Solde initial</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="mt" name="mt" data-rule-number required><div class="form-control-line"></div>
        													</div>
																</div>
														</div>

														<div class="row no-y-padding">
																<button type="button" class="new-box btn ink-reaction btn-sm btn-floating-action btn-primary btn-loading-state pull-right" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Valider" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>
																<button type="button" data-dismiss="modal" class="btn ink-reaction btn-sm btn-floating-action btn-default-dark pull-right mr-lg" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Annuler"><i class="fa fa-undo"></i></button>
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
												<input type="hidden" name="a-id" value=""><input type="hidden" name="a-date" value="">
												<div class="col-md-12">
													<div class="bl2 col-md-11 col-md-push-1">
															<p class="detail-info ml-lg"></p>
													</div>
												</div>
												<div class="form-group col-md-12 ">
													<?php if ($this->m_parametre->droit_menu_url('caisse','C')): ?>
															<div class="text-center">
																<button type="button" class="co btn btn-sm ink-reaction btn-floating-action btn-primary"><i class="md md-remove-red-eye"></i></button>
																<p class="text-bold">Consulter les oppérations</p>
															</div>
													<?php endif; ?>
												</div>
											</form>
									</div>

							</div>
					</div>
			</div>
		</div>

    <form method="post" action="<?php echo base_url('bank/sel_chest')?>">
			<input type="hidden" value="" name="id_chest">
			<button type="submit" class="sel-chest hid"></button>
		</form>

	</div>
</section>
