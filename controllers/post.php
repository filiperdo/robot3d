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

		if( $id ) 
		{
			$this->view->title = "Editar Post";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterPost( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
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
		$data = array(
			'title' => $_POST["title"], 
			'content' => $_POST["content"], 
			'date' => $_POST["date"], 
			'views' => $_POST["views"], 
			'status' => $_POST["status"], 
			'id_comment' => $_POST["id_comment"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "post?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'title' => $_POST["title"], 
			'content' => $_POST["content"], 
			'date' => $_POST["date"], 
			'views' => $_POST["views"], 
			'status' => $_POST["status"], 
			'id_comment' => $_POST["id_comment"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

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
