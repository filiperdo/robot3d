<?php 

/** 
 * Classe Datalog
 * @author __ 
 *
 * Data: 01/06/2016
 */ 

include_once 'post_model.php';
include_once 'project_model.php';
include_once 'item_model.php';

class Datalog_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_datalog;
	private $date;
	private $user_id_user;
	private $post;
	private $project;
	private $item;

	public function __construct()
	{
		parent::__construct();

		$this->id_datalog = '';
		$this->date = '';
		$this->user_id_user = '';
		$this->post = new Post_Model();
		$this->project = new Project_Model();
		$this->item = new Item_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setId_datalog( $id_datalog )
	{
		$this->id_datalog = $id_datalog;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	public function setUser_id_user( $user_id_user )
	{
		$this->user_id_user = $user_id_user;
	}

	public function setPost( Post_Model $post )
	{
		$this->post = $post;
	}

	public function setProject( Project_Model $project )
	{
		$this->project = $project;
	}

	public function setItem( Item_Model $item )
	{
		$this->item = $item;
	}

	/** 
	* Metodos get's
	*/
	public function getId_datalog()
	{
		return $this->id_datalog;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getUser_id_user()
	{
		return $this->user_id_user;
	}

	public function getPost()
	{
		return $this->post;
	}

	public function getProject()
	{
		return $this->project;
	}

	public function getItem()
	{
		return $this->item;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "datalog", $data ) ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return true;
	}

	/** 
	* Metodo edit
	*/
	public function edit( $data, $id )
	{
		$this->db->beginTransaction();

		if( !$update = $this->db->update("datalog", $data, "id_datalog = {$id} ") ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $update;
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->db->beginTransaction();

		if( !$delete = $this->db->delete("datalog", "id_datalog = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterDatalog
	*/
	public function obterDatalog( $id_datalog )
	{
		$sql  = "select * ";
		$sql .= "from datalog ";
		$sql .= "where id_datalog = :id ";

		$result = $this->db->select( $sql, array("id" => $id_datalog) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarDatalog
	*/
	public function listarDatalog()
	{
		$sql  = "select * ";
		$sql .= "from datalog ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_datalog like :id "; // Configurar o like com o campo necessario da tabela 
			$result = $this->db->select( $sql, array("id" => "%{$_POST["like"]}%") );
		}
		else
			$result = $this->db->select( $sql );

		return $this->montarLista($result);
	}

	/** 
	* Metodo montarLista
	*/
	private function montarLista( $result )
	{
		$objs = array();
		if( !empty( $result ) )
		{
			foreach( $result as $row )
			{
				$obj = new self();
				$obj->montarObjeto( $row );
				$objs[] = $obj;
				$obj = null;
			}
		}
		return $objs;
	}

	/** 
	* Metodo montarObjeto
	*/
	private function montarObjeto( $row )
	{
		$this->setId_datalog( $row["id_datalog"] );
		$this->setDate( $row["date"] );
		$this->setUser_id_user( $row["user_id_user"] );

		$objPost = new Post_Model();
		$objPost->obterPost( $row["id_post"] );
		$this->setPost( $objPost );

		$objProject = new Project_Model();
		$objProject->obterProject( $row["id_project"] );
		$this->setProject( $objProject );

		$objItem = new Item_Model();
		$objItem->obterItem( $row["id_item"] );
		$this->setItem( $objItem );

		return $this;
	}
}
?>