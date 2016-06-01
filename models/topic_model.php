<?php 

/** 
 * Classe Topic
 * @author __ 
 *
 * Data: 01/06/2016
 */ 

include_once 'subject_model.php';

class Topic_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_topic;
	private $name;
	private $description;
	private $subject;

	public function __construct()
	{
		parent::__construct();

		$this->id_topic = '';
		$this->name = '';
		$this->description = '';
		$this->subject = new Subject_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setId_topic( $id_topic )
	{
		$this->id_topic = $id_topic;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setDescription( $description )
	{
		$this->description = $description;
	}

	public function setSubject( Subject_Model $subject )
	{
		$this->subject = $subject;
	}

	/** 
	* Metodos get's
	*/
	public function getId_topic()
	{
		return $this->id_topic;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getSubject()
	{
		return $this->subject;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "topic", $data ) ){
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

		if( !$update = $this->db->update("topic", $data, "id_topic = {$id} ") ){
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

		if( !$delete = $this->db->delete("topic", "id_topic = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterTopic
	*/
	public function obterTopic( $id_topic )
	{
		$sql  = "select * ";
		$sql .= "from topic ";
		$sql .= "where id_topic = :id ";

		$result = $this->db->select( $sql, array("id" => $id_topic) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarTopic
	*/
	public function listarTopic()
	{
		$sql  = "select * ";
		$sql .= "from topic ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_topic like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_topic( $row["id_topic"] );
		$this->setName( $row["name"] );
		$this->setDescription( $row["description"] );

		$objSubject = new Subject_Model();
		$objSubject->obterSubject( $row["id_subject"] );
		$this->setSubject( $objSubject );

		return $this;
	}
}
?>