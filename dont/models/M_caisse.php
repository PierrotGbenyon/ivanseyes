<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class M_caisse extends CI_Model {

	public $table ='caisse';

	function __construct() {

		parent::__construct();
	}

  public function new_caisse($montant,$piscine) {

    $this->db->set('montant_ov',$montant)
      ->set('montant_fr',$montant)
      ->set('piscine',$piscine)
      ->set('date_caisse',date('d/M/Y',local_to_gmt()))
      ->set('id_user',$this->session->userdata('user_id'));

    return $this->db->insert($this->table);
  }

  public function solde($id) {

		$q = $this->db->select('montant_fr')->where('id_caisse',$id)
					->get($this->table);

		foreach ($q->result() as $value)
			return $value->montant_fr;
	}

  public function entry($id,$mt) {

    $old = $this->solde($id);
    $old += $mt;
    $this->db->set('montant_fr',$old);
		return $this->db->where('id_caisse',$id)->update($this->table);
  }

  public function liste() {

    $q = "SELECT caisse.id_caisse, montant_ov, montant_fr, date_caisse as date_c, TO_CHAR(date_caisse,'TMDay dd TMMon YYYY') as date_caisse from caisse order by id_caisse desc";
		$q = $this->db->query($q);

		if ($q->num_rows()>0)  return $q;
		else return false;
  }

  public function get($id) {
    $q = 'SELECT id_caisse, libelle from caisse where id_caisse = ?  order by libelle';
		$q = $this->db->query($q,array($id));

    foreach ($q->result() as $value)  return $value;
    return false;
  }

  public function get_information($id) {

		$q = "SELECT c.id_user, TO_CHAR(c.created,'dd TMMon YYYY à HH24:mi') as created, TO_CHAR(date_caisse,'dd TMMon YYYY') as date_caisse, concat(z.nom,' ',z.prenom) as createur FROM caisse c left join users z on c.id_user = z.id_user WHERE c.id_user = ?";
		$q = $this->db->query($q,array($id));

		if ($q->num_rows()>0)
			foreach ($q->result() as $value) {
				return $value;
			}
		else return false;
	}

	public function last_id() {

		$q = $this->db->select('id_caisse ')
        ->order_by('id_caisse','desc')->limit(1)
        ->get($this->table);

    foreach ($q->result() as $value)  return $value->id_caisse;
    return false;
	}

}
