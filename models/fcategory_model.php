<?php 

/** 
 * Classe Fcategory
 * @author __ 
 *
 * Data: 09/04/2016
 */
class Fcategory_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $fcategory;
	private $name;

	public function __construct()
	{
		parent::__construct();

		$this->id_fcategory = '';
		$this->name = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_fcategory( $id_fcategory )
	{
		$this->id_fcategory = $id_fcategory;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	/** 
	* Metodos get's
	*/
	public function getId_fcategory()
	{
		return $this->id_fcategory;
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

		if( !$id = $this->db->insert( "fcategory", $data ) ){
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

		if( !$update = $this->db->update("fcategory", $data, "id_fcategory = {$id} ") ){
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

		if( !$delete = $this->db->delete("fcategory", "id_fcategory = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterFcategory
	*/
	public function obterFcategory( $id_fcategory )
	{
		$sql  = "select * ";
		$sql .= "from fcategory ";
		$sql .= "where id_fcategory = :id ";

		$result = $this->db->select( $sql, array("id" => $id_fcategory) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarFcategory
	*/
	public function listarFcategory()
	{
		$sql  = "select * ";
		$sql .= "from fcategory ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_fcategory like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_fcategory( $row["id_fcategory"] );
		$this->setName( $row["name"] );

		return $this;
	}
}
?>