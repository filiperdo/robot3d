<?php 

/** 
 * Classe Follow
 * @author __ 
 *
 * Data: 01/06/2016
 */ 

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

		$this->follower = new User_Model();
		$this->user = new User_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setFollower( User_Model $follower )
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
		
		if( !$id = $this->db->insert( "follow", $data, false ) ){
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
	public function delete( $id_user, $id_follower )
	{
		$this->db->beginTransaction();

		$where = "id_follower = {$id_follower} and id_user = {$id_user}";
		
		if( !$delete = $this->db->delete("follow", $where) ){ 
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
	 * Lista os seguidores do user selecionado
	 */
	public function listFollowers( $id_user )
	{
		$sql  = 'select * ';
		$sql .= 'from follow ';
		$sql .= 'where id_user = :id ';
	
		$result = $this->db->select( $sql, array("id" => $id_user) );
		
		return $this->montarLista($result);
	}
	
	/**
	 * Lista as pessoas que o user selecionado esta seguindo
	 */
	public function listFollowing( $id_user )
	{
		$sql  = 'select * ';
		$sql .= 'from follow ';
		$sql .= 'where id_follower = :id ';
	
		$result = $this->db->select( $sql, array("id" => $id_user) );
		
		return $this->montarLista($result);
	}
	
	/**
	 * Conta a quantidade de pessoas que o
	 * user logado esta seguindo
	 * @param unknown $id_pessoa
	 * @return unknown|number
	 */
	public function countFollowing( $id_user )
	{
		$sql  = 'select count( distinct id_user ) as total ';
		$sql .= 'from follow ';
		$sql .= 'where id_follower = :id';
	
		$result = $this->db->select( $sql, array("id" => $id_user) );
		return $result[0]['total'];
		
	}
	
	/**
	 * Retorna a quantia de followers
	 * @param unknown $id_pessoa
	 * @return unknown|number
	 */
	public function countFollowers( $id_user )
	{
		$sql  = 'select count( distinct id_follower ) as total ';
		$sql .= 'from following ';
		$sql .= 'where id_pessoa = :id ';
	
		$result = $this->db->select( $sql, array("id" => $id_user) );
		return $result[0]['total'];
	}
	
	
	/** 
	* Metodo listarFollow
	*/
	/*public function listarFollow()
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
	}*/

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
		$objFollower = new User_Model();
		$objFollower->obterUser( $row["id_follower"] );
		$this->setFollower( $objFollower );

		$objUser = new User_Model();
		$objUser->obterUser( $row["id_user"] );
		$this->setUser( $objUser );

		return $this;
	}
}
?>