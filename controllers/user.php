<?php 

class User extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "User";
		$this->view->listarUser = $this->model->listarUser();

		$this->view->render( "header" );
		$this->view->render( "user/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar User";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar User";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterUser( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "user/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'id_user' => $_POST["id_user"], 
			'name' => $_POST["name"], 
			'login' => $_POST["login"], 
			'password' => $_POST["password"], 
			'email' => $_POST["email"], 
			'website' => $_POST["website"], 
			'bio' => $_POST["bio"], 
			'num_login' => $_POST["num_login"], 
			'date' => $_POST["date"], 
			'linguage' => $_POST["linguage"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "user?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			"id_user" 	=> $id,
			'id_user' => $_POST["id_user"], 
			'name' => $_POST["name"], 
			'login' => $_POST["login"], 
			'password' => $_POST["password"], 
			'email' => $_POST["email"], 
			'website' => $_POST["website"], 
			'bio' => $_POST["bio"], 
			'num_login' => $_POST["num_login"], 
			'date' => $_POST["date"], 
			'linguage' => $_POST["linguage"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "user?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "user?st=".$msg);
	}
}
