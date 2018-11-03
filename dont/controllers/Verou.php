<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Verou extends CI_Controller {

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
  }

  public function index() {

		$this->lay_out->set_pattern('lock');
		$this->lay_out->set_title('Vérou | Ivan\'sEyes');
    $this->lay_out->view('nothing');
	}

  public function lock() {

		$this->session->set_userdata('last',$this->input->post('lien'));
		echo $this->session->userdata('last');
	}

  public function unlock() {

    $this->load->model('m_user');
		$this->form_validation->set_rules('pass','Password','trim|required|alpha_dash|encode_php_tags|xss_clean');

    $out;
		if ($this->form_validation->run()) {
      $pas = $this->input->post('pass');

			$result = $this->m_user->get_password($this->session->userdata('pseudo'));
			if ($result)
				if (check_password($pas,$result)) $out = $this->session->userdata('last');
				else $out = 3;
			else $out = 2;
		}
		else $out = 0;

    $data0= array('out'=>$out);
    echo json_encode($data0);
	}

}
