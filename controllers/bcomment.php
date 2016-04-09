<?php 

class Bcomment extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Bcomment";
		$this->view->listarBcomment = $this->model->listarBcomment();

		$this->view->render( "header" );
		$this->view->render( "bcomment/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Bcomment";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Bcomment";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterBcomment( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "bcomment/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'id_bcomment' => $_POST["id_bcomment"], 
			'content' => $_POST["content"], 
			'date' => $_POST["date"], 
			'id_user' => $_POST["id_user"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "bcomment?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			"id_bcomment" 	=> $id,
			'id_bcomment' => $_POST["id_bcomment"], 
			'content' => $_POST["content"], 
			'date' => $_POST["date"], 
			'id_user' => $_POST["id_user"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "bcomment?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "bcomment?st=".$msg);
	}
}
