<?php 

/** 
 * Classe Project
 * @author __ 
 *
 * Data: 01/06/2016
 */ 

include_once 'user_model.php';

class Project_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_project;
	private $title;
	private $website;
	private $link_image;
	private $content;
	private $level;
	private $date;
	private $user;

	public function __construct()
	{
		parent::__construct();

		$this->id_project = '';
		$this->title = '';
		$this->website = '';
		$this->link_image = '';
		$this->content = '';
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

	public function setTitle( $title )
	{
		$this->title = $title;
	}

	public function setWebsite( $website )
	{
		$this->website = $website;
	}

	public function setLink_image( $link_image )
	{
		$this->link_image = $link_image;
	}

	public function setContent( $content )
	{
		$this->content = $content;
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

	public function getTitle()
	{
		return $this->title;
	}

	public function getWebsite()
	{
		return $this->website;
	}

	public function getLink_image()
	{
		return $this->link_image;
	}

	public function getContent()
	{
		return $this->content;
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
	public function listarProject( $limit = NULL )
	{
		$sql  = "select * ";
		$sql .= "from project as p ";
		$sql .= "order by p.date desc ";
		
		if( $limit )
			$sql .= "limit {$limit} ";
		
		$result = $this->db->select($sql);
		
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
		$this->setTitle( $row["title"] );
		$this->setWebsite( $row["website"] );
		$this->setLink_image( $row["link_image"] );
		$this->setContent( $row["content"] );
		$this->setLevel( $row["level"] );
		$this->setDate( $row["date"] );

		$objUser = new User_Model();
		$objUser->obterUser( $row["id_user"] );
		$this->setUser( $objUser );

		return $this;
	}
}
?>