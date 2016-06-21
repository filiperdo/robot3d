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

	public function dashboard( $id )
	{
		$this->view->title = "Dashboard";
		
		$this->view->obj = $this->model->obterUser( base64_decode( $id ) );
		
		$this->view->render( "header.inc" );
		$this->view->render( "user/dashboard" );
		$this->view->render( "footer.inc" );
	}
	
	public function testeEmail( $email )
	{
		$this->model->checkUserExisting( trim( $email ) );
	}
	
	/** 
	* Metodo create
	*/
	public function create()
	{
		/**
		 * Verifica a formatacao do email
		 * Configura os dados de cadastro em uma sessao para retornar a view de cadastro
		 */
		if( filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) === false )
		{
			Session::init();
				
			foreach( $_POST as $key => $valor )
				Session::set('post_' . $key, $valor);
					
			$msg = base64_encode( 'EMAIL_ERRO_FORMATO' );
			header("location: " . URL . "login/register/?st=".$msg);
			exit();
		}
		
		/**
		 * Verifica se o email ja exite
		 * Configura os dados de cadastro em uma sessao para retornar a view de cadastro
		 */
		if( $this->model->checkUserExisting( trim( $_POST['email'] ) ) )
		{
			Session::init();
			
			foreach( $_POST as $key => $valor )
				Session::set('post_' . $key, $valor);
			
			$msg = base64_encode( 'LOGIN_ERRO' );
			header("location: " . URL . "login/register/?st=".$msg);
			exit();
		}
		
		$token = 'abc';
		
		$data = array(
			'login' 		=> $_POST["login"], 
			'password' 		=> $_POST["password"], 
			'email' 		=> $_POST["email"], 
			'linguage' 		=> 'PT',
			'id_typeuser' 	=> 1, // Membro
			'status' 		=> 'INACTIVE',
			'token'			=> $token
		);

		$this->model->create( $data ) ? $msg = base64_encode( "CADASTRO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );
		
		/**
		 * Envia um e-mail de validação
		 =-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=- */
		require_once 'util/email.class.php';
		$objEmail = new Email();
		$objEmail->enviarValidacaoCadastro( $_POST["login"], $_POST["email"], $token );
		// =-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
		
		header("location: " . URL . "login?st=".$msg);
		exit();
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
