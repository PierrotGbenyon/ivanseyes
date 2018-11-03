<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class M_corbeille extends CI_Model {

	public $table ='corbeille';

	function __construct() {

		parent::__construct();
	}

  public function new_corbeille($icone,$id,$model,$desc) {

    $this->db->set('icone',$icone)
	    ->set('id',$id)
	    ->set('model',$model)
	    ->set('description',$desc);

    return $this->db->insert($this->table);
  }

  public function delete($id) {

    $this->db->where('id_corbeille',$id)->delete($this->table);
  }

  public function restore($id) {

    $this->db->set('deleted',null);
    return $this->db->where('id_corbeille',$id)->update($this->table);
  }

  public function liste() {

    $q = "SELECT id_corbeille, id, icone, model, description, TO_CHAR(deleted,'le dd TMMon YYYY à HH24:mi') as deleted from corbeille order by id_corbeille desc";
		$q = $this->db->query($q);

		if ($q->num_rows()>0)  return $q;
		else return false;
  }


}
