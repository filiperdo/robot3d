<?php 

/** 
 * Classe Project
 * @author __ 
 *
 * Data: 16/04/2016
 */ 

include_once 'user_model.php';

class Project_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_project;
	private $name;
	private $website;
	private $link_image;
	private $description;
	private $level;
	private $date;
	private $user;

	public function __construct()
	{
		parent::__construct();

		$this->id_project = '';
		$this->name = '';
		$this->website = '';
		$this->link_image = '';
		$this->description = '';
		$this->level = '';
		$this->date = '';
		$this->user = new User_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setId_project( $id_project )
	{
		$this->id_project = $id_project;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setWebsite( $website )
	{
		$this->website = $website;
	}

	public function setLink_image( $link_image )
	{
		$this->link_image = $link_image;
	}

	public function setDescription( $description )
	{
		$this->description = $description;
	}

	public function setLevel( $level )
	{
		$this->level = $level;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	public function setUser( User_Model $user )
	{
		$this->user = $user;
	}

	/** 
	* Metodos get's
	*/
	public function getId_project()
	{
		return $this->id_project;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getWebsite()
	{
		return $this->website;
	}

	public function getLink_image()
	{
		return $this->link_image;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getLevel()
	{
		return $this->level;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getUser()
	{
		return $this->user;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "project", $data ) ){
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

		if( !$update = $this->db->update("project", $data, "id_project = {$id} ") ){
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

		if( !$delete = $this->db->delete("project", "id_project = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterProject
	*/
	public function obterProject( $id_project )
	{
		$sql  = "select * ";
		$sql .= "from project ";
		$sql .= "where id_project = :id ";

		$result = $this->db->select( $sql, array("id" => $id_project) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarProject
	*/
	public function listarProject()
	{
		$sql  = "select * ";
		$sql .= "from project ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_project like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_project( $row["id_project"] );
		$this->setName( $row["name"] );
		$this->setWebsite( $row["website"] );
		$this->setLink_image( $row["link_image"] );
		$this->setDescription( $row["description"] );
		$this->setLevel( $row["level"] );
		$this->setDate( $row["date"] );

		$objUser = new User_Model();
		$objUser->obterUser( $row["id_user"] );
		$this->setUser( $objUser );

		return $this;
	}
}
?>