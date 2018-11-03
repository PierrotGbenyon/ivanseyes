<section class="full-bleed">
    <div class="section-body style-primary force-padding">
        <div class="img-backdrop" style="background-image: url()"></div>
        <div class="row">
            <div class="col-md-3 col-xs-5">
                <img class="img-circle border-white border-xl img-responsive" src="<?php echo img('utilisateur/'.$this->session->userdata('photo')) ?>" alt="Photo de profil" style="width: 130px; height: 130px;" />
                <h3><?php echo $this->session->userdata('nom') ?><br/><small style="color:white !important;"><?php echo $this->session->userdata('profil') ?></small></h3>
            </div>
            <div class="col-md-9 col-xs-7">
                <div class="width-3 text-center pull-right">
                    <strong class="text-xl"><?php echo $nb_action ?></strong><br/>
                    <span class="text-light opacity-75">action<?php if($nb_action>1) echo 's' ?></span>
                </div>
            </div>
        </div>
        <div class="stick-bottom-right force-padding text-right">
            <a class="password btn btn-icon-toggle text-default-bright" data-toggle="tooltip" data-placement="top" data-original-title="Changer le mot de passe"><i class="md md-edit"></i></a>
            <!-- <a class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="Follow me"><i class="fa fa-twitter"></i></a>
            <a class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="Personal info"><i class="fa fa-facebook"></i></a> -->
        </div>
    </div>
</section>

<section>
    <div class="section-body no-margin">
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-primary">Dernières actions</h2>
                <div class="tab-pane" id="activity">
                    <ul class="timeline collapse-xs collapse-sm collapse-md collapse-lg">
                    <?php
                        if ($list_action != false) { $i=0;
                            foreach ($list_action->result() as $val)
                            {
                    ?>
                                <li class="<?php if($i%2==0) echo'timeline-inverted' ?>">
                                    <div class="timeline-circ <?php if($i%2==0) echo'style-primary2'; else echo 'style-primary3'?>"></div>
                                    <div class="timeline-entry">
                                        <div class="card style-default-light">
                                            <div class="card-body small-padding">
                                                <span class="text-medium"><?php echo $val->intitule ?></span><br/>
                                                <span class="opacity-50">
                                                    <?php echo $val->created.' à '.$val->heure ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                    <?php
                                $i++;
                            }
                        }
                    ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
              <h2 class="text-primary">Changement du mot de passe</h2>
              <br/>
              <form id="password-form" class="form-horizontal form-validate" role="form">
                <div class="card style-default-light">
                  <div class="card-body">
                    <div class="col-sm-12">
                        <div class="form-group col-md-12 ">
                            <label for="old_pwd" class="col-md-3 control-label text-bold">Ancien</label>
                            <div class="col-md-9">
                                <input type="password" placeholder="ancien mot de passe" class="form-control input-sm" id="old_pwd" name="old_pwd" maxlength="50" required><div class="form-control-line"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="new_pwd" class="col-md-3 control-label text-bold">Nouveau</label>
                            <div class="col-md-9">
                                <input type="password" placeholder="nouveau mot de passe" class="form-control input-sm" id="new_pwd" name="new_pwd" min="0" required><div class="form-control-line"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="conf_pwd" class="col-md-3 control-label text-bold">Confirmation</label>
                            <div class="col-sm-9">
                                <input type="password" placeholder="" class="form-control input-sm" id="conf_pwd" name="conf_pwd" min="0" required><div class="form-control-line"></div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="card-actionbar">
                      <div class="card-actionbar-row">
                          <button type="button" class="up-password btn ink-reaction btn-sm btn-floating-action btn-primary btn-loading-state pull-right" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Valider" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>
                          <button type="reset" class="_close btn ink-reaction btn-sm btn-floating-action btn-default-dark pull-right margin-right-lg" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Annuler"><i class="fa fa-undo"></i></button>
                      </div>
                  </div>
                </div>
              </form>
            </div>

            <!-- <div class="col-lg-4 col-md-4">
                <div class="card card-underline style-default-light">
                    <div class="card-head">
                        <header><small>Mes informations</small></header>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="card-body no-padding">
                        <ul class="list">
                            <li class="tile">
                                <a class="tile-content ink-reaction">
                                    <div class="tile-icon">
                                        <i class="fa fa-user-secret"></i>
                                    </div>
                                    <div class="tile-text">
                                        <?php echo $this->session->userdata('pseudo') ?>
                                        <small>Nom d'utilisateur</small>
                                    </div>
                                </a>
                            </li>
                            <li class="divider-inset"></li>
                            <li class="tile">
                                <a class="tile-content ink-reaction">
                                    <div class="tile-icon">
                                        <i class="md md-location-on"></i>
                                    </div>
                                    <div class="tile-text">
                                        <small><?php echo $this->session->userdata('address') ?></small>
                                    </div>
                                </a>
                            </li>
                            <li class="divider-inset"></li>
                            <li class="tile">
                                <a class="tile-content ink-reaction">
                                    <div class="tile-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="tile-text">
                                        <small><?php echo $this->session->userdata('contact') ?></small>
                                    </div>
                                </a>
                            </li>
                            <li class="divider-inset"></li>
                            <li class="tile">
                                <a class="tile-content ink-reaction">
                                    <div class="tile-icon">
                                        <i class="md md-mail"></i>
                                    </div>
                                    <div class="tile-text">
                                        <small><?php echo $this->session->userdata('email') ?></small>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->

        </div>
    </div>
</section>
