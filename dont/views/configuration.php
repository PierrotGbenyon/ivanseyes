<div class="style-breadcrumb no-y-padding">
	<ol class="breadcrumb">
		<li class=""><a href="<?php echo base_url('accueil'); ?>">Accueil</a></li>
		<li class="active">Paramètre</li>
	</ol>
</div>

<section class="config">
	<div class="section-body">

<!-- Category -->
		<div class="row">
			<div class="col-lg-6">
        <h2 class="text-primary">Catégorie de nourriture</h2>
				<article class="margin-bottom-xl">
          <p>
						Il s'agit d'éditer la liste des catgories de nourriture prise en compte par le système. Appuyer sur la touche entrée pour valider.
          </p>
        </article>
				<form class="form" accept-charset="utf-8">
					<input type="text" data-role="tagsinput" class="tagsinput" value="<?php if ($liste_categorie != false) echo $liste_categorie ?>" name="categorie">
				</form>
			</div>

			<div class="col-lg-6">
        <h2 class="text-primary">Unité des condiments</h2>
				<article class="margin-bottom-xl">
          <p>
            Il s'agit de spécifier le liste des différentes unités (ex: litre...) Appuyer sur la touche entrée pour valider.
          </p>
        </article>
				<form class="form" accept-charset="utf-8">
					<input type="text" data-role="tagsinput" class="tagsinput" value="<?php if ($liste_unite != false) echo $liste_unite ?>" name="unite">
				</form>
			</div>
    </div>

<!-- Nationality -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-primary">Nationalité</h2>
        </div>
        <div class="col-lg-10">
          <article class="margin-bottom-xl">
            <p>
              Il s'agit d'éditer la liste des nationalités prise en compte par le système. Appuyer sur la touche entrée pour valider.
            </p>
          </article>
        </div>
    </div>
    <div class="row">
				<div class="col-md-11">
  					<form class="form" accept-charset="utf-8">
							<input type="text" data-role="tagsinput" class="tagsinput" value="<?php if ($liste_nationalite != false) echo $liste_nationalite ?>" name="nvo_nationalite">
						</form>
			  </div>
    </div>

<!-- Country -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-primary">Pays</h2>
        </div>
        <div class="col-lg-10">
          <article class="margin-bottom-xl">
            <p>
              Il s'agit d'éditer la liste des pays prise en compte par le système. Appuyer sur la touche entrée pour valider.
            </p>
          </article>
        </div>
    </div>
    <div class="row">
				<div class="col-md-11">
  					<form class="form" accept-charset="utf-8">
							<input type="text" data-role="tagsinput" class="tagsinput" value="<?php if ($liste_pays != false) echo $liste_pays ?>" name="pays">
						</form>
			  </div>
    </div>

<!-- Save config -->
    <div class="row">
			<div class="col-lg-6 col-md-6">
        <h2 class="text-primary">Fréquence de sauvegarde</h2>
				<article class="margin-bottom-xl">
          <p>
            Il s'agit de spécifier la fréquence de sauvegarde des informations.
          </p>
        </article>
				<select id="sauvegarde" name="sauvegarde" class="form-control input-sm search-select" required>
					<option></option>
					<option value="1" <?php if ($sauvegare==1) echo "selected";?>>Journalière</option>
					<option value="3" <?php if ($sauvegare==3) echo "selected";?>>Bihebdomadaire (03 jours)</option>
					<option value="7" <?php if ($sauvegare==5) echo "selected";?>>Hebdomadaire (07 jours)</option>
				</select>
			</div>

			<div class="col-lg-6 col-md-6">
        <h2 class="text-primary">Fréquence de nettoyage de la corbeille</h2>
				<article class="margin-bottom-xl">
          <p>
            Il s'agit de spécifier a fréquence de nettoyage du journal des actions.
          </p>
        </article>
				<select id="corbeille" name="corbeille" class="form-control input-sm search-select" required>
					<option></option>
					<option value="1" <?php if ($corbeille==1) echo "selected";?>>Journalière</option>
					<option value="3" <?php if ($corbeille==3) echo "selected";?>>Bihebdomadaire (03 jours)</option>
					<option value="7" <?php if ($corbeille==7) echo "selected";?>>Hebdomadaire (05 jours)</option>
				</select>
			</div>
    </div>


</section>
