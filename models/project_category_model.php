<?php 

/** 
 * Classe Project_category
 * @author __ 
 *
 * Data: 01/06/2016
 */ 

include_once 'project_model.php';
include_once 'category_model.php';

class Project_category_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $project;
	private $category;

	public function __construct()
	{
		parent::__construct();

		$this->project = new Project_Model();
		$this->category = new Category_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setProject( Project_Model $project )
	{
		$this->project = $project;
	}

	public function setCategory( Category_Model $category )
	{
		$this->category = $category;
	}

	/** 
	* Metodos get's
	*/
	public function getProject()
	{
		return $this->project;
	}

	public function getCategory()
	{
		return $this->category;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "project_category", $data ) ){
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

		if( !$update = $this->db->update("project_category", $data, "id_project_category = {$id} ") ){
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

		if( !$delete = $this->db->delete("project_category", "id_project_category = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterProject_category
	*/
	public function obterProject_category( $id_project_category )
	{
		$sql  = "select * ";
		$sql .= "from project_category ";
		$sql .= "where id_project_category = :id ";

		$result = $this->db->select( $sql, array("id" => $id_project_category) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarProject_category
	*/
	public function listarProject_category()
	{
		$sql  = "select * ";
		$sql .= "from project_category ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_project_category like :id "; // Configurar o like com o campo necessario da tabela 
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

		$objProject = new Project_Model();
		$objProject->obterProject( $row["id_project"] );
		$this->setProject( $objProject );

		$objCategory = new Category_Model();
		$objCategory->obterCategory( $row["id_category"] );
		$this->setCategory( $objCategory );

		return $this;
	}
}
?>