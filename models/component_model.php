<?php

/**
 * Classe Component
 * @author __
 *
 * Data: 01/06/2016
 */


class Component_Model extends Model
{
	/**
	* Atributos Private
	*/
	private $id_component;
	private $name;
	private $link;
	private $comment;
	private $amount;
	private $project;

	public function __construct()
	{
		parent::__construct();

		$this->id_component = '';
		$this->name = '';
		$this->link = '';
		$this->comment = '';
		$this->amount = '';
		$this->project = '';
	}

	/**
	* Metodos set's
	*/
	public function setId_component( $id_component )
	{
		$this->id_component = $id_component;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setLink( $link )
	{
		$this->link = $link;
	}

	public function setComment( $comment )
	{
		$this->comment = $comment;
	}

	public function setAmount( $amount )
	{
		$this->amount = $amount;
	}

	public function setProject( $project )
	{
		$this->project = $project;
	}

	/**
	* Metodos get's
	*/
	public function getId_component()
	{
		return $this->id_component;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getLink()
	{
		return $this->link;
	}

	public function getComment()
	{
		return $this->comment;
	}

	public function getAmount()
	{
		return $this->amount;
	}

	public function getProject()
	{
		return $this->project;
	}


	/**
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "component", $data ) ){
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

		if( !$update = $this->db->update("component", $data, "id_component = {$id} ") ){
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

		if( !$delete = $this->db->delete("component", "id_component = {$id} ") ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/**
	* Metodo obterComponent
	*/
	public function obterComponent( $id_component )
	{
		$sql  = "select * ";
		$sql .= "from component ";
		$sql .= "where id_component = :id ";

		$result = $this->db->select( $sql, array("id" => $id_component) );
		return $this->montarObjeto( $result[0] );
	}

	/**
	* Metodo listarComponent
	*/
	public function listarComponent()
	{
		$sql  = "select * ";
		$sql .= "from component ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_component like :id "; // Configurar o like com o campo necessario da tabela
			$result = $this->db->select( $sql, array("id" => "%{$_POST["like"]}%") );
		}
		else
			$result = $this->db->select( $sql );

		return $this->montarLista($result);
	}

	/**
	 * Lista os componentes de um projeto
	 * @param unknown $id_project
	 */
	public function listComponentByProject( $id_project )
	{
		$sql  = "select c.* ";
		$sql .= "from component as c ";
		$sql .= "where c.id_project = :id_project ";

		$result = $this->db->select( $sql, array( "id_project" => $id_project ) );
		return $this->montarLista( $result );
	}

	/**
	 * Lista os componentes de um projeto
	 * METODO INUTILIZADO POIS A TABELA project_component NAO ESTA SENDO UTILIZADA
	 * @param unknown $id_project
	 */
	public function listComponentByProject_old( $id_project )
	{
		$sql  = "select c.* ";
		$sql .= "from component as c ";
		$sql .= "inner join project_component as pc ";
		$sql .= "on pc.id_component = c.id_component ";
		$sql .= "where pc.id_project = :id_project ";

		$result = $this->db->select( $sql, array( "id_project" => $id_project ) );
		return $this->montarLista( $result );
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
		$this->setId_component( $row["id_component"] );
		$this->setName( $row["name"] );
		$this->setLink( $row['link'] );
		$this->setComment( $row['comment'] );
		$this->setAmount( $row['amount'] );
		$this->setProject( $row['id_project'] );

		return $this;
	}
}
?>
