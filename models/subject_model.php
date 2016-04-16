<?php 

/** 
 * Classe Subject
 * @author __ 
 *
 * Data: 16/04/2016
 */ 


class Subject_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_subject;
	private $name;

	public function __construct()
	{
		parent::__construct();

		$this->id_subject = '';
		$this->name = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_subject( $id_subject )
	{
		$this->id_subject = $id_subject;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	/** 
	* Metodos get's
	*/
	public function getId_subject()
	{
		return $this->id_subject;
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

		if( !$id = $this->db->insert( "subject", $data ) ){
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

		if( !$update = $this->db->update("subject", $data, "id_subject = {$id} ") ){
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

		if( !$delete = $this->db->delete("subject", "id_subject = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterSubject
	*/
	public function obterSubject( $id_subject )
	{
		$sql  = "select * ";
		$sql .= "from subject ";
		$sql .= "where id_subject = :id ";

		$result = $this->db->select( $sql, array("id" => $id_subject) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarSubject
	*/
	public function listarSubject()
	{
		$sql  = "select * ";
		$sql .= "from subject ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_subject like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_subject( $row["id_subject"] );
		$this->setName( $row["name"] );

		return $this;
	}
}
?>