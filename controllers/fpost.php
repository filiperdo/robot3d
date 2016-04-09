<?php 

class Fpost extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Fpost";
		$this->view->listarFpost = $this->model->listarFpost();

		$this->view->render( "header" );
		$this->view->render( "fpost/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Fpost";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Fpost";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterFpost( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "fpost/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'id_fpost' => $_POST["id_fpost"], 
			'views' => $_POST["views"], 
			'content' => $_POST["content"], 
			'date' => $_POST["date"], 
			'id_user' => $_POST["id_user"], 
			'id_ftopic' => $_POST["id_ftopic"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "fpost?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			"id_fpost" 	=> $id,
			'id_fpost' => $_POST["id_fpost"], 
			'views' => $_POST["views"], 
			'content' => $_POST["content"], 
			'date' => $_POST["date"], 
			'id_user' => $_POST["id_user"], 
			'id_ftopic' => $_POST["id_ftopic"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "fpost?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "fpost?st=".$msg);
	}
}
