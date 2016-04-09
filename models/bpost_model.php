<?php 

/** 
 * Classe Bpost
 * @author __ 
 *
 * Data: 09/04/2016
 */
class Bpost_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $bpost;
	private $title;
	private $content;
	private $date;
	private $views;
	private $status;
	private $bcomment;
	private $bcategory;

	public function __construct()
	{
		parent::__construct();

		$this->id_bpost = '';
		$this->title = '';
		$this->content = '';
		$this->date = '';
		$this->views = '';
		$this->status = '';
		$this->id_bcomment = '';
		$this->id_bcategory = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_bpost( $id_bpost )
	{
		$this->id_bpost = $id_bpost;
	}

	public function setTitle( $title )
	{
		$this->title = $title;
	}

	public function setContent( $content )
	{
		$this->content = $content;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	public function setViews( $views )
	{
		$this->views = $views;
	}

	public function setStatus( $status )
	{
		$this->status = $status;
	}

	public function setId_bcomment( $id_bcomment )
	{
		$this->id_bcomment = $id_bcomment;
	}

	public function setId_bcategory( $id_bcategory )
	{
		$this->id_bcategory = $id_bcategory;
	}

	/** 
	* Metodos get's
	*/
	public function getId_bpost()
	{
		return $this->id_bpost;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getViews()
	{
		return $this->views;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getId_bcomment()
	{
		return $this->id_bcomment;
	}

	public function getId_bcategory()
	{
		return $this->id_bcategory;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "bpost", $data ) ){
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

		if( !$update = $this->db->update("bpost", $data, "id_bpost = {$id} ") ){
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

		if( !$delete = $this->db->delete("bpost", "id_bpost = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterBpost
	*/
	public function obterBpost( $id_bpost )
	{
		$sql  = "select * ";
		$sql .= "from bpost ";
		$sql .= "where id_bpost = :id ";

		$result = $this->db->select( $sql, array("id" => $id_bpost) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarBpost
	*/
	public function listarBpost()
	{
		$sql  = "select * ";
		$sql .= "from bpost ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_bpost like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_bpost( $row["id_bpost"] );
		$this->setTitle( $row["title"] );
		$this->setContent( $row["content"] );
		$this->setDate( $row["date"] );
		$this->setViews( $row["views"] );
		$this->setStatus( $row["status"] );
		$this->setId_bcomment( $row["id_bcomment"] );
		$this->setId_bcategory( $row["id_bcategory"] );

		return $this;
	}
}
?>