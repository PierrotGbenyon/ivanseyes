<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Sauvegarde extends CI_Controller {

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
    $this->load->model('m_sauvegarde');
  }

  public function index() {

    $this->lay_out->set_pattern('app');
    $this->lay_out->set_menu($this->m_parametre->list_menu());
    $this->lay_out->set_title('Sauvegarde | Ivan\'sEyes');
    $this->lay_out->set_groove('Sauvegarde');

    $this->lay_out->add_css(array('libs/select2/select2','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/wizard/wizard','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/dataTables.colVis','libs/DataTables/extensions/dataTables.tableTools'));
		$this->lay_out->add_js(array('libs/select2/select2','libs/bootstrap-tagsinput/bootstrap-tagsinput','libs/inputmask/jquery.inputmask.bundle.min','libs/jquery-validation/dist/jquery.validate.min','libs/jquery-validation/dist/additional-methods.min','libs/bootstrap-datepicker/bootstrap-datepicker','/libs/moment/moment.min','libs/jquery-validation/src/localization/messages_fr','libs/wizard/jquery.bootstrap.wizard.min','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/ColVis/js/dataTables.colVis.min','libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min','libs/nanoscroller/jquery.nanoscroller.min'));
		$this->lay_out->add_end_js(array('core/demo/DemoUIMessages','core/demo/DemoFormComponents','core/demo/DemoTableDynamic','function/sauvegarde'));

    $data['list_backup'] = $this->m_sauvegarde->liste();

		$this->lay_out->view('backup',$data);
  }

  public function new_sauvegarde() {

    $dir_source = 'upload/img';
    $dir_dest = 'upload/backup/'.date('d-m-Y à H', local_to_gmt()).'h'.date('i', local_to_gmt());

    mkdir($dir_dest, 0755);
    $dir_iterator = new RecursiveDirectoryIterator($dir_source, RecursiveDirectoryIterator::SKIP_DOTS);
    $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);

    foreach($iterator as $element){
       if($element->isDir()) mkdir($dir_dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
       else copy($element, $dir_dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
    }

    echo $this->m_sauvegarde->new_sauvegarde($this->session->userdata('nom').' via le compte '.$this->session->userdata('pseudo').' a éffectué une sauvegarde physique et logique de Ivan\'Eyes (Base de données et fichiers plats)');
  }

}
