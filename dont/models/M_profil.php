<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class M_profil extends CI_Model {

	public $table ='profil';
	public $table2 ='menu_profil';

	function __construct() {

		parent::__construct();
	}

  public function new_profil($lib,$desc='') {

    $this->db->set('nom_profil',$lib)
      ->set('creator',$this->session->userdata('user_id'));
    if ($desc!='') $this->db->set('desc_profil',$desc);

    return $this->db->insert($this->table);
  }

  public function update($id,$lib,$desc='') {

    $this->db->set('nom_profil',$lib)
      ->set('updated',date('d/M/Y H:m:s',local_to_gmt()));
    if ($desc!='') $this->db->set('desc_profil',$desc);

    return $this->db->where('id_profil',$id)->update($this->table);
  }

  public function delete($id) {

    $this->db->set('deleted',date('d/M/Y H:m:s',local_to_gmt()));
    return $this->db->where('id_profil',$id)->update($this->table);
  }

  public function restore($id) {

    $this->db->set('deleted',null);
    return $this->db->where('id_profil',$id)->update($this->table);
  }

  public function well_delete($id) {

    if ($this->db->where('id_profil',$id)->delete($this->table2))
      return $this->db->where('id_profil',$id)->delete($this->table);
    else return false;
  }

  public function liste() {
    $q = 'SELECT deleted,id_profil, nom_profil, desc_profil from profil where deleted is null order by nom_profil';
		$q = $this->db->query($q);

		if ($q->num_rows()>0) {
			return $q;
		}
		else return false;
  }

  public function liste_deleted() {
    $q = 'SELECT deleted,id_profil, nom_profil, desc_profil from profil where deleted is not null order by nom_profil';
		$q = $this->db->query($q);

		if ($q->num_rows()>0) return $q;
		else return false;
  }

  public function authorize($lib) {
		$q = $this->db->select('deleted, id_profil')
			->where('nom_profil',$lib)
			->where('deleted is null')
			->get($this->table);

		if ($q->num_rows()>0) return false;
		else return true;
	}

  public function get($id) {
    $q = 'SELECT deleted,id_profil, nom_profil, desc_profil from profil where id_profil = ? and deleted is null order by nom_profil';
		$q = $this->db->query($q,array($id));

    foreach ($q->result() as $value) {
      return $value;
    }
    return false;
  }

	public function get_information($id) {

		$q = "SELECT c.creator, TO_CHAR(c.created,'dd TMMon YYYY à HH24:mi') as created,nom_profil, TO_CHAR(c.updated,'dd TMMon YYYY à HH24:mi') as updated, concat(z.nom,' ',z.prenom) as createur FROM profil c left join users z on z.id_user = c.creator WHERE c.id_profil = ?";
		$q = $this->db->query($q,array($id));

		if ($q->num_rows()>0)
			foreach ($q->result() as $value) {
				return $value;
			}
		else return false;
	}

	public function last_id() {

		$q = $this->db->select('deleted,id_profil ')
        ->where('deleted is null')
        ->order_by('id_profil','desc')->limit(1)
        ->get($this->table);

    foreach ($q->result() as $value)  return $value->id_profil;
    return false;
	}

// profile_right

  public function new_right($profile,$menu,$right) {

    $this->db->set('id_profil',$profile)
      ->set('id_menu',$menu)
      ->set('droit',$right);

    return $this->db->insert($this->table2);
  }

  public function update_right($id_profil,$id_menu,$right) {

    $this->db->set('droit',$right);
    return $this->db->where('id_profil',$id_profil)->where('id_menu',$id_menu)->update($this->table2);
  }

  public function list_right($id) {
    $q = 'SELECT droit, nom_menu,icone from droit_profil left join menu on menu.id_menu = droit_profil.id_menu where id_profil = ?';
    $q = $this->db->query($q,array($id));

    if ($q->num_rows()>0) {
      return $q;
    }
    else return false;
  }

	public function list_all_right($id) {

    $q = 'SELECT menu_profil.id_menu, men_id_menu, nom_menu,icone,droit from menu_profil left join menu on menu.id_menu = menu_profil.id_menu where id_profil = ? union SELECT id_menu, men_id_menu, nom_menu,icone,droit_dispo as droit from menu where id_menu in (select distinct(men_id_menu) from menu_profil left join menu on menu.id_menu = menu_profil.id_menu where id_profil = ?) order by ID_MENU asc';
    $q = $this->db->query($q,array($id,$id));

    if ($q->num_rows()>0) return $q;
    else return false;
  }

	public function droit($id,$menu) {

    $q = "SELECT menu_profil.id_menu, men_id_menu, nom_menu,icone,droit,0 as nb_sous_menu from menu_profil left join menu on menu.id_menu = menu_profil.id_menu where id_profil = ? and sur_id_menu = (select id_menu from menu where nom_menu = ?)
					union
					SELECT m.id_menu, men_id_menu, nom_menu,icone,droit_dispo as droit, (SELECT count(men_id_menu) from menu_profil left join menu on menu.id_menu = menu_profil.id_menu  where id_profil = ?  and sur_id_menu = (select id_menu from menu where nom_menu = ?)  and men_id_menu = m.id_menu) nb_sous_menu from menu m where id_menu in
					(select distinct(men_id_menu) from menu_profil left join menu on menu.id_menu = menu_profil.id_menu where id_profil = ? and sur_id_menu = (select id_menu from menu where nom_menu = ?)) order by ID_MENU asc";
		$q = $this->db->query($q,array($id,$menu,$id,$menu,$id,$menu));

    if ($q->num_rows()>0) return $q;
    else return false;
  }

	public function liste_menu($menu) {

		$q = "SELECT m.id_menu, m.men_id_menu, m.nom_menu, m.url_menu, m.icone,m.droit_dispo ,(select count(*) from menu where men_id_menu = m.id_menu) nb_sous_menu from menu m  where sur_id_menu = (select id_menu from menu where nom_menu = ?) order by ID_MENU asc";
		$q = $this->db->query($q,array($menu));

		if ($q->num_rows()>0) return $q;
		else return false;
	}

}
