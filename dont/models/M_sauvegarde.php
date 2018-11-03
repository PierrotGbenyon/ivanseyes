<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_sauvegarde extends CI_Model {

	public $table = 'sauvegarde';

	function __construct() {

		parent::__construct();
	}

	public function new_sauvegarde($desc) {

		$this->db->set('creator',$this->session->userdata('user_id'))
			->set('description',$desc);

		return $this->db->insert($this->table);
	}

	public function liste() {

		$q = "SELECT id_sauvegarde,description,TO_CHAR(created,'dd TMMon YYYY') as date_s, TO_CHAR(created ,'le dd TMMon YYYY à HH24:mi') as created FROM sauvegarde  ORDER BY sauvegarde.id_sauvegarde  DESC ";
		$q = $this->db->query($q);

		if ($q->num_rows()>0) return $q;
		else return false;
	}

}
