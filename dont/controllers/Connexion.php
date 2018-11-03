<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Connexion extends CI_Controller {

  function __construct() {

    parent::__construct();
    $this->load->model('m_user');
  }

  public function index() {

		$this->lay_out->set_pattern('login');
		$this->lay_out->set_title('Connexion | Ivan\'sEyes');
    $this->lay_out->view('nothing');
	}

  public function connect() {

		$this->form_validation->set_rules('username','Utilisateur','trim|required|alpha_dash|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|alpha_dash|encode_php_tags|xss_clean');

    $out = 0;
		if ($this->form_validation->run()) {

			$log = $this->input->post('username');
			$pas = $this->input->post('password');

			$result = $this->m_user->get($log);
			if ($result)
				if (check_password($pas,$result->password)) {

					if ($result->actif) {

              $data['user_id']= $result->id_user;
              $data['profil']= $result->nom_profil;
              $data['pseudo'] = $log;
              $data['lock']= false;
              $data['last']= false;
              $data['logged_in']= true;
              $data['nom']= $result->nom.' '.$result->prenom;
              $data['photo']= $result->photo;

              $this->session->set_userdata($data);
              $this->m_action->new_action('Connexion de '.$log,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' s\'est connecté à Ivan\'sEyes');
							if ($result->first_use) {
								$this->m_user->not_first_use($result->id_user);
								$out = 5;
							}
							else $out = 1;
					}
					else $out = 4;
				}
				else $out = 3;
			else $out = 2;
		}
		else $out = 0;

    $data0= array('out'=>$out);
    // $data0= array('out'=>$out, 'token' => $this->security->get_csrf_token_name(), 'hash'=>$this->security->get_csrf_hash());
    echo json_encode($data0);
	}

  public function disconnect() {

    if ($this->m_parametre->is_logged_in()) $this->m_action->new_action('Déconnexion de '.$this->session->userdata('pseudo'),$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' s\'est déconnecté de Ivan\'sEyes');
		session_destroy();
		redirect('connexion');
	}

}
