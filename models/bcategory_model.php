<?php 

/** 
 * Classe Bcategory
 * @author __ 
 *
 * Data: 09/04/2016
 */
class Bcategory_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $bcategory;
	private $name;

	public function __construct()
	{
		parent::__construct();

		$this->id_bcategory = '';
		$this->name = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_bcategory( $id_bcategory )
	{
		$this->id_bcategory = $id_bcategory;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	/** 
	* Metodos get's
	*/
	public function getId_bcategory()
	{
		return $this->id_bcategory;
	}

	public function getName()
	{
		return $this->name;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "bcategory", $data ) ){
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

		if( !$update = $this->db->update("bcategory", $data, "id_bcategory = {$id} ") ){
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

		if( !$delete = $this->db->delete("bcategory", "id_bcategory = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterBcategory
	*/
	public function obterBcategory( $id_bcategory )
	{
		$sql  = "select * ";
		$sql .= "from bcategory ";
		$sql .= "where id_bcategory = :id ";

		$result = $this->db->select( $sql, array("id" => $id_bcategory) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarBcategory
	*/
	public function listarBcategory()
	{
		$sql  = "select * ";
		$sql .= "from bcategory ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_bcategory like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_bcategory( $row["id_bcategory"] );
		$this->setName( $row["name"] );

		return $this;
	}
}
?>