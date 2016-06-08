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

	public function dashboard()
	{
		$this->view->title = "Dashboard";
		
		$this->view->render( "header.inc" );
		$this->view->render( "col-left" );
		$this->view->render( "user/dashboard" );
		$this->view->render( "footer.inc" );
	}
	
	/** 
	* Metodo create
	*/
	public function create()
	{
		
		// VERIFICAR SE LOGIN JA EXISTE NO BANCO DE DADOS
		
		$data = array(
			//'name' 			=> $_POST["name"], 
			'login' 		=> $_POST["login"], 
			'password' 		=> $_POST["password"], 
			'email' 		=> $_POST["email"], 
			//'website' 		=> $_POST["website"], 
			//'bio' 			=> $_POST["bio"], 
			//'numlogin' 		=> $_POST["numlogin"], 
			//'date' 			=> $_POST["date"], 
			'linguage' 		=> 'PT', 
			'id_typeuser' 	=> 1, // Membro
			//'lastlogin' 	=> $_POST["lastlogin"], 
			'status' 		=> 'ACTIVE',
		);

		$this->model->create( $data ) ? $msg = base64_encode( "CADASTRO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "login?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'name' 				=> $_POST["name"], 
			'login' 			=> $_POST["login"], 
			'password' 			=> $_POST["password"], 
			'email' 			=> $_POST["email"], 
			'website' 			=> $_POST["website"], 
			'bio' 				=> $_POST["bio"], 
			'numlogin' 			=> $_POST["numlogin"], 
			'date' 				=> $_POST["date"], 
			'linguage' 			=> $_POST["linguage"], 
			'id_typeuser' 		=> $_POST["id_typeuser"], 
			'lastlogin' 		=> $_POST["lastlogin"], 
			'status' 			=> $_POST["status"], 
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
