<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Profil extends CI_Controller {

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
    $this->load->model('m_profil');
  }

  public function index() {

		$this->lay_out->set_pattern('app');
		$this->lay_out->set_menu($this->m_parametre->list_menu());
		$this->lay_out->set_title('Profil | Ivan\'sEyes');
		$this->lay_out->set_groove('Profil');

		$this->lay_out->add_css(array('libs/toastr/toastr','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/wizard/wizard','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/dataTables.colVis','libs/DataTables/extensions/dataTables.tableTools'));
		$this->lay_out->add_js(array('libs/toastr/toastr','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/nanoscroller/jquery.nanoscroller.min'));
		$this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents','function/profile'));

    $data['list_profile'] = $this->m_profil->liste();
    $data['accueil'] = $this->m_profil->liste_menu('Accueil');
    $data['menu_principal'] = $this->m_profil->liste_menu('Menu principal');
    $data['piscine'] = $this->m_profil->liste_menu('Piscine');
    $data['administration'] = $this->m_profil->liste_menu('Administration');

		$this->lay_out->view('profile/profile',$data);
	}

  public function new_profile() {

    $this->form_validation->set_rules('name','Dénomination','trim|required|alpha_dash|encode_php_tags|xss_clean');
    $this->form_validation->set_rules('description','Description','trim|alpha_dash|encode_php_tags|xss_clean');

    if ($this->form_validation->run()) {

      $name = $this->input->post('name');
      $description = $this->input->post('description');
      if ($this->m_profil->authorize($name))
        if ($this->m_profil->new_profil($name,$description))
          echo $this->m_action->new_action('Création du profil '.$name,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a crée le profil '.$name);
        else echo 3;
      else echo 2;
    }
    else  echo 0;
  }

  public function set_right() {

    // $temp = "10@C-11@C-36@C-36@A-37@C-37@A-";
    // $all = mb_split('-',$temp);
    $all = mb_split('-',$this->input->post('right'));
		$menu = 0;
    $cumul = '';
    $id = $this->m_profil->last_id();

		for ($i=0; $all[$i]!= ''; $i++) {
		 	if ($menu != mb_split('@', $all[$i])[0]) {
				if ($menu != 0) {
					$this->m_profil->new_right($id,$menu,$cumul);
          // echo $id.' '.$menu.' '.$cumul.'*            ;';
					$cumul = '';
				}
				$menu = mb_split('@', $all[$i])[0];
				$cumul .= mb_split('@', $all[$i])[1];
			} else $cumul .= mb_split('@', $all[$i])[1];
		}
    // echo $id.' '.$menu.' '.$cumul.'*            ;';
		echo $this->m_profil->new_right($id,$menu,$cumul);
  }

  public function info() {

    $data = $this->m_profil->get_information($this->input->get('id'));
    if($data) echo json_encode($data);
    else echo json_encode(0);
  }

  public function consult() {

    $this->lay_out->set_pattern('app');
    $this->lay_out->set_menu($this->m_parametre->list_menu());
    $this->lay_out->set_title('Profil | Ivan\'s Eyes');
    $this->lay_out->set_groove('Profil');

    $this->lay_out->add_css(array('libs/toastr/toastr','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/wizard/wizard','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/dataTables.colVis','libs/DataTables/extensions/dataTables.tableTools'));
    $this->lay_out->add_js(array('libs/toastr/toastr','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/nanoscroller/jquery.nanoscroller.min'));
    $this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents','function/profile'));

    $id = $this->input->post('dt-id');
    $data['name'] = $this->input->post('dt-name');

    $data['accueil'] = $this->m_profil->droit($id,'Accueil');
    $data['menu_principal'] = $this->m_profil->droit($id,'Menu principal');
    $data['piscine'] = $this->m_profil->droit($id,'Piscine');
    $data['administration'] = $this->m_profil->droit($id,'Administration');

    $this->lay_out->view('profile/detail',$data);
  }

  // public function update(){
  //
  //   $old = $this->input->post('old-libelle');
  //   $lib = $this->input->post('up-libelle');
  //   if($this->m_profil->update($this->input->post('up-id'),$this->input->post('up-libelle')));
  //     echo $this->m_action->new_action('Mise à jour de la catégorie chambre '.$old.' en '.$lib,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a changé la catégorie '.$old.' en '.$lib);
  // }

  public function delete(){

    $name = $this->input->post('del-name');
    if($this->m_profil->delete($this->input->post('del-id'))){
      $this->m_action->new_action('Suppression du profil '.$name,$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a supprimé le profil '.$name);
      echo $this->m_corbeille->new_corbeille('fa fa-user',$this->input->post('del-id'),'m_profil','Profil '.$name);
    }else echo 3;
  }


}
