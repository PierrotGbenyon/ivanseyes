<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class M_mets extends CI_Model {

	public $table ='denree';
	public $table2 ='prix_denree';
	public $table3 ='constitution_denree';

	function __construct() {

		parent::__construct();
	}

  public function new_denree($lib,$qte,$seuil,$unit,$cat,$piscine) {

    $this->db->set('libelle',$lib)
      ->set('qte',$qte)
      ->set('seuil',$seuil)
      ->set('unite',$unit)
      ->set('categorie',$cat)
      ->set('piscine',$piscine)
      ->set('creator',$this->session->userdata('user_id'));

    return $this->db->insert($this->table);
  }

  public function update($id,$lib) {

    $this->db->set('libelle',$lib)
      ->set('updated',date('d/M/Y H:m:s',local_to_gmt()));

    return $this->db->where('id_denree',$id)->update($this->table);
  }

  // public function update($id,$lib,$qte,$seuil,$unit,$cat) {
  //
  //   $this->db->set('libelle',$lib)
  //     ->set('qte',$qte)
  //     ->set('seuil',$seuil)
  //     ->set('unite',$unit)
  //     ->set('categorie',$cat)
  //     ->set('updated',date('d/M/Y H:m:s',local_to_gmt()));
  //
  //   return $this->db->where('id_denree',$id)->update($this->table);
  // }

  public function delete($id) {

    $this->db->set('deleted',date('d/M/Y H:m:s',local_to_gmt()));
    return $this->db->where('id_denree',$id)->update($this->table);
  }

  public function restore($id) {

    $this->db->set('deleted',null);
    return $this->db->where('id_denree',$id)->update($this->table);
  }

  public function well_delete($id) {

    if ($this->db->where('id_denree',$id)->delete($this->table2))
      return $this->db->where('id_denree',$id)->delete($this->table);
    else return false;
  }

  public function liste() {

    $q = 'SELECT deleted,denree.id_denree, libelle,qte,unite,seuil,categorie, prix from denree left join prix_denree on prix_denree.id_denree = denree.id_denree where deleted is null order by libelle';
		$q = $this->db->query($q);

		if ($q->num_rows()>0)  return $q;
		else return false;
  }

  public function list_deleted() {
    $q = 'SELECT deleted, libelle,qte,unite,seuil,categorie from denree where deleted is not null order by libelle';
		$q = $this->db->query($q);

		if ($q->num_rows()>0)return $q;
		else return false;
  }

  public function authorize($lib) {
		$q = $this->db->select('deleted, id_denree')
			->where('libelle',$lib)
			->where('deleted is null')
			->get($this->table);

		if ($q->num_rows()>0) return false;
		else return true;
	}

  public function get($id) {
    $q = 'SELECT id_denree, libelle,qte,unite,seuil,categorie from denree where id_denree = ?  order by libelle';
		$q = $this->db->query($q,array($id));

    foreach ($q->result() as $value)  return $value;
    return false;
  }

  public function get_information($id) {

		$q = "SELECT c.creator, TO_CHAR(c.created,'dd TMMon YYYY à HH24:mi') as created, TO_CHAR(c.updated,'dd TMMon YYYY à HH24:mi') as updated, c.libelle, concat(z.nom,' ',z.prenom) as createur FROM denree c left join users z on c.creator = z.id_user WHERE c.id_denree = ?";
		$q = $this->db->query($q,array($id));

		if ($q->num_rows()>0)
			foreach ($q->result() as $value) {
				return $value;
			}
		else return false;
	}

	public function last_id() {

		$q = $this->db->select('deleted,id_denree ')
        ->where('deleted is null')
        ->order_by('id_denree','desc')->limit(1)
        ->get($this->table);

    foreach ($q->result() as $value)  return $value->id_denree;
    return false;
	}

	public function new_price($id,$prix) {

		$this->reset($id);
		$this->db->set('id_denree',$id)
			->set('prix',$prix)
			->set('date_prix',date('d/M/Y',local_to_gmt()))
			->set('actif',1)
			->set('creator',$this->session->userdata('user_id'));
		return $this->db->insert($this->table2);
	}

	public function reset($category) {

		$this->db->set('actif',0);
		return $this->db->where('id_denree',$category)->update($this->table2);
	}

	public function authorize_price($id,$prix) {

		$q = $this->db->select('id_prix_denree')
			->where('id_denree',$id)
			->where('prix',$prix)
			->where('actif',1)
			->get($this->table2);

		if ($q->num_rows()>0) return false;
		else return true;
	}

}
