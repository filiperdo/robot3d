<?php 

/** 
 * Classe Follow
 * @author __ 
 *
 * Data: 09/04/2016
 */
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

		$this->id_follower = '';
		$this->id_user = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_follower( $id_follower )
	{
		$this->id_follower = $id_follower;
	}

	public function setId_user( $id_user )
	{
		$this->id_user = $id_user;
	}

	/** 
	* Metodos get's
	*/
	public function getId_follower()
	{
		return $this->id_follower;
	}

	public function getId_user()
	{
		return $this->id_user;
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
		$this->setId_follower( $row["id_follower"] );
		$this->setId_user( $row["id_user"] );

		return $this;
	}
}
?>