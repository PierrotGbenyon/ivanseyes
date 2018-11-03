<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class M_chambre extends CI_Model {

	public $table ='chambre';

	function __construct() {

		parent::__construct();
	}

  public function new_chambre($code,$categorie) {

    $this->db->set('code',$code)
	    ->set('id_categorie',$categorie)
      ->set('creator',$this->session->userdata('user_id'));

    return $this->db->insert($this->table);
  }

  public function update($id,$code) {

    $this->db->set('code',$code)
      ->set('updated',date('d/M/Y H:m:s',local_to_gmt()));

    return $this->db->where('id_chambre',$id)->update($this->table);
  }

  public function delete($id) {

    $this->db->set('deleted',date('d/M/Y H:m:s',local_to_gmt()));
    return $this->db->where('id_chambre',$id)->update($this->table);
  }

  public function restore($id) {

    $this->db->set('deleted',null);
    return $this->db->where('id_chambre',$id)->update($this->table);
  }

  public function well_delete($id) {

    if ($this->db->where('id_chambre',$id)->delete($this->table2))
      return $this->db->where('id_chambre',$id)->delete($this->table);
    else return false;
  }

  public function liste() {

    $q = 'SELECT categorie.id_categorie, libelle, categorie.deleted, chambre.deleted,id_chambre, code from categorie left join chambre on chambre.id_categorie = categorie.id_categorie where chambre.deleted is null and categorie.deleted is null order by categorie.id_categorie, code';
		$q = $this->db->query($q);

		if ($q->num_rows()>0)  return $q;
		else return false;
  }

  public function list_deleted() {
    $q = 'SELECT deleted, id_chambre, code from chambre where deleted is not null order by code';
		$q = $this->db->query($q);

		if ($q->num_rows()>0)return $q;
		else return false;
  }

  public function authorize($code) {
		$q = $this->db->select('deleted, id_chambre')
			->where('code',$code)
			->where('deleted is null')
			->get($this->table);

		if ($q->num_rows()>0) return false;
		else return true;
	}

  public function get($id) {
    $q = 'SELECT id_chambre, code, libelle from chambre left join categorie on categorie.id_categorie = chambre.id_categorie where id_chambre = ?';
		$q = $this->db->query($q,array($id));

    foreach ($q->result() as $value)  return $value;
    return false;
  }

  public function get_information($id) {

		$q = "SELECT c.creator, TO_CHAR(c.created,'dd TMMon YYYY à HH24:mi') as created, TO_CHAR(c.updated,'dd TMMon YYYY à HH24:mi') as updated, c.code, concat(z.nom,' ',z.prenom) as createur FROM chambre c left join users z on c.creator = z.id_user WHERE c.id_chambre = ?";
		$q = $this->db->query($q,array($id));

		if ($q->num_rows()>0)
			foreach ($q->result() as $value) {
				return $value;
			}
		else return false;
	}

	public function last_id() {

		$q = $this->db->select('deleted,id_chambre ')
        ->where('deleted is null')
        ->order_by('id_chambre','desc')->limit(1)
        ->get($this->table);

    foreach ($q->result() as $value)  return $value->id_chambre;
    return false;
	}
}
