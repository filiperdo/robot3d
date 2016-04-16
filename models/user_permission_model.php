<?php 

/** 
 * Classe User_permission
 * @author __ 
 *
 * Data: 16/04/2016
 */
class User_permission_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $user;
	private $permission;

	public function __construct()
	{
		parent::__construct();

		$this->user = new User_Model();
		$this->permission = new Permission_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setUser( User_Model $user )
	{
		$this->user = $user;
	}

	public function setPermission( Permission_Model $permission )
	{
		$this->permission = $permission;
	}

	/** 
	* Metodos get's
	*/
	public function getUser()
	{
		return $this->user;
	}

	public function getPermission()
	{
		return $this->permission;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "user_permission", $data ) ){
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

		if( !$update = $this->db->update("user_permission", $data, "id_user_permission = {$id} ") ){
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

		if( !$delete = $this->db->delete("user_permission", "id_user_permission = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterUser_permission
	*/
	public function obterUser_permission( $id_user_permission )
	{
		$sql  = "select * ";
		$sql .= "from user_permission ";
		$sql .= "where id_user_permission = :id ";

		$result = $this->db->select( $sql, array("id" => $id_user_permission) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarUser_permission
	*/
	public function listarUser_permission()
	{
		$sql  = "select * ";
		$sql .= "from user_permission ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_user_permission like :id "; // Configurar o like com o campo necessario da tabela 
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

		$objUser = new User_Model();
		$objUser->obterUser( $row["id_user"] );
		$this->setUser( $objUser );

		$objPermission = new Permission_Model();
		$objPermission->obterPermission( $row["id_permission"] );
		$this->setPermission( $objPermission );

		return $this;
	}
}
?>