<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class M_categorie extends CI_Model {

	public $table ='categorie';
	public $table2 ='prix_chambre';

	function __construct() {

		parent::__construct();
	}

  public function new_categorie($lib) {

    $this->db->set('libelle',$lib)
      ->set('creator',$this->session->userdata('user_id'));

    return $this->db->insert($this->table);
  }

  public function update($id,$lib) {

    $this->db->set('libelle',$lib)
      ->set('updated',date('d/M/Y H:m:s',local_to_gmt()));

    return $this->db->where('id_categorie',$id)->update($this->table);
  }

  public function delete($id) {

    $this->db->set('deleted',date('d/M/Y H:m:s',local_to_gmt()));
    return $this->db->where('id_categorie',$id)->update($this->table);
  }

  public function restore($id) {

    $this->db->set('deleted',null);
    return $this->db->where('id_categorie',$id)->update($this->table);
  }

  public function well_delete($id) {

    if ($this->db->where('id_categorie',$id)->delete($this->table2))
      return $this->db->where('id_categorie',$id)->delete($this->table);
    else return false;
  }

  public function liste() {

    $q = 'SELECT deleted,categorie.id_categorie, libelle, prix from categorie left join prix_chambre on prix_chambre.id_categorie = categorie.id_categorie where deleted is null order by libelle';
		$q = $this->db->query($q);

		if ($q->num_rows()>0)  return $q;
		else return false;
  }

  public function list_deleted() {
    $q = 'SELECT deleted, libelle from categorie where deleted is not null order by libelle';
		$q = $this->db->query($q);

		if ($q->num_rows()>0)return $q;
		else return false;
  }

  public function authorize($lib) {
		$q = $this->db->select('deleted, id_categorie')
			->where('libelle',$lib)
			->where('deleted is null')
			->get($this->table);

		if ($q->num_rows()>0) return false;
		else return true;
	}

  public function get($id) {
    $q = 'SELECT id_categorie, libelle from categorie where id_categorie = ?  order by libelle';
		$q = $this->db->query($q,array($id));

    foreach ($q->result() as $value)  return $value;
    return false;
  }

  public function get_information($id) {

		$q = "SELECT c.creator, TO_CHAR(c.created,'dd TMMon YYYY à HH24:mi') as created, TO_CHAR(c.updated,'dd TMMon YYYY à HH24:mi') as updated, c.libelle, concat(z.nom,' ',z.prenom) as createur FROM categorie c left join users z on c.creator = z.id_user WHERE c.id_categorie = ?";
		$q = $this->db->query($q,array($id));

		if ($q->num_rows()>0)
			foreach ($q->result() as $value) {
				return $value;
			}
		else return false;
	}

	public function last_id() {

		$q = $this->db->select('deleted,id_categorie ')
        ->where('deleted is null')
        ->order_by('id_categorie','desc')->limit(1)
        ->get($this->table);

    foreach ($q->result() as $value)  return $value->id_categorie;
    return false;
	}

	public function new_price($id,$prix) {

		$this->reset($id);
		$this->db->set('id_categorie',$id)
			->set('prix',$prix)
			->set('date_prix',date('d/M/Y',local_to_gmt()))
			->set('actif',1)
			->set('creator',$this->session->userdata('user_id'));
		return $this->db->insert($this->table2);
	}

	public function reset($category) {

		$this->db->set('actif',0);
		return $this->db->where('id_categorie',$category)->update($this->table2);
	}

	public function authorize_price($id,$prix) {

		$q = $this->db->select('id_prix_chambre')
			->where('id_categorie',$id)
			->where('prix',$prix)
			->where('actif',1)
			->get($this->table2);

		if ($q->num_rows()>0) return false;
		else return true;
	}

}
