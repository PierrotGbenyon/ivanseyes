<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Accueil extends CI_Controller {

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
  }

  public function index() {
		$this->lay_out->set_pattern('app');
		$this->lay_out->set_menu($this->m_parametre->list_menu());
		$this->lay_out->set_title('Accueil | Ivan\'sEyes');
		$this->lay_out->set_groove('Accueil');

    $this->lay_out->add_css(array('libs/toastr/toastr','libs/select2/select2'));
		$this->lay_out->add_js(array('libs/toastr/toastr','libs/inputmask/jquery.inputmask.bundle.min','libs/select2/select2','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/nanoscroller/jquery.nanoscroller.min'));
		$this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents',));

		$this->lay_out->view('welcome');
	}

  public function test() {
    print_r($this->session->userdata());
  }

}
