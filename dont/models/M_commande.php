<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class M_commande extends CI_Model {

	public $table ='commande';

	function __construct() {

		parent::__construct();
	}

  public function new_commande($lib,$qte,$seuil,$unit,$cat,$piscine) {

    $this->db->set('libelle',$lib)
      ->set('qte',$qte)
      ->set('seuil',$seuil)
      ->set('unite',$unit)
      ->set('categorie',$cat)
      ->set('piscine',$piscine)
      ->set('creator',$this->session->userdata('user_id'));

    return $this->db->insert($this->table);
  }

	public function new_mets($lib,$cat,$piscine,$qte='',$seuil='') {

    $this->db->set('libelle',$lib)
      ->set('categorie',$cat)
      ->set('piscine',$piscine)
      ->set('creator',$this->session->userdata('user_id'));

			if($qte) $this->db->set('qte',$qte);
			if($seuil) $this->db->set('seuil',$seuil);

    return $this->db->insert($this->table);
  }

  public function update($id,$lib) {

    $this->db->set('libelle',$lib)
      ->set('updated',date('d/M/Y H:m:s',local_to_gmt()));

    return $this->db->where('id_commande',$id)->update($this->table);
  }

  public function delete($id) {

    $this->db->set('deleted',date('d/M/Y H:m:s',local_to_gmt()));
    return $this->db->where('id_commande',$id)->update($this->table);
  }

  public function restore($id) {

    $this->db->set('deleted',null);
    return $this->db->where('id_commande',$id)->update($this->table);
  }

  public function well_delete($id) {

    if ($this->db->where('id_commande',$id)->delete($this->table2))
      return $this->db->where('id_commande',$id)->delete($this->table);
    else return false;
  }

  public function liste_commande() {

    $q = "SELECT deleted,commande.id_commande, libelle,qte,unite,seuil,categorie from commande left join prix_commande on prix_commande.id_commande = commande.id_commande where categorie = 'denrée' and deleted is null order by libelle";
		$q = $this->db->query($q);

		if ($q->num_rows()>0)  return $q;
		else return false;
  }

	public function liste_dish() {

    $q = "SELECT deleted,commande.id_commande, libelle,qte,unite,seuil,categorie, prix from commande left join prix_commande on prix_commande.id_commande = commande.id_commande where categorie != 'denrée' and deleted is null order by libelle";
		$q = $this->db->query($q);

		if ($q->num_rows()>0)  return $q;
		else return false;
  }

  public function authorize($lib) {
		$q = $this->db->select('deleted, id_commande')
			->where('libelle',$lib)
			->where('deleted is null')
			->get($this->table);

		if ($q->num_rows()>0) return false;
		else return true;
	}

  public function get($id) {
    $q = 'SELECT id_commande, libelle,qte,unite,seuil,categorie from commande where id_commande = ?  order by libelle';
		$q = $this->db->query($q,array($id));

    foreach ($q->result() as $value)  return $value;
    return false;
  }

  public function get_information($id) {

		$q = "SELECT c.creator, categorie, TO_CHAR(c.created,'dd TMMon YYYY à HH24:mi') as created, TO_CHAR(c.updated,'dd TMMon YYYY à HH24:mi') as updated, c.libelle, concat(z.nom,' ',z.prenom) as createur FROM commande c left join users z on c.creator = z.id_user WHERE c.id_commande = ?";
		$q = $this->db->query($q,array($id));

		if ($q->num_rows()>0)
			foreach ($q->result() as $value) {
				return $value;
			}
		else return false;
	}

	public function get_id($lib) {

		$q = $this->db->select('deleted,id_commande ')
        ->where('libelle',$lib)
        ->get($this->table);

    foreach ($q->result() as $value)  return $value->id_commande;
    return false;
	}

	public function last_id() {

		$q = $this->db->select('deleted,id_commande ')
        ->where('deleted is null')
        ->order_by('id_commande','desc')->limit(1)
        ->get($this->table);

    foreach ($q->result() as $value)  return $value->id_commande;
    return false;
	}

}
