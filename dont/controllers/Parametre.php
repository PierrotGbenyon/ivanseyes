<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Parametre extends CI_Controller {

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
  }

  public function index() {

		$this->lay_out->set_pattern('app');
		$this->lay_out->set_menu($this->m_parametre->list_menu());
		$this->lay_out->set_title('Paramètre | Ivan\'sEyes');
		$this->lay_out->set_groove('Param&egrave;tre');

		$this->lay_out->add_css(array('libs/select2/select2','libs/bootstrap-tagsinput/bootstrap-tagsinput'));
		$this->lay_out->add_js(array('libs/select2/select2','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','libs/bootstrap-datepicker/bootstrap-datepicker','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/nanoscroller/jquery.nanoscroller.min'));
		$this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents','function/configuration'));

    $data['liste_nationalite'] = $this->m_parametre->liste_nationalite();
    $data['liste_pays'] = $this->m_parametre->liste_pays();
    $data['liste_categorie'] = $this->m_parametre->liste_categorie();
    $data['liste_unite'] = $this->m_parametre->liste_unite();
    $data['corbeille'] = $this->m_parametre->corbeille_value();
    $data['sauvegare'] = $this->m_parametre->save_value();

		$this->lay_out->view('configuration',$data);
	}

  public function new_element(){

    $out;
    $contain = $this->input->post('value');
    $type = $this->input->post('typ');
    if ($this->m_parametre->nvo_type($type,$contain))
      if ($type == 'pays') $out = $this->m_action->new_action('Ajout du pays '.$contain,$this->session->userdata('pseudo').' a ajouté le pays '.$contain);
      else $out = $this->m_action->new_action('Ajout de la '.$type.' '.$contain,$this->session->userdata('pseudo').' a ajouté la '.$type.' '.$contain);
    else $out = 0;

    $data0= array('out'=>$out);
    echo json_encode($data0);
  }

  public function delete_element(){

    $out;
    $contain = $this->input->post('value');
    $type = $this->input->post('typ');
    if ($this->m_parametre->delete_type($type,$contain))
      if ($type == 'pays') $out = $this->m_action->new_action('Suppression du pays '.$contain,$this->session->userdata('pseudo').' a supprimé le pays '.$contain);
      else $out = $this->m_action->new_action('Suppression de la '.$type.' '.$contain,$this->session->userdata('pseudo').' a supprimé la '.$type.' '.$contain);
    else $out = 0;

    $data0= array('out'=>$out);
    echo json_encode($data0);
  }

  public function sauvegarde(){

    $out;
    if ($this->m_parametre->nvo_save_value($this->input->post('value')))
      $out = $this->m_action->new_action('Changement de la fréquence de la sauvegare',$this->session->userdata('pseudo').' a changé la fréquence des sauvegares ');
    else $out = 0;

    $data0= array('out'=>$out);
    echo json_encode($data0);
  }

  // public function corbeille(){
  //
  //   $out;
  //   if ($this->m_parametre->nvo_save_value($this->input->post('value')))
  //     $out = $this->m_action->new_action('Changement de la fréquence de la sauvegare',$this->session->userdata('pseudo').' a changé la fréquence des sauvegares ');
  //   else $out = 0;
  //
  //   $data0= array('out'=>$out);
  //   echo json_encode($data0);
  // }


}
