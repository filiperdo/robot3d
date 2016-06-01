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

	public function __construct()
	{
		parent::__construct();

		$this->id_component = '';
		$this->name = '';
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

		return $this;
	}
}
?>