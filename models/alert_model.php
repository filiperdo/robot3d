<?php 

/** 
 * Classe Alert
 * @author __ 
 *
 * Data: 30/06/2016
 */ 

include_once 'notify_model.php';
include_once 'user_model.php';

class Alert_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_alert;
	private $notify;
	private $user;
	private $read;
	private $date;

	public function __construct()
	{
		parent::__construct();

		$this->id_alert = '';
		$this->notify = new Notify_Model();
		$this->user = new User_Model();
		$this->read = '';
		$this->date = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_alert( $id_alert )
	{
		$this->id_alert = $id_alert;
	}

	public function setNotify( Notify_Model $notify )
	{
		$this->notify = $notify;
	}

	public function setUser( User_Model $user )
	{
		$this->user = $user;
	}

	public function setRead( $read )
	{
		$this->read = $read;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	/** 
	* Metodos get's
	*/
	public function getId_alert()
	{
		return $this->id_alert;
	}

	public function getNotify()
	{
		return $this->notify;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function getRead()
	{
		return $this->read;
	}

	public function getDate()
	{
		return $this->date;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "alert", $data ) ){
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

		if( !$update = $this->db->update("alert", $data, "id_alert = {$id} ") ){
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

		if( !$delete = $this->db->delete("alert", "id_alert = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterAlert
	*/
	public function obterAlert( $id_alert )
	{
		$sql  = "select * ";
		$sql .= "from alert ";
		$sql .= "where id_alert = :id ";

		$result = $this->db->select( $sql, array("id" => $id_alert) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarAlert
	*/
	public function listarAlert()
	{
		$sql  = "select * ";
		$sql .= "from alert ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_alert like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_alert( $row["id_alert"] );

		$objNotify = new Notify_Model();
		$objNotify->obterNotify( $row["id_notify"] );
		$this->setNotify( $objNotify );

		$objUser = new User_Model();
		$objUser->obterUser( $row["id_user"] );
		$this->setUser( $objUser );
		$this->setRead( $row["read"] );
		$this->setDate( $row["date"] );

		return $this;
	}
}
?>