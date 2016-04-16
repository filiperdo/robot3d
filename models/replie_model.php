<?php 

/** 
 * Classe Replie
 * @author __ 
 *
 * Data: 16/04/2016
 */
class Replie_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_replie;
	private $content;
	private $date;
	private $item;
	private $replie_id_replie;
	private $user;

	public function __construct()
	{
		parent::__construct();

		$this->id_replie = '';
		$this->content = '';
		$this->date = '';
		$this->item = new Item_Model();
		$this->replie_id_replie = '';
		$this->user = new User_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setId_replie( $id_replie )
	{
		$this->id_replie = $id_replie;
	}

	public function setContent( $content )
	{
		$this->content = $content;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	public function setItem( Item_Model $item )
	{
		$this->item = $item;
	}

	public function setReplie_id_replie( $replie_id_replie )
	{
		$this->replie_id_replie = $replie_id_replie;
	}

	public function setUser( User_Model $user )
	{
		$this->user = $user;
	}

	/** 
	* Metodos get's
	*/
	public function getReplie()
	{
		return $this->replie;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getItem()
	{
		return $this->item;
	}

	public function getReplie_id_replie()
	{
		return $this->replie_id_replie;
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

		if( !$id = $this->db->insert( "replie", $data ) ){
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

		if( !$update = $this->db->update("replie", $data, "id_replie = {$id} ") ){
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

		if( !$delete = $this->db->delete("replie", "id_replie = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterReplie
	*/
	public function obterReplie( $id_replie )
	{
		$sql  = "select * ";
		$sql .= "from replie ";
		$sql .= "where id_replie = :id ";

		$result = $this->db->select( $sql, array("id" => $id_replie) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarReplie
	*/
	public function listarReplie()
	{
		$sql  = "select * ";
		$sql .= "from replie ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_replie like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_replie( $row["id_replie"] );
		$this->setContent( $row["content"] );
		$this->setDate( $row["date"] );

		$objItem = new Item_Model();
		$objItem->obterItem( $row["id_item"] );
		$this->setItem( $objItem );
		$this->setReplie_id_replie( $row["replie_id_replie"] );

		$objUser = new User_Model();
		$objUser->obterUser( $row["id_user"] );
		$this->setUser( $objUser );

		return $this;
	}
}
?>