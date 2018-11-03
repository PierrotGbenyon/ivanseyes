<div class="style-breadcrumb no-y-padding">
	<ol class="breadcrumb">
		<li class=""><a href="<?php echo base_url('accueil'); ?>">Accueil</a></li>
		<li class="active">Historique des actions</li>
	</ol>
</div>

<section>
	<div class="section-body">

		<div class="col-md-12 list">
	    <div class="card border-lr2_gr">
	        <div class="card-head card-head-xs text-left text-bold style-primary">
						<header class=""><i class="fa fa-history"></i> Historique des actions</header>
					</div>

					<div class="card-body text-center">
						<div class="row">
	            <div class="col-lg-12">
	                <div class="table-responsive">
	                    <table id="datatable1" class="table table-hover table-responsive">
	                        <thead>
	                            <tr>
	                                <th class="wdth-25 sort-alpha">Intitulé</th>
	                                <th class="sort-alpha">Description</th>
																	<th class="wdth-15 sort">Date</th>
	                            </tr>
	                        </thead>
	                        <tbody class="history-body">
	                        <?php
	                            if ($list_action != false)
	                            foreach ($list_action->result() as $val) {
	                        ?>
	                                <tr class="gradeX" style="min-height:80px;">
	                                    <td class="text-left"><?php echo $val->intitule ?></td>
	                                    <td class="text-left" ><?php echo $val->description.' le '.$val->created.' à '.$val->heure ?></td>
	                                    <td class="text-left"><?php echo 'le '.$val->created ?></td>
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
