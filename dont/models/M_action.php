<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_action extends CI_Model {

	public $table = 'action';

	function __construct() {

		parent::__construct();
	}

	public function new_action($lib,$desc) {

		$this->db->set('id_user',$this->session->userdata('user_id'))
			->set('intitule',$lib)
			->set('description',$desc);

		return $this->db->insert($this->table);
	}

	public function liste() {

		$q = "SELECT id_action,description,intitule,TO_CHAR(created,'dd TMMon YYYY') as created, TO_CHAR(created ,'HH24:mi') as heure FROM action  ORDER BY action.id_action  DESC ";
		$q = $this->db->query($q);

		if ($q->num_rows()>0) return $q;
		else return false;
	}

	public function last_id() {

		$q = $this->db->select('id_action ')
					->order_by('id_action','desc')->limit(1)
					->get($this->table);
		foreach ($q->result() as $value) {
			return $value->id_action ;
		}
	}

	// current_user
	public function get_number($user) {
		$q = "SELECT Count(*) as nb FROM action left join users on users.id_user = action.id_user where users.id_user =?";
		$q = $this->db->query($q,array($user));

		if ($q->num_rows()>0)
			foreach ($q->result() as $value) return $value->nb;
		else return false;
	}

	public function get_limited_action($user,$nb) {

		$q = "SELECT id_action,description,intitule,TO_CHAR(action.created,'dd TMMon YYYY') as created, TO_CHAR(action.created ,'HH24:mi') as heure FROM action left join users on users.id_user = action.id_user where users.id_user=? ORDER BY action.id_action  DESC  limit ?";
		$q = $this->db->query($q,array($user,$nb));

		if ($q->num_rows()>0) return $q;
		else return false;
	}

}
