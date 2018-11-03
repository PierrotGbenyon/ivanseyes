<div class="style-breadcrumb no-y-padding">
	<ol class="breadcrumb">
		<li class=""><a href="<?php echo base_url('accueil'); ?>">Accueil</a></li>
		<li class="active">Sauvegarde</li>
	</ol>
</div>

<section>
	<div class="section-body">

		<div class="col-md-12 list">
	    <div class="card border-lr2_gr">
	        <div class="card-head card-head-xs text-left text-bold style-primary">
						<header class=""><i class="fa fa-cloud-upload"></i> Liste des sauvegardes</header>
					</div>

					<div class="card-body text-center">
							<?php   if ($this->m_parametre->droit_menu_url('sauvegarde','C')) { ?>
			                <button class="btn btn-sm ink-reaction btn-floating-action btn-primary btn-raised new_btn" data-original-title="Nouvelle sauvegarde" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-plus"></i></button>
              <?php   } ?>
						<div class="row">
	            <div class="col-lg-12">
	                <div class="table-responsive">
	                    <table id="datatable1" class="table table-striped table-hover">
	                        <thead>
	                            <tr>
																	<th class="wdth-15 sort-alpha">Date</th>
																	<th class="sort-alpha">Description</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        <?php
															$i = 1;
	                            if ($list_backup != false)
	                            foreach ($list_backup->result() as $val) {
	                        ?>
	                                <tr class="gradeX">
																			<td class="text-left"><?php echo $val->date_s ?></td>
																			<td class="text-left"><?php echo $val->description.' '.$val->created ?></td>
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


	</div>
</section>
