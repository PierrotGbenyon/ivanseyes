<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Chambre extends CI_Controller {

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
    $this->load->model('m_chambre');
  }

  public function index() {

    $this->load->model('m_categorie');
		$this->lay_out->set_pattern('app');
		$this->lay_out->set_menu($this->m_parametre->list_menu());
		$this->lay_out->set_title('Chambre | Ivan\'sEyes');
		$this->lay_out->set_groove('Nos chambres');

		$this->lay_out->add_css(array('libs/select2/select2','libs/toastr/toastr'));
		$this->lay_out->add_js(array('libs/select2/select2','libs/toastr/toastr','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/nanoscroller/jquery.nanoscroller.min'));
		$this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents','function/chambre'));

    $data['liste_chambre'] = $this->m_chambre->liste();
    $data['liste_categorie'] = $this->m_categorie->liste();

		$this->lay_out->view('room/room',$data);
	}

  public function new_chambre() {

    $this->form_validation->set_rules('code','Code','trim|required|alpha_dash|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('categorie','Catégorie','trim|required|is_natural|encode_php_tags|xss_clean');

    if ($this->form_validation->run()) {

      $code = $this->input->post('code');
      $categorie = $this->input->post('categorie');

      if ($this->m_chambre->authorize($code))
        if ($this->m_chambre->new_chambre($code,$categorie))
          echo $this->m_action->new_action('Création de la chambre '.$code,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a crée la chambre '.$code);
        else echo 3;
      else echo 2;
    }
    else  echo 0;
  }

  public function info() {

    $data = $this->m_chambre->get_information($this->input->get('id'));
    if($data) echo json_encode($data);
    else echo json_encode(0);
  }

  public function update(){

    $old = $this->input->post('old-code');
    $lib = $this->input->post('up-code');
    if($this->m_chambre->update($this->input->post('up-id'),$this->input->post('up-code')))
      echo $this->m_action->new_action('Mise à jour de la chambre '.$old.' en '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a changé la chambre '.$old.' en '.$lib);
    else echo 3;
  }

  public function delete(){

    $id = $this->input->post('del-id');
    $lib = $this->input->post('del-code');
    if($this->m_chambre->delete($id)) {
      $this->m_action->new_action('Suppression de la chambre '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a supprimé la chambre '.$lib);
      echo $this->m_corbeille->new_corbeille('md md-hotel',$id,'m_chambre','Chambre '.$lib);
    }else echo 3;
  }


}
