<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class _404 extends CI_Controller
{

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
  }

  public function index() {

		$this->lay_out->set_pattern('app');
		$this->lay_out->set_menu($this->m_parametre->list_menu());
		$this->lay_out->set_title('404 | Ivan\'sEye');

		$this->lay_out->add_js(array('libs/nanoscroller/jquery.nanoscroller.min'));
		$this->lay_out->view('404');
	}

}
