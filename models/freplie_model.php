<?php 

/** 
 * Classe Freplie
 * @author __ 
 *
 * Data: 09/04/2016
 */
class Freplie_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $freplie;
	private $content;
	private $fpost;
	private $freplie_id_freplie;

	public function __construct()
	{
		parent::__construct();

		$this->id_freplie = '';
		$this->content = '';
		$this->id_fpost = '';
		$this->freplie_id_freplie = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_freplie( $id_freplie )
	{
		$this->id_freplie = $id_freplie;
	}

	public function setContent( $content )
	{
		$this->content = $content;
	}

	public function setId_fpost( $id_fpost )
	{
		$this->id_fpost = $id_fpost;
	}

	public function setFreplie_id_freplie( $freplie_id_freplie )
	{
		$this->freplie_id_freplie = $freplie_id_freplie;
	}

	/** 
	* Metodos get's
	*/
	public function getId_freplie()
	{
		return $this->id_freplie;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getId_fpost()
	{
		return $this->id_fpost;
	}

	public function getFreplie_id_freplie()
	{
		return $this->freplie_id_freplie;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "freplie", $data ) ){
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

		if( !$update = $this->db->update("freplie", $data, "id_freplie = {$id} ") ){
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

		if( !$delete = $this->db->delete("freplie", "id_freplie = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterFreplie
	*/
	public function obterFreplie( $id_freplie )
	{
		$sql  = "select * ";
		$sql .= "from freplie ";
		$sql .= "where id_freplie = :id ";

		$result = $this->db->select( $sql, array("id" => $id_freplie) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarFreplie
	*/
	public function listarFreplie()
	{
		$sql  = "select * ";
		$sql .= "from freplie ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_freplie like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_freplie( $row["id_freplie"] );
		$this->setContent( $row["content"] );
		$this->setId_fpost( $row["id_fpost"] );
		$this->setFreplie_id_freplie( $row["freplie_id_freplie"] );

		return $this;
	}
}
?>