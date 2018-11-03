<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Stock extends CI_Controller {

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
    $this->load->model('m_stock');
  }

  public function index() {

		$this->lay_out->set_pattern('app');
		$this->lay_out->set_menu($this->m_parametre->list_menu());
		$this->lay_out->set_title('Stock | Ivan\'sEyes');
		$this->lay_out->set_groove('Stock');

    $this->lay_out->add_css(array('libs/select2/select2','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/wizard/wizard','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/dataTables.colVis','libs/DataTables/extensions/dataTables.tableTools'));
    $this->lay_out->add_js(array('libs/select2/select2','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/inputmask/jquery.inputmask.bundle.min','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','libs/bootstrap-datepicker/bootstrap-datepicker','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/wizard/jquery.bootstrap.wizard.min','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/ColVis/js/dataTables.colVis.min','libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min','libs/nanoscroller/jquery.nanoscroller.min'));
    $this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents','core/demo/DemoTableDynamic','function/resto/denree'));

    $data['liste_denree'] = $this->m_stock->liste_denree();
    $data['liste_unite'] = $this->m_parametre->liste_unite();

		$this->lay_out->view('resto/denree',$data);
	}

  public function new_denree() {

    $this->form_validation->set_rules('lib','Libellé','trim|required|alpha_dash|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('unite','Unité','trim|required|alpha_dash|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('qte','Qté','trim|required|is_natural|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('seuil','Seuil','trim|required|is_natural|encode_php_tags|xss_clean');

    if ($this->form_validation->run()) {

      $lib = $this->input->post('lib');
      $qte = $this->input->post('qte');
      $unit = $this->input->post('unite');
      $seuil = $this->input->post('seuil');

      if ($this->m_stock->authorize($lib))
        if ($this->m_stock->new_denree($lib,$qte,$seuil,$unit,'denrée',0))
            echo $this->m_action->new_action('Création de la denrée '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a crée la denrée '.$lib);
        else echo 3;
      else echo 2;
    }
    else  echo 0;
  }

  // public function new_denree() {
  //
  //   $this->form_validation->set_rules('libelle','Désignation','trim|required|alpha_dash|encode_php_tags|xss_clean');
  //   $this->form_validation->set_rules('prix','Prix','trim|required|is_natural|encode_php_tags|xss_clean');
  //
  //   if ($this->form_validation->run()) {
  //     $lib = $this->input->post('libelle');
  //     $prix = $this->input->post('prix');
  //     if ($this->m_stock->authorize($lib))
  //       if ($this->m_stock->new_denree($lib))
  //         if ($this->m_stock->new_price($this->m_stock->last_id(),$prix))
  //           echo $this->m_action->new_action('Création de la catégorie chambre '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a crée la catégorie '.$lib);
  //         else echo 3;
  //       else echo 3;
  //     else echo 2;
  //   }
  //   else  echo 0;
  // }

  public function info() {

    $data = $this->m_stock->get_information($this->input->get('id'));
    if($data) echo json_encode($data);
    else echo json_encode(0);
  }

  public function update(){

    $old = $this->input->post('old-libelle');
    $lib = $this->input->post('up-libelle');
    if($this->m_stock->update($this->input->post('up-id'),$this->input->post('up-libelle')));
      echo $this->m_action->new_action('Mise à jour du denrée '.$old.' en '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a changé la denrée '.$old.' en '.$lib);
  }

  // public function usdate(){
  //
  //   $prix = $this->input->post('us-prix');
  //   $lib = $this->input->post('us-libelle');
  //   if($this->m_stock->new_price($this->input->post('us-id'),$this->input->post('us-prix')));
  //     echo $this->m_action->new_action('Changement du prix de la catégorie chambre '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a changé le prix de la catégorie '.$lib.' en '.$prix);
  // }

  public function delete(){

    $lib = $this->input->post('del-libelle');
    $id = $this->input->post('del-id');
    if($this->m_stock->delete($id)){
      $this->m_action->new_action('Suppression du denrée '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a supprimé la denrée '.$lib);
      echo $this->m_corbeille->new_corbeille('md md-restaurant-menu',$id,'m_stock','Denrée '.$lib);
    }else echo 3;
  }


}
