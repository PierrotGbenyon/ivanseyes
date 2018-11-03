<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Categorie extends CI_Controller {

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
    $this->load->model('m_categorie');
  }

  public function index() {

		$this->lay_out->set_pattern('app');
		$this->lay_out->set_menu($this->m_parametre->list_menu());
		$this->lay_out->set_title('Categorie | Ivan\'sEyes');
		$this->lay_out->set_groove('Nos cat&eacute;gories');

		$this->lay_out->add_css(array('libs/toastr/toastr'));
		$this->lay_out->add_js(array('libs/toastr/toastr','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/nanoscroller/jquery.nanoscroller.min'));
		$this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents','function/categorie'));

    $data['liste_categorie'] = $this->m_categorie->liste();

		$this->lay_out->view('room/categorie',$data);
	}

  public function new_categorie() {

    $this->form_validation->set_rules('libelle','Désignation','trim|required|alpha_dash|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('prix','Prix','trim|required|is_natural|encode_php_tags|xss_clean');

    if ($this->form_validation->run()) {
      $lib = $this->input->post('libelle');
      $prix = $this->input->post('prix');
      if ($this->m_categorie->authorize($lib))
        if ($this->m_categorie->new_categorie($lib))
          if ($this->m_categorie->new_price($this->m_categorie->last_id(),$prix))
            echo $this->m_action->new_action('Création de la catégorie chambre '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a crée la catégorie '.$lib);
          else echo 3;
        else echo 3;
      else echo 2;
    }
    else  echo 0;
  }

  public function info() {

    $data = $this->m_categorie->get_information($this->input->get('id'));
    if($data) echo json_encode($data);
    else echo json_encode(0);
  }

  public function update(){

    $old = $this->input->post('old-libelle');
    $lib = $this->input->post('up-libelle');
    if($this->m_categorie->update($this->input->post('up-id'),$this->input->post('up-libelle'))){
      echo $this->m_action->new_action('Mise à jour de la catégorie chambre '.$old.' en '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a changé la catégorie '.$old.' en '.$lib);
    }echo 3;
  }

  public function usdate(){

    $prix = $this->input->post('us-prix');
    $lib = $this->input->post('us-libelle');
    if($this->m_categorie->new_price($this->input->post('us-id'),$this->input->post('us-prix'))){
      echo $this->m_action->new_action('Changement du prix de la catégorie chambre '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a changé le prix de la catégorie '.$lib.' en '.$prix);
    }echo 3;
  }

  public function delete(){

    $lib = $this->input->post('del-libelle');
    if($this->m_categorie->delete($this->input->post('del-id'))){
      $this->m_action->new_action('Suppression de la catégorie chambre '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a supprimé la catégorie '.$lib);
      echo $this->m_corbeille->new_corbeille('fa fa-hotel',$id,'m_categorie','Catégorie '.$lib);
    }else echo 3;
  }


}
