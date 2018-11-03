<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class M_user extends CI_Model {

	public $table ='users';

	function __construct() {

		parent::__construct();
	}

	public function new_user($profil,$name,$first_name,$login,$pass) {

		$this->db->set('id_profil',$profil)
			->set('login',$login)
			->set('nom',$name)
			->set('prenom',$first_name)
			->set('password',password_hash($pass,PASSWORD_BCRYPT,['cost' => 13]))
			->set('creator',$this->session->userdata('user_id'));
		return $this->db->insert($this->table);
	}

	public function cg_password($pass) {

		$datetime = date('d/M/Y H:m:s',local_to_gmt());
		$this->db->set('password',$hash = password_hash($pass,PASSWORD_BCRYPT,['cost' => 13]))
			->set('updated',$datetime);

		return $this->db->where('id_user',$this->session->userdata('user_id'))->update($this->table);
	}

	public function not_first_use() {

		$datetime = date('d/M/Y H:m:s',local_to_gmt());
		$this->db->set('first_use',0)
			->set('updated',$datetime);

		return $this->db->where('id_user',$this->session->userdata('user_id'))->update($this->table);
	}

	public function delete($id) {

		$datetime = date('d/M/Y H:m:s',local_to_gmt());
		$this->db->set('deleted', $datetime);
		return $this->db->where('id_user',$id)->update($this->table);
	}

	public function restore_user($id) {

		$this->db->set('deleted', null);
		return $this->db->where('id_user',$id)->update($this->table);
	}

	public function well_delete($id) {

      return $this->db->where('id_user',$id)->delete($this->table);
  }

	public function liste() {

		$q = "SELECT users.deleted, users.id_user, login,TO_CHAR(users.created,'dd/Mon/YYYY') as created, actif, nom_profil, nom, prenom FROM users LEFT JOIN profil ON profil.id_profil = users.id_profil where users.deleted is null ORDER BY users.id_profil, login";
		$q = $this->db->query($q);

		if ($q->num_rows()>0)  return $q;
		else return false;
	}

	public function liste_deleted() {

		$q = "SELECT users.deleted, users.id_user, login,TO_CHAR(users.created,'dd/Mon/YYYY') as created, actif, nom_profil,nom,prenom FROM users LEFT JOIN profil ON profil.id_profil = users.id_profil where users.deleted is not null ORDER BY login";
		$q = $this->db->query($q);

		if ($q->num_rows()>0) return $q;
		else return false;
	}

	public function last_id() {

		$q = $this->db->select('deleted, id_user')
					->where('deleted is null')
					->order_by('id_user','desc')->limit(1)
					->get($this->table);

		foreach ($q->result() as $value) {
			return $value->id_user;
		}
		return false;
	}

	public function get($login) {

		$q = "SELECT users.creator, users.id_user, TO_CHAR(users.created,'dd TMMon YYYY') as created,password, nom, prenom, photo, actif,first_use, nom_profil FROM users LEFT JOIN profil ON profil.id_profil = users.id_profil WHERE login = ? and users.deleted is null";
		$q = $this->db->query($q,array($login));

		if ($q->num_rows()>0)
			foreach ($q->result() as $value) {
				return $value;
			}
		else return false;
	}

	public function get_information($id) {

		$q = "SELECT u.creator, TO_CHAR(u.created,'dd TMMon YYYY à HH24:mi') as created, TO_CHAR(u.updated,'dd TMMon YYYY à HH24:mi') as updated, u.login, concat(u.nom,' ',u.prenom) as nom, concat(c.nom,' ',c.prenom) as createur FROM users u left join users c on u.creator = c.id_user WHERE u.id_user = ?";
		$q = $this->db->query($q,array($id));

		if ($q->num_rows()>0)
			foreach ($q->result() as $value) {
				return $value;
			}
		else return false;
	}

	public function get_password($login) {

		$q = "SELECT password FROM users WHERE login = ?";
		$q = $this->db->query($q,array($login));

		if ($q->num_rows()>0)
			foreach ($q->result() as $value) {
				return $value->password;
			}
		else return false;
	}

  public function get_etat($id) {

		$q = "SELECT actif FROM users WHERE id_user = ?";
		$q = $this->db->query($q,array($id));

		foreach ($q->result() as $value) {
			return $value->actif;
		}
	}

	public function lock($id) {

		$datetime = date('d/M/Y H:m:s',local_to_gmt());
		return $this->db->set('actif',0)
			->set('updated',$datetime)->where('id_user',$id)->update($this->table);
	}

	public function unlock($id) {

		$datetime = date('d/M/Y H:m:s',local_to_gmt());
		return $this->db->set('actif',1)
			->set('updated',$datetime)->where('id_user',$id)->update($this->table);
	}

	public function authorize($login) {

		$q = $this->db->select('deleted,id_user')
			->where('login',$login)
			->get($this->table);

		if ($q->num_rows()>0) return false;
		else return true;
	}

}
