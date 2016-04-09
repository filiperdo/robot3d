<?php 

/** 
 * Classe Bcomment
 * @author __ 
 *
 * Data: 09/04/2016
 */
class Bcomment_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $bcomment;
	private $content;
	private $date;
	private $user;

	public function __construct()
	{
		parent::__construct();

		$this->id_bcomment = '';
		$this->content = '';
		$this->date = '';
		$this->id_user = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_bcomment( $id_bcomment )
	{
		$this->id_bcomment = $id_bcomment;
	}

	public function setContent( $content )
	{
		$this->content = $content;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	public function setId_user( $id_user )
	{
		$this->id_user = $id_user;
	}

	/** 
	* Metodos get's
	*/
	public function getId_bcomment()
	{
		return $this->id_bcomment;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getDate()
	{
		return $this->date;
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

		if( !$id = $this->db->insert( "bcomment", $data ) ){
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

		if( !$update = $this->db->update("bcomment", $data, "id_bcomment = {$id} ") ){
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

		if( !$delete = $this->db->delete("bcomment", "id_bcomment = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterBcomment
	*/
	public function obterBcomment( $id_bcomment )
	{
		$sql  = "select * ";
		$sql .= "from bcomment ";
		$sql .= "where id_bcomment = :id ";

		$result = $this->db->select( $sql, array("id" => $id_bcomment) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarBcomment
	*/
	public function listarBcomment()
	{
		$sql  = "select * ";
		$sql .= "from bcomment ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_bcomment like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_bcomment( $row["id_bcomment"] );
		$this->setContent( $row["content"] );
		$this->setDate( $row["date"] );
		$this->setId_user( $row["id_user"] );

		return $this;
	}
}
?>