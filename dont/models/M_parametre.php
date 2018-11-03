<?php defined('BASEPATH') OR exit('No direct scirpt access allowed');
/**
 *
 */
class M_parametre extends CI_Model {

  function __construct() {

    parent::__construct();
  }

  public function list_menu() {

		$q = 'SELECT m.id_menu, m.men_id_menu,m.sur_id_menu, m.nom_menu, m.url_menu, m.icone,m.droit_dispo ,(select count(*) from menu sm where men_id_menu = m.id_menu) nb_sous_menu from menu m order by id_menu asc, men_id_menu asc, nom_menu asc';
		$q = $this->db->query($q);

		if ($q->num_rows()>0) return $q;
		else return false;
	}

  public function droit_menu($menu,$droit) {

		$q = "SELECT droit from menu_profil where id_profil = (select id_profil from users where id_user=?) and id_menu=? and droit like '%".$droit."%'";
		$q = $this->db->query($q,array($this->session->userdata('user_id'),$menu));

		if ($q->num_rows()>0) return true;
		else return false;
	}

	public function droit_menu_url($menu,$droit) {

		$q = "SELECT droit from menu_profil left join menu on menu.id_menu = menu_profil.id_menu where id_profil = (select id_profil from users where id_user=?) and url_menu=? and droit like '%".$droit."%'";
		$q = $this->db->query($q,array($this->session->userdata('user_id'),$menu));

		if ($q->num_rows()>0) return true;
		else return false;
	}

	public function droit_parent($menu,$droit) {

		$q = 'SELECT id_menu from menu where men_id_menu = ?';
		$q = $this->db->query($q,array($menu));
		$i=0;

		if ($q->num_rows()>0) {
			foreach ($q->result() as $value) {
				if ($this->droit_menu($value->id_menu,$droit)) $i++;
			}
			if ($i) return true;
			else return false;
		}
		else return false;
	}

	public function droit_aieul($menu,$droit) {

		$q = 'SELECT id_menu from menu where Sur_id_menu = ?';
		$q = $this->db->query($q,array($menu));

		$i=0;

		if ($q->num_rows()>0) {
			foreach ($q->result() as $value) {
				if ($this->droit_menu($value->id_menu,$droit)) $i++;
			}
			if ($i) return true;
			else return false;
		}
		else return false;
	}

  public function is_logged_in() {

		if ($this->session->userdata('logged_in')) return true;
		else return false;
	}

  public function is_chest() {

    $q = "SELECT id_caisse  FROM caisse  where date_caisse = ?";
    $q = $this->db->query($q,array(date('d/M/Y',local_to_gmt())));

    if ($q->num_rows()>0) return 1;
    else return false;
  }

// parameter attributes function

  public function save_value() {

		$q = 'SELECT sauvegarde from parametre';
		$q = $this->db->query($q);

		foreach ($q->result() as $val) return $val->sauvegarde;
	}

  public function nvo_save_value($val) {

    $q = 'UPDATE parametre set sauvegarde = ?';
    return $this->db->query($q,array($val));
  }

  public function corbeille_value() {

		$q = 'SELECT corbeille from parametre';
		$q = $this->db->query($q);

		foreach ($q->result() as $val) return $val->corbeille;
	}

  public function nvo_corbeille_value($val) {

    $q = 'UPDATE parametre set corbeille = ?';
    return $this->db->query($q,array($val));
  }

  public function liste_nationalite() {

		$q = 'SELECT liste_nationalite from parametre';
		$q = $this->db->query($q);

		if ($q->num_rows()>0) {
			foreach ($q->result() as $val) return $val->liste_nationalite;
		}
		else return false;
	}

	public function nvo_nationalite($nationality) {

		$liste = $this->liste_nationalite();
		$liste .= $nationality.',';

		$q = 'UPDATE parametre set liste_nationalite = ?';
		return $this->db->query($q,array($liste));
	}

  public function delete_nationalite($nationality) {

		$liste = $this->liste_nationalite();
    $liste = str_replace($nationality.',',"",$liste);

		$q = 'UPDATE parametre set liste_nationalite = ?';
		return $this->db->query($q,array($liste));
	}

  public function liste_pays() {

		$q = 'SELECT liste_pays from parametre';
		$q = $this->db->query($q);

		if ($q->num_rows()>0) {
			foreach ($q->result() as $val) return $val->liste_pays;
		}
		else return false;
	}

	public function nvo_pays($country) {

		$liste = $this->liste_pays();
		$liste .= $country.',';

		$q = 'UPDATE parametre set liste_pays = ?';
		return $this->db->query($q,array($liste));
	}

  public function delete_pays($country) {

		$liste = $this->liste_pays();
    $liste = str_replace($country.',',"",$liste);

		$q = 'UPDATE parametre set liste_pays = ?';
		return $this->db->query($q,array($liste));
	}

  public function liste_categorie() {

		$q = 'SELECT liste_categorie from parametre';
		$q = $this->db->query($q);

		if ($q->num_rows()>0) {
			foreach ($q->result() as $val) return $val->liste_categorie;
		}
		else return false;
	}

	public function nvo_categorie($category) {

		$liste = $this->liste_categorie();
		$liste .= $category.',';

		$q = 'UPDATE parametre set liste_categorie = ?';
		return $this->db->query($q,array($liste));
	}

  public function delete_categorie($category) {

		$liste = $this->liste_categorie();
    $liste = str_replace($category.',',"",$liste);

		$q = 'UPDATE parametre set liste_categorie = ?';
		return $this->db->query($q,array($liste));
	}

  public function liste_unite() {

		$q = 'SELECT liste_unite from parametre';
		$q = $this->db->query($q);

		if ($q->num_rows()>0) {
			foreach ($q->result() as $val) return $val->liste_unite;
		}
		else return false;
	}

  public function nvo_unite($unity) {

		$liste = $this->liste_unite();
		$liste .= $unity.',';

		$q = 'UPDATE parametre set liste_unite = ?';
		return $this->db->query($q,array($liste));
	}

  public function delete_unite($unity) {

		$liste = $this->liste_unite();
    $liste = str_replace($unity.',',"",$liste);

		$q = 'UPDATE parametre set liste_unite = ?';
		return $this->db->query($q,array($liste));
	}

	public function nvo_type($type,$contain) {

    if ($type == 'nationalite') return $this->nvo_nationalite($contain);
    if ($type == 'pays') return $this->nvo_pays($contain);
    if ($type == 'categorie') return $this->nvo_categorie($contain);
    if ($type == 'unite') return $this->nvo_unite($contain);
	}

  public function delete_type($type,$contain) {

    if ($type == 'nationalite') return $this->delete_nationalite($contain);
    if ($type == 'pays') return $this->delete_pays($contain);
    if ($type == 'categorie') return $this->delete_categorie($contain);
    if ($type == 'unite') return $this->delete_unite($contain);
	}

	public function authorize_type($type,$contain) {

    $list = null;
    if ($contain == 'nationalite') $list='liste_nationalite';
    if ($contain == 'pays') $list='liste_pays';
    if ($contain == 'categorie') $list='liste_categorie';
    if ($contain == 'unite') $list='liste_unite';

		$q = "SELECT".$list." from parametre where".$list." like '%".$type."%'";
		$q = $this->db->query($q);

		if ($q->num_rows()>0) return false;
		else return true;
	}

}
