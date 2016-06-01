<?php 

/** 
 * Classe Project_component
 * @author __ 
 *
 * Data: 01/06/2016
 */ 

include_once 'project_model.php';
include_once 'component_model.php';

class Project_component_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $project;
	private $component;

	public function __construct()
	{
		parent::__construct();

		$this->project = new Project_Model();
		$this->component = new Component_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setProject( Project_Model $project )
	{
		$this->project = $project;
	}

	public function setComponent( Component_Model $component )
	{
		$this->component = $component;
	}

	/** 
	* Metodos get's
	*/
	public function getProject()
	{
		return $this->project;
	}

	public function getComponent()
	{
		return $this->component;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "project_component", $data ) ){
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

		if( !$update = $this->db->update("project_component", $data, "id_project_component = {$id} ") ){
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

		if( !$delete = $this->db->delete("project_component", "id_project_component = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterProject_component
	*/
	public function obterProject_component( $id_project_component )
	{
		$sql  = "select * ";
		$sql .= "from project_component ";
		$sql .= "where id_project_component = :id ";

		$result = $this->db->select( $sql, array("id" => $id_project_component) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarProject_component
	*/
	public function listarProject_component()
	{
		$sql  = "select * ";
		$sql .= "from project_component ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_project_component like :id "; // Configurar o like com o campo necessario da tabela 
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

		$objComponent = new Component_Model();
		$objComponent->obterComponent( $row["id_component"] );
		$this->setComponent( $objComponent );

		return $this;
	}
}
?>