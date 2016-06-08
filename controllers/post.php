<?php 

class Post extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Post";
		$this->view->listarPost = $this->model->listarPost();

		$this->view->render( "header" );
		$this->view->render( "post/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Post";
		$this->view->action = "create";
		$this->view->obj = $this->model;
		$this->view->array_category = array();
		
		require_once 'models/category_model.php';
		$objCategoria = new Category_Model();
		$this->view->listCategory = $objCategoria->listarCategory();
		
		if( $id ) 
		{
			$this->view->title = "Editar Post";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterPost( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
			
			// Monta o array com as categorias vinculadas ao post
			foreach ( $objCategoria->listCategoryByPost( $id ) as $category )
			{
				$this->view->array_category[] = $category->getId_category();
			}
		}

		$this->view->render( "header" );
		$this->view->render( "post/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$this->model->db->beginTransaction();
		
		/**
		 * Cadastra o post
		 * @var unknown
		 */
		$data = array(
			'title' 		=> $_POST["title"], 
			'content' 		=> $_POST["content"], 
			'status' 		=> $_POST["status"], 
		);

		if( !$id_post = $this->model->create( $data ) )
		{
			$this->model->db->rollBack();
			$msg = base64_encode( "OPERACAO_ERRO" );
			header("location: " . URL . "post?st=".$msg);
		}
		
		/**
		 * Cadastra as categorias do post
		 */
		foreach( $_POST['categoria'] as $id_categoria )
		{
			$data_category = array(
				'id_post'		=> $id_post,
				'id_category'	=> $id_categoria
			);
			
			if( !$this->model->db->insert( "post_category", $data_category, false ) )
			{
				$this->model->db->rollBack();
				$msg = base64_encode( "OPERACAO_ERRO" );
				header("location: " . URL . "post?st=".$msg);
			}
		}
		
		/**
		 * Realiza o commit e retorna a view
		 */
		$this->model->db->commit();
		$msg = base64_encode( "OPERACAO_SUCESSO" );
		header("location: " . URL . "post?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$this->model->db->beginTransaction();
		
		/**
		 * Edita os dados do post
		 * @var unknown
		 */
		$data = array(
			'title' 		=> $_POST["title"], 
			'content' 		=> $_POST["content"], 
			'status' 		=> $_POST["status"], 
		);

		if( !$this->model->edit( $data, $id ) )
		{
			$this->model->db->rollBack();
			$msg = base64_encode( "OPERACAO_ERRO" );
			header("location: " . URL . "post?st=".$msg."&erro=1");
		}
		
		/**
		 * Cadastra as categorias do post
		 */
		// Deleta todas as categorias vinculadas ao post
		$this->model->db->deleteComposityKey('post_category', "id_post = {$id}" );
		
		foreach( $_POST['categoria'] as $id_categoria )
		{
			$data_category = array(
				'id_post'		=> $id,
				'id_category'	=> $id_categoria
			);
			
			if( !$this->model->db->insert( "post_category", $data_category, false ) )
			{
				$this->model->db->rollBack();
				$msg = base64_encode( "OPERACAO_ERRO" );
				header( "location: " . URL . "post?st=".$msg."&erro=3" );
			}
		}
		
		/**
		 * Realiza o commit e retorna a view
		 */
		$this->model->db->commit();
		$msg = base64_encode( "OPERACAO_SUCESSO" );
		header("location: " . URL . "post?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "post?st=".$msg);
	}
}
