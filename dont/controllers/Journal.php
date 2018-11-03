<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class Journal extends CI_Controller
{

  function __construct() {

    parent::__construct();
    if (!$this->m_parametre->is_logged_in()) redirect('connexion/disconnect');
    $this->load->model('M_action');
  }

  public function index() {

    $this->lay_out->set_pattern('app');
		$this->lay_out->set_menu($this->m_parametre->list_menu());
		$this->lay_out->set_title('Historique des actions | Ivan\'sEyes');
		$this->lay_out->set_groove('Historique des actions');

		$this->lay_out->add_css(array('libs/DataTables/jquery.dataTables','libs/DataTables/extensions/dataTables.colVis','libs/DataTables/extensions/dataTables.tableTools'));
		$this->lay_out->add_js(array('/libs/moment/moment.min','libs/DataTables/jquery.dataTables','libs/DataTables/extensions/ColVis/js/dataTables.colVis.min','libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min','libs/nanoscroller/jquery.nanoscroller.min'));
		$this->lay_out->add_end_js(array('core/demo/DemoTableDynamic'));

    $data['list_action'] = $this->m_action->liste();

		$this->lay_out->view('action',$data);
	}

}
