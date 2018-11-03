<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class _404 extends CI_Controller
{

  function __construct() {

    parent::__construct();
    //if (!$this->m_parametre->is_logged_in()) redirect('login/disconnect');
  }

  public function index() {

    $this->lay_out->set_pattern('403');
		$this->lay_out->set_title('Accès refusé | Ivan\'Eye');

		$this->lay_out->view('nothing');
	}

}
