<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Caisse extends CI_Controller {

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
    $this->load->model('m_caisse');
  }

  public function index() {

    $this->lay_out->set_pattern('app');
    $this->lay_out->set_menu($this->m_parametre->list_menu());
    $this->lay_out->set_title('Caisse | Ivan\'sEyes');
    $this->lay_out->set_groove('Solde');

    $this->lay_out->add_css(array('libs/select2/select2','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/wizard/wizard','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/dataTables.colVis','libs/DataTables/extensions/dataTables.tableTools'));
		$this->lay_out->add_js(array('libs/select2/select2','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/inputmask/jquery.inputmask.bundle.min','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','libs/bootstrap-datepicker/bootstrap-datepicker','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/wizard/jquery.bootstrap.wizard.min','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/ColVis/js/dataTables.colVis.min','libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min','libs/nanoscroller/jquery.nanoscroller.min'));
		$this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents','core/demo/DemoTableDynamic','function/solde'));

    $data['old'] = $this->m_caisse->last_id();
    $data['liste_caisse'] = $this->m_caisse->liste();
    if($data['old']) $data['old_solde'] = $this->m_caisse->solde($this->m_caisse->last_id());
    else $data['old_solde'] =false;

    $this->lay_out->view('bank/box',$data);
  }

  public function open() {

    $this->form_validation->set_rules('mt','Montant','trim|required|is_natural|encode_php_tags|xss_clean');

    if ($this->form_validation->run()) {
      $mt = $this->input->post('mt');
      if ($this->m_caisse->new_caisse($mt,0)) echo $this->m_action->new_action('Ouverture de la caisse du '.date('d M Y',local_to_gmt()),$this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a ouvert la caisse du '.date('d M Y',local_to_gmt()));
      else echo 3;
    }
    else echo 0;
  }

  //
  // public function operation() {
  //
	// 	$this->lay_out->set_pattern('app');
	// 	$this->lay_out->set_menu($this->m_parametre->list_menu());
	// 	$this->lay_out->set_title('Caisse | IVANS-PLAZA');
	// 	$this->lay_out->set_groove('Op&eacute;ration');
  //
	// 	$this->lay_out->add_css(array('libs/toastr/toastr','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/select2/select2','libs/wizard/wizard','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/dataTables.colVis','libs/DataTables/extensions/dataTables.tableTools'));
	// 	$this->lay_out->add_js(array('libs/toastr/toastr','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/inputmask/jquery.inputmask.bundle.min','libs/select2/select2','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','libs/bootstrap-datepicker/bootstrap-datepicker','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/wizard/jquery.bootstrap.wizard.min','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/ColVis/js/dataTables.colVis.min','libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min','libs/nanoscroller/jquery.nanoscroller.min'));
	// 	$this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents','core/demo/DemoTableDynamic','function/bank'));
  //
  //   $data['date_chest'] = $this->m_caisse->get_chest_date();
  //   $data['list_process'] = $this->m_caisse->list_process();
  //   $data['list_produit'] = $this->m_caisse->list_produit();
  //   $data['list_compte'] = $this->m_caisse->list_compte();
  //
	// 	$this->lay_out->view('process',$data);
	// }
  //
  // public function new_process() {
  //
  //   $this->form_validation->set_rules('compte','Partenaire','trim|required|is_natural|encode_php_tags|xss_clean');
  //   $this->form_validation->set_rules('date_c','Date opération','trim|required|encode_php_tags|xss_clean');
  //   $this->form_validation->set_rules('money','Montant total','trim|required|numeric|encode_php_tags|xss_clean');
  //   $this->form_validation->set_rules('prod','Produit','trim|required|alpha_dash|encode_php_tags|xss_clean');
  //   $this->form_validation->set_rules('qte','Qté','trim|required|alpha_dash|encode_php_tags|xss_clean');
  //   $this->form_validation->set_rules('ps','PS','trim|required|alpha_dash|encode_php_tags|xss_clean');
  //
  //   if ($this->form_validation->run()) {
  //
  //     $compte = $this->input->post('compte');
  //     $date_c = $this->input->post('date_c');
  //     $money = $this->input->post('money');
  //     $prod = $this->input->post('prod');
  //     $qte = $this->input->post('qte');
  //     $ps = $this->input->post('ps');
  //
  //     // $compte = 2;
  //     // $date_c = '09/06/2014';
  //     // $money = 194000;
  //     // $prod = 'SP1-SP02-';
  //     // $qte = '8-1000-';
  //     // $ps = '11.2-12-';
  //
  //     $this->m_parametre->start_transaction();
  //     if ($this->m_caisse->new_process(make_date($date_c),$compte,$money,'Autoship')) {
  //       $this->m_action->new_action('Caisse','Vente de produits',$this->session->userdata('user_name').' via le compte '.$this->session->userdata('user_pseudo').' a vendu des produits d\'un montant de '.$money);
  //       $op = $this->m_caisse->last_process();
  //       $prod = mb_split('-',$prod);
  //       $qte = mb_split('-',$qte);
  //       $ps = mb_split('-',$ps);
  //       $psv = 0;
  //
  //       $i=0;
  //       while($prod[$i]) {
  //         $this->m_caisse->new_process_product($op,$prod[$i],$qte[$i]);
  //         $this->m_caisse->increase_autosheep($compte,$ps[$i]);
  //         $psv += $ps[$i];
  //         $i++;
  //       }
  //       $this->m_caisse->increase_ps($compte,$psv);
  //
  //       $data = $this->m_titre->define_titre($compte);
  //       if($data != false) foreach ($data->result() as $value) {
  //         $this->m_titre->new_compte_titre($value->id_titre,$compte,make_date($date_c));
  //       }
  //       echo 1;
  //       $this->m_parametre->commit();
  //     }else echo 3;
  //
  //   }
  //   else echo 0;
	// }
  //
  // public function check_product() {
  //
  //   $this->form_validation->set_rules('sel-prod','Produit','trim|required|alpha_dash|encode_php_tags|xss_clean');
  //   $this->form_validation->set_rules('sel-qte','Quantité','trim|required|is_natural|encode_php_tags|xss_clean');
  //   $this->form_validation->set_rules('sel-money','Montant','trim|required|is_natural|encode_php_tags|xss_clean');
  //
  //   if ($this->form_validation->run()) echo 1;
  //   else echo 0;
	// }
  //
  // public function get_price() {
  //   echo json_encode($this->m_caisse->get_prix_titre_produit($this->input->get('prod'),$this->input->get('compte')));
  // }
  //
  // public function info_process() {
  //
  //   $data = $this->m_caisse->info_process($this->input->get('id'));
  //   if($data) echo json_encode($data);
  //   else echo json_encode(0);
  // }

  public function info() {

    $data = $this->m_caisse->get_information(1);
    if($data) echo json_encode($data);
    else echo json_encode(0);
  }

  public function selection() {

    $this->lay_out->set_pattern('app');
		$this->lay_out->set_menu($this->m_parametre->list_menu());
		$this->lay_out->set_title('Caisse | IVANS-PLAZA');
		$this->lay_out->set_groove('Caisse journali&egrave;re');

		$this->lay_out->add_css(array('libs/toastr/toastr','libs/select2/select2','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/dataTables.colVis','libs/DataTables/extensions/dataTables.tableTools'));
		$this->lay_out->add_js(array('libs/toastr/toastr','libs/select2/select2','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','libs/bootstrap-datepicker/bootstrap-datepicker','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/wizard/jquery.bootstrap.wizard.min','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/ColVis/js/dataTables.colVis.min','libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min','libs/nanoscroller/jquery.nanoscroller.min'));
		$this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents','core/demo/DemoTableDynamic','function/bank'));

    $id = $this->input->post('id_chest');
    $data['chest'] = $this->m_caisse->get_chest($id);
    $data['list_process'] = $this->m_caisse->list_selected_process($id);

		$this->lay_out->view('process_sel',$data);
  }

}
