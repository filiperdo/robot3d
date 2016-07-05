<?php 

/** 
 * Classe Notify
 * @author __ 
 *
 * Data: 30/06/2016
 */ 

include_once 'user_model.php';
include_once 'topic_model.php';

class Notify_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_notify;
	private $type;
	private $user;
	//private $item;
	private $topic;

	public function __construct()
	{
		parent::__construct();

		$this->id_notify = '';
		$this->type = '';
		$this->user = new User_Model();
		//$this->item = new Item_Model();
		$this->topic = new Topic_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setId_notify( $id_notify )
	{
		$this->id_notify = $id_notify;
	}

	public function setType( $type )
	{
		$this->type = $type;
	}

	public function setUser( User_Model $user )
	{
		$this->user = $user;
	}

	/*public function setItem( Item_Model $item )
	{
		$this->item = $item;
	}*/
	
	public function setTopic( Topic_Model $topic )
	{
		$this->topic = $topic;
	}

	/** 
	* Metodos get's
	*/
	public function getId_notify()
	{
		return $this->id_notify;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getUser()
	{
		return $this->user;
	}

	/*public function getItem()
	{
		return $this->item;
	}*/

	
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

		if( !$id = $this->db->insert( "notify", $data ) ){
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

		if( !$update = $this->db->update("notify", $data, "id_notify = {$id} ") ){
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

		if( !$delete = $this->db->delete("notify", "id_notify = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterNotify
	*/
	public function obterNotify( $id_notify )
	{
		$sql  = "select * ";
		$sql .= "from notify ";
		$sql .= "where id_notify = :id ";

		$result = $this->db->select( $sql, array("id" => $id_notify) );
		return $this->montarObjeto( $result[0] );
	}

	/**
	 * Procura por uma notificacao
	 * @param unknown $id_item
	 * @param unknown $id_user
	 * @param unknown $type
	 */
	public function searchNotify( $id_topic, $id_user, $type = NULL )
	{
		$sql  = "select * ";
		$sql .= "from notify as n ";
		$sql .= "where n.id_topic = :id_topic ";
		$sql .= "and n.id_user = :id_user ";
		//$sql .= "and n.type = :type ";
		
		$result = $this->db->select( $sql, array("id_topic" => $id_topic, "id_user" => $id_user ) );
		if( !empty( $result ) )
			return $this->montarObjeto( $result[0] );
		else 
			return false;
	}
	
	/** 
	* Metodo listarNotify
	*/
	public function listarNotify()
	{
		$sql  = "select * ";
		$sql .= "from notify ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_notify like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_notify( $row["id_notify"] );
		$this->setType( $row["type"] );

		$objUser = new User_Model();
		$objUser->obterUser( $row["id_user"] );
		$this->setUser( $objUser );

		/*$objItem = new Item_Model();
		$objItem->obterItem( $row["id_item"] );
		$this->setItem( $objItem );*/
		
		$objTopic = new Topic_Model();
		$objTopic->obterTopic( $row['id_topic'] );
		$this->setTopic( $objTopic );

		return $this;
	}
}
?>