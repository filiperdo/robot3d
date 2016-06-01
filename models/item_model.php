<?php 

/** 
 * Classe Item
 * @author __ 
 *
 * Data: 01/06/2016
 */ 

include_once 'user_model.php';
include_once 'topic_model.php';

class Item_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_item;
	private $views;
	private $content;
	private $date;
	private $user;
	private $topic;

	public function __construct()
	{
		parent::__construct();

		$this->id_item = '';
		$this->views = '';
		$this->content = '';
		$this->date = '';
		$this->user = new User_Model();
		$this->topic = new Topic_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setId_item( $id_item )
	{
		$this->id_item = $id_item;
	}

	public function setViews( $views )
	{
		$this->views = $views;
	}

	public function setContent( $content )
	{
		$this->content = $content;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	public function setUser( User_Model $user )
	{
		$this->user = $user;
	}

	public function setTopic( Topic_Model $topic )
	{
		$this->topic = $topic;
	}

	/** 
	* Metodos get's
	*/
	public function getId_item()
	{
		return $this->id_item;
	}

	public function getViews()
	{
		return $this->views;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function getTopic()
	{
		return $this->topic;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "item", $data ) ){
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

		if( !$update = $this->db->update("item", $data, "id_item = {$id} ") ){
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

		if( !$delete = $this->db->delete("item", "id_item = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterItem
	*/
	public function obterItem( $id_item )
	{
		$sql  = "select * ";
		$sql .= "from item ";
		$sql .= "where id_item = :id ";

		$result = $this->db->select( $sql, array("id" => $id_item) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarItem
	*/
	public function listarItem()
	{
		$sql  = "select * ";
		$sql .= "from item ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_item like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_item( $row["id_item"] );
		$this->setViews( $row["views"] );
		$this->setContent( $row["content"] );
		$this->setDate( $row["date"] );

		$objUser = new User_Model();
		$objUser->obterUser( $row["id_user"] );
		$this->setUser( $objUser );

		$objTopic = new Topic_Model();
		$objTopic->obterTopic( $row["id_topic"] );
		$this->setTopic( $objTopic );

		return $this;
	}
}
?>