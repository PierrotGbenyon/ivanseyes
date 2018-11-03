<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Mets extends CI_Controller {

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
    $this->load->model('m_stock');
  }

  public function index() {

		$this->lay_out->set_pattern('app');
		$this->lay_out->set_menu($this->m_parametre->list_menu());
		$this->lay_out->set_title('Mets | Ivan\'sEyes');
		$this->lay_out->set_groove('Nos mets');

    $this->lay_out->add_css(array('libs/select2/select2','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/wizard/wizard','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/dataTables.colVis','libs/DataTables/extensions/dataTables.tableTools'));
    $this->lay_out->add_js(array('libs/select2/select2','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/inputmask/jquery.inputmask.bundle.min','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','libs/bootstrap-datepicker/bootstrap-datepicker','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/wizard/jquery.bootstrap.wizard.min','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/ColVis/js/dataTables.colVis.min','libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min','libs/nanoscroller/jquery.nanoscroller.min'));
    $this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents','core/demo/DemoTableDynamic','function/resto/mets'));

    $data['liste_met'] = $this->m_stock->liste_dish();
    $data['liste_denree'] = $this->m_stock->liste_denree();
    $data['liste_categorie'] = $this->m_parametre->liste_categorie();

		$this->lay_out->view('resto/mets',$data);
	}

  public function valid_denree() {

    $this->form_validation->set_rules('lib','Denrée','trim|required|alpha_dash|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('unit','Unité','trim|alpha_dash|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('qte-u','Qté','trim|required|numeric|encode_php_tags|xss_clean');

    if ($this->form_validation->run()) echo 1; else  echo 0;
  }

  public function new_mets() {

    $this->form_validation->set_rules('libelle','Libellé','trim|required|alpha_dash|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('cat','Catégorie','trim|required|alpha_dash|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('prix','Prix','trim|required|is_natural|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('qte','Qté','trim|numeric|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('seuil','Seuil','trim|is_natural|encode_php_tags|xss_clean');

    $this->form_validation->set_rules('dlib','Libellé','trim|alpha_dash|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('dqte','Qté','trim|alpha_dash|encode_php_tags|xss_clean');

    if ($this->form_validation->run()) {

      $lib = $this->input->post('libelle');
      $cat = $this->input->post('cat');
      $qte = $this->input->post('qte');
      $prix = $this->input->post('prix');
      $seuil = $this->input->post('seuil');

      $dlib = $this->input->post('dlib');
      $dqte = $this->input->post('dqte');

      // $lib = 'Tchep 5p';
      // $cat = 'Plat';
      // $prix = 3500;
      // $qte=null; $seuil=null;
      //
      // $dlib = 'Igname-Manioc-';
      // $dqte = '.5-.2-';

      if ($this->m_stock->authorize($lib))
        if ($this->m_stock->new_mets($lib,$cat,0,$qte,$seuil))
          if ($this->m_stock->new_price($this->m_stock->last_id(),$prix)){
            $dlib = mb_split('-',$dlib);
            $dqte = mb_split('-',$dqte);
            $id = $this->m_stock->last_id();
            $i=0;
            while($dlib[$i]) {
              $this->m_stock->new_constitution($id,$this->m_stock->get_id($dlib[$i]),$dqte[$i]);
              $i++;
            }
            echo $this->m_action->new_action('Création de '.$cat.' '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a crée '.$cat.' '.$lib);
          }else echo 3;
        else echo 3;
      else echo 2;
    }
    else  echo 0;

  }

  public function temp() {
    echo $this->m_stock->get_id('Igname');
  }

  public function info() {

    $data = $this->m_stock->get_information($this->input->get('id'));
    if($data) echo json_encode($data);
    else echo json_encode(0);
  }

  public function update(){

    $old = $this->input->post('old-libelle');
    $lib = $this->input->post('up-libelle');
    if($this->m_stock->update($this->input->post('up-id'),$this->input->post('up-libelle')));
      echo $this->m_action->new_action('Mise à jour du mets '.$old.' en '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a changé le mets '.$old.' en '.$lib);
  }

  public function usdate(){

    $prix = $this->input->post('us-prix');
    $lib = $this->input->post('us-libelle');
    $clib = $this->input->post('us-clib');
    if($this->m_stock->new_price($this->input->post('us-id'),$this->input->post('us-prix')));
      echo $this->m_action->new_action('Changement du prix de la/ du '.$clib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a changé le prix de la /du'.$clib.' en '.$prix);
  }

  public function delete(){

    $lib = $this->input->post('del-libelle');
    $id = $this->input->post('del-id');
    if($this->m_stock->delete($id)){
      $this->m_action->new_action('Suppression du mets '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a supprimé la denrée '.$lib);
      echo $this->m_corbeille->new_corbeille('md md-restaurant-menu',$id,'m_stock',$lib);
    }else echo 3;
  }


}
