<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Corbeille extends CI_Controller {

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
  }

  public function index() {

		$this->lay_out->set_pattern('app');
		$this->lay_out->set_menu($this->m_parametre->list_menu());
		$this->lay_out->set_title('Corbeille | Ivan\'sEyes');
		$this->lay_out->set_groove('Corbeille');

		$this->lay_out->add_css(array('libs/toastr/toastr'));
		$this->lay_out->add_js(array('libs/toastr/toastr','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/nanoscroller/jquery.nanoscroller.min'));
		$this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents','function/corbeille'));

    $data['liste_corbeille'] = $this->m_corbeille->liste();

		$this->lay_out->view('basket',$data);
	}

  public function delete(){

    $lib = $this->input->post('del-desc');
    $model = $this->input->post('del-model');
    $this->load->model($model);
    if($this->$model->well_delete($this->input->post('del-idd'))) {
      $this->m_corbeille->delete($this->input->post('del-id'));
      echo $this->m_action->new_action('Suppression définitive de la/du '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a définitivement supprimé le/la '.$lib);
    }else echo 3;
  }

  public function restore(){

    $lib = $this->input->post('rt-desc');
    $model = $this->input->post('rt-model');
    $this->load->model($model);
    if($this->$model->restore($this->input->post('rt-idd'))) {
      $this->m_corbeille->delete($this->input->post('rt-id'));
      echo $this->m_action->new_action('Restauration de la/du '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a restauré le/la '.$lib);
    }else echo 3;

  }


}
