<?php 

class Replie extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Replie";
		$this->view->listarReplie = $this->model->listarReplie();

		$this->view->render( "header" );
		$this->view->render( "replie/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Replie";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Replie";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterReplie( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "replie/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'id_replie' => $_POST["id_replie"], 
			'content' => $_POST["content"], 
			'date' => $_POST["date"], 
			'id_item' => $_POST["id_item"], 
			'replie_id_replie' => $_POST["replie_id_replie"], 
			'id_user' => $_POST["id_user"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "replie?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			"id_replie" 	=> $id,
			'id_replie' => $_POST["id_replie"], 
			'content' => $_POST["content"], 
			'date' => $_POST["date"], 
			'id_item' => $_POST["id_item"], 
			'replie_id_replie' => $_POST["replie_id_replie"], 
			'id_user' => $_POST["id_user"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "replie?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "replie?st=".$msg);
	}
}
