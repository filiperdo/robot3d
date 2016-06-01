<?php 

/** 
 * Classe Post
 * @author __ 
 *
 * Data: 01/06/2016
 */ 

include_once 'comment_model.php';

class Post_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_post;
	private $title;
	private $content;
	private $date;
	private $views;
	private $status;
	private $comment;

	public function __construct()
	{
		parent::__construct();

		$this->id_post = '';
		$this->title = '';
		$this->content = '';
		$this->date = '';
		$this->views = '';
		$this->status = '';
		$this->comment = new Comment_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setId_post( $id_post )
	{
		$this->id_post = $id_post;
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

	public function setComment( Comment_Model $comment )
	{
		$this->comment = $comment;
	}

	/** 
	* Metodos get's
	*/
	public function getId_post()
	{
		return $this->id_post;
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

	public function getComment()
	{
		return $this->comment;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "post", $data ) ){
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

		if( !$update = $this->db->update("post", $data, "id_post = {$id} ") ){
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

		if( !$delete = $this->db->delete("post", "id_post = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterPost
	*/
	public function obterPost( $id_post )
	{
		$sql  = "select * ";
		$sql .= "from post ";
		$sql .= "where id_post = :id ";

		$result = $this->db->select( $sql, array("id" => $id_post) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarPost
	*/
	public function listarPost()
	{
		$sql  = "select * ";
		$sql .= "from post ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_post like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_post( $row["id_post"] );
		$this->setTitle( $row["title"] );
		$this->setContent( $row["content"] );
		$this->setDate( $row["date"] );
		$this->setViews( $row["views"] );
		$this->setStatus( $row["status"] );

		$objComment = new Comment_Model();
		$objComment->obterComment( $row["id_comment"] );
		$this->setComment( $objComment );

		return $this;
	}
}
?>