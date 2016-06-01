<?php 

/** 
 * Classe Follow
 * @author __ 
 *
 * Data: 01/06/2016
 */ 

include_once 'follower_model.php';
include_once 'user_model.php';

class Follow_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $follower;
	private $user;

	public function __construct()
	{
		parent::__construct();

		$this->follower = new Follower_Model();
		$this->user = new User_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setFollower( Follower_Model $follower )
	{
		$this->follower = $follower;
	}

	public function setUser( User_Model $user )
	{
		$this->user = $user;
	}

	/** 
	* Metodos get's
	*/
	public function getFollower()
	{
		return $this->follower;
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

		if( !$id = $this->db->insert( "follow", $data ) ){
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

		if( !$update = $this->db->update("follow", $data, "id_follow = {$id} ") ){
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

		if( !$delete = $this->db->delete("follow", "id_follow = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterFollow
	*/
	public function obterFollow( $id_follow )
	{
		$sql  = "select * ";
		$sql .= "from follow ";
		$sql .= "where id_follow = :id ";

		$result = $this->db->select( $sql, array("id" => $id_follow) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarFollow
	*/
	public function listarFollow()
	{
		$sql  = "select * ";
		$sql .= "from follow ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_follow like :id "; // Configurar o like com o campo necessario da tabela 
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

		$objFollower = new Follower_Model();
		$objFollower->obterFollower( $row["id_follower"] );
		$this->setFollower( $objFollower );

		$objUser = new User_Model();
		$objUser->obterUser( $row["id_user"] );
		$this->setUser( $objUser );

		return $this;
	}
}
?>