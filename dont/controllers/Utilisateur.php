<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Utilisateur extends CI_Controller {

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
    $this->load->model('m_user');
  }

  public function index() {

    $this->load->model('m_profil');
    $this->lay_out->set_pattern('app');
		$this->lay_out->set_menu($this->m_parametre->list_menu());
		$this->lay_out->set_title('Utilisateur | Ivan\'sEyes');
		$this->lay_out->set_groove('Utilisateur');

		$this->lay_out->add_css(array('libs/select2/select2','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/wizard/wizard','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/dataTables.colVis','libs/DataTables/extensions/dataTables.tableTools'));
		$this->lay_out->add_js(array('libs/select2/select2','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/inputmask/jquery.inputmask.bundle.min','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','libs/bootstrap-datepicker/bootstrap-datepicker','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/wizard/jquery.bootstrap.wizard.min','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/ColVis/js/dataTables.colVis.min','libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min','libs/nanoscroller/jquery.nanoscroller.min'));
		$this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents','core/demo/DemoTableDynamic','function/user'));

    $data['list_user'] = $this->m_user->liste();
    $data['list_profile'] = $this->m_profil->liste();

		$this->lay_out->view('user/user',$data);
	}

  public function nvo_user() {

    $this->form_validation->set_rules('nom','nom','trim|required|alpha_dash|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('prenom','prenom','trim|required|alpha_dash|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('login','login','trim|required|alpha_dash|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('password','Mot de passe','trim|required|alpha_dash|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('confirm','Confirmation','trim|required|alpha_dash|matches[password]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('profil','Profil','trim|required|is_natural|encode_php_tags|xss_clean');

		if ($this->form_validation->run()) {

			$log = $this->input->post('login');
			$nom = $this->input->post('nom');
			$prenom = $this->input->post('prenom');
			$password = $this->input->post('password');
			$profil = $this->input->post('profil');
      $out;

			if ($this->m_user->authorize($log)) {
				if($this->m_user->new_user($profil,$nom,$prenom,$log,$password))
					$out = $this->m_action->new_action('Création du compte utilisateur '.$log,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a crée le compte '.$log.' pour '.$nom.' '.$prenom);
				else $out = 3;
			}
			else $out = 2;
		}
		else $out = 0;

    $data0= array('out'=>$out);
    echo json_encode($data0);
  }

  public function info() {

    $data = $this->m_user->get_information($this->input->get('id'));
    if($data) echo json_encode($data);
    else echo json_encode(0);
  }

  public function cg_etat() {

    if ($this->input->post('etat') == 'actif') {
  			if ($this->m_user->lock($this->input->post('a-id')))
          echo $this->m_action->new_action('Désactivation du compte '.$this->input->post('a-login'),$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a désactivé le compte '.$this->input->post('a-login'));
        else echo 3;
		}
    else {
      if ($this->m_user->unlock($this->input->post('a-id')))
        echo $this->m_action->new_action('Activation du compte '.$this->input->post('a-login'),$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a activé le compte '.$this->input->post('a-login'));
      else echo 3;
		}
  }

  public function delete() {

    if ($this->m_user->delete($this->input->post('a-id'))) {
		    $this->m_action->new_action('Suppression','Suppression du compte '.$this->input->post('a-login'),$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a désactivé le compte '.$this->input->post('a-login'));
        echo $this->m_corbeille->new_corbeille('fa fa-user',$this->input->post('a-id'),'m_user','Utilisateur '.$this->input->post('a-login'));
      }else echo 3;
  }

  public function mon_compte() {

    $this->lay_out->set_pattern('app');
		$this->lay_out->set_menu($this->m_parametre->list_menu());
		$this->lay_out->set_title($this->session->userdata('pseudo').' | Ivan\'sEyes');
		$this->lay_out->set_groove('Utilisateur');

		$this->lay_out->add_css(array('libs/toastr/toastr','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/wizard/wizard','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/dataTables.colVis','libs/DataTables/extensions/dataTables.tableTools'));
		$this->lay_out->add_js(array('libs/toastr/toastr','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/inputmask/jquery.inputmask.bundle.min','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','libs/bootstrap-datepicker/bootstrap-datepicker','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/wizard/jquery.bootstrap.wizard.min','libs/nanoscroller/jquery.nanoscroller.min'));
		$this->lay_out->add_end_js(array('core/demo/DemoUIMessages','function/user_account'));

    $data['nb_action'] = $this->m_action->get_number($this->session->userdata('user_id'));
		$data['list_action'] = $this->m_action->get_limited_action($this->session->userdata('user_id'),5);

		$this->lay_out->view('user/account',$data);
  }

  public function change_password() {

    $this->form_validation->set_rules('old_pwd','Ancien','trim|required|alpha_dash|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('new_pwd','Nouveau','trim|required|alpha_dash|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('conf_pwd','Confirmation','trim|required|alpha_dash|matches[new_pwd]|encode_php_tags|xss_clean');

		if ($this->form_validation->run()) {

			$old = $this->input->post('old_pwd');
			$new = $this->input->post('new_pwd');
      $result = $this->m_user->get_password($this->session->userdata('pseudo'));

			if (check_password($old,$result))
        if($this->m_user->cg_password($new))
          echo $this->m_action->new_action('Mise à jour du compte '.$this->session->userdata('pseudo'),$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a changé son mot de passe');
				else echo 3;
			else echo 5;
		}
		else echo 0;
  }

}
