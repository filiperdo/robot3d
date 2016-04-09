<?php 

/** 
 * Classe Ftopic
 * @author __ 
 *
 * Data: 09/04/2016
 */
class Ftopic_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $ftopic;
	private $name;
	private $description;
	private $fcategory;

	public function __construct()
	{
		parent::__construct();

		$this->id_ftopic = '';
		$this->name = '';
		$this->description = '';
		$this->id_fcategory = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_ftopic( $id_ftopic )
	{
		$this->id_ftopic = $id_ftopic;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setDescription( $description )
	{
		$this->description = $description;
	}

	public function setId_fcategory( $id_fcategory )
	{
		$this->id_fcategory = $id_fcategory;
	}

	/** 
	* Metodos get's
	*/
	public function getId_ftopic()
	{
		return $this->id_ftopic;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getId_fcategory()
	{
		return $this->id_fcategory;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "ftopic", $data ) ){
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

		if( !$update = $this->db->update("ftopic", $data, "id_ftopic = {$id} ") ){
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

		if( !$delete = $this->db->delete("ftopic", "id_ftopic = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterFtopic
	*/
	public function obterFtopic( $id_ftopic )
	{
		$sql  = "select * ";
		$sql .= "from ftopic ";
		$sql .= "where id_ftopic = :id ";

		$result = $this->db->select( $sql, array("id" => $id_ftopic) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarFtopic
	*/
	public function listarFtopic()
	{
		$sql  = "select * ";
		$sql .= "from ftopic ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_ftopic like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_ftopic( $row["id_ftopic"] );
		$this->setName( $row["name"] );
		$this->setDescription( $row["description"] );
		$this->setId_fcategory( $row["id_fcategory"] );

		return $this;
	}
}
?>