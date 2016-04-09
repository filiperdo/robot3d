<?php 

/** 
 * Classe Fpost
 * @author __ 
 *
 * Data: 09/04/2016
 */
class Fpost_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $fpost;
	private $views;
	private $content;
	private $date;
	private $user;
	private $ftopic;

	public function __construct()
	{
		parent::__construct();

		$this->id_fpost = '';
		$this->views = '';
		$this->content = '';
		$this->date = '';
		$this->id_user = '';
		$this->id_ftopic = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_fpost( $id_fpost )
	{
		$this->id_fpost = $id_fpost;
	}

	public function setViews( $views )
	{
		$this->views = $views;
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

	public function setId_ftopic( $id_ftopic )
	{
		$this->id_ftopic = $id_ftopic;
	}

	/** 
	* Metodos get's
	*/
	public function getId_fpost()
	{
		return $this->id_fpost;
	}

	public function getViews()
	{
		return $this->views;
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

	public function getId_ftopic()
	{
		return $this->id_ftopic;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "fpost", $data ) ){
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

		if( !$update = $this->db->update("fpost", $data, "id_fpost = {$id} ") ){
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

		if( !$delete = $this->db->delete("fpost", "id_fpost = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterFpost
	*/
	public function obterFpost( $id_fpost )
	{
		$sql  = "select * ";
		$sql .= "from fpost ";
		$sql .= "where id_fpost = :id ";

		$result = $this->db->select( $sql, array("id" => $id_fpost) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarFpost
	*/
	public function listarFpost()
	{
		$sql  = "select * ";
		$sql .= "from fpost ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_fpost like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_fpost( $row["id_fpost"] );
		$this->setViews( $row["views"] );
		$this->setContent( $row["content"] );
		$this->setDate( $row["date"] );
		$this->setId_user( $row["id_user"] );
		$this->setId_ftopic( $row["id_ftopic"] );

		return $this;
	}
}
?>