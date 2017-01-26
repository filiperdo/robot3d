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

	public function whotofollow()
	{
		$this->view->title = "User";
		$this->view->listarUser = $this->model->listarUser();

		//$this->view->js[] = 'whotofollow.js';

		$this->view->render( "header.inc" );
		$this->view->render( "col-left" );
		$this->view->render( "user/list" );
		$this->view->render( "col-right" );
		$this->view->render( "footer.inc" );
	}

	public function listTest()
	{
		$this->model->listarUserTeste('json');
	}

	/*
	public function listTopWhoToFollow($limit)
	{
		$this->model->listTopWhoToFollow($limit);
	}*/

	/**
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		Session::init();

		$this->view->title = "Cadastrar User";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id )
		{
			$id = base64_decode($id);
			if( Session::get('userid') != $id )
			{
				// verifica se e diferente para impedir que alguem altere os dados de outro user
				header('Location: ' . URL );
			}

			$this->view->title = "Editar User";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterUser( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header.inc" );
		$this->view->render( "col-left" );
		$this->view->render( "user/form" );
		$this->view->render( "footer.inc" );
	}

	/**
	 * Metodo dashboard
	 * @param unknown $id
	 */
	public function dashboard( $login )
	{
		$this->view->title = "Dashboard";

		require_once 'models/project_model.php';
		$objProject = new Project_Model();

		$this->view->obj = $this->model->obterUserByLogin( $login );

		$this->view->listProject = $objProject->listarProjectByUser( $this->model->getId_user() );

		require_once 'models/follow_model.php';
		$this->view->follow = new Follow_Model();

		$this->view->render( "header.inc" );
		//$this->view->render( "col-left" );
		$this->view->render( "user/dashboard" );
		$this->view->render( "footer.inc" );
	}

	/**
	 * Metodo activate
	 * Responsavel por efetivar a ativacao do login
	 * @param unknown $token
	 */
	public function activate( $token )
	{
		$objUser = $this->model->obterUserByToken( $token );

		$data = array(
			'status' => 'ACTIVE'
		);

		$this->model->edit( $data, $objUser->getId_user() ) ? $msg = base64_encode( "CADATRO_ATIVADO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "login/?st=".$msg);
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
		 * Inicio Recaptcha
		 */
		$url_test = "https://www.google.com/recaptcha/api/siteverify";
		$private_key = "6LfdryUTAAAAAKZvVxny-vvA-7GeSlorCYlqOayG";

		$response = file_get_contents($url_test."?secret=".$private_key."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);

		$data = json_decode( $response );

		if( $data->success == false )
		{
			Session::init();

			foreach( $_POST as $key => $valor )
				Session::set('post_' . $key, $valor);

			$msg = base64_encode( 'RECAPTCHA_INCORRETO' );
			header("location: " . URL . "login/register/?st=".$msg);
			exit();
		}
		// =-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
		// =-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-


		/**
		 * Verifica se o formato do email e um formato valido
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

		// gera o token com a funcao uniqid
		// isto irá criar um identificador de 32 caracteres
		$token = md5(uniqid(rand(), true));

		$data = array(
			'login' 		=> $_POST["login"],
			'password' 		=> $_POST["password"],
			'email' 		=> $_POST["email"],
			'date'			=> date('Y-m-d H:i:s'),
			'linguage' 		=> 'PT',
			'id_typeuser' 	=> 1, // Membro
			'status' 		=> 'INACTIVE',
			'token'			=> $token
		);

		$this->model->create( $data ) ? $msg = base64_encode( "CADASTRO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		/**
		 * Envia um e-mail de validação
		 */
		require_once 'util/email.class.php';
		$objEmail = new Email();
		$objEmail->enviarValidacaoCadastro( $_POST["login"], $_POST["email"], $token );
		// =-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

		//header("location: " . URL . "login?st=".$msg);
		echo "<script>window.location='".URL."login?st=". $msg ."'</script>";
		exit();
	}

	/**
	* Metodo edit
	*/
	public function edit( $id )
	{
		$this->model->obterUser($id);

		if(isset($_POST['password']))
		{
			if( strlen($_POST['password']) < 6 || strlen($_POST['password']) > 12 )
			{
				$id = base64_encode($id);
				$msg = base64_encode( "ERRO_TAMANHO_SENHA" );
				header("location: " . URL . "user/form/{$id}/?st=".$msg);
				exit();
			}
		}


		$data = array(
			'name' 				=> $_POST["name"],
			'email' 			=> $_POST["email"],
			'password'			=> isset($_POST['password']) ? $_POST['password'] : $this->model->getPassword(),
			'bio' 				=> $_POST["bio"],
			'linguage' 			=> $_POST["linguage"],
			'website' 			=> $_POST["website"],
			'github' 			=> $_POST["github"],
			'facebook' 			=> $_POST["facebook"],
			'twitter' 			=> $_POST["twitter"],
			'youtube' 			=> $_POST["youtube"]

		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		$id = base64_encode($id);

		header("location: " . URL . "user/form/{$id}/?st=".$msg);
	}

	public function editPass( $id )
	{
		// verificar o pass antigo
		// verificar o pess novo e sua confirmacao
	}

	/**
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "user?st=".$msg);
	}

	/**
	 * Metodo upload_fotoperfil
	 * Responsavel por fazer o upload da imagem do perfil do user
	 */
	public function upload_fotoperfil()
	{
		Session::init();

		require_once 'util/wideimage/WideImage.php';

		date_default_timezone_set("Brazil/East");

		$name 	= $_FILES['fileUpload']['name'];
		$tmp_name = $_FILES['fileUpload']['tmp_name'];

		$allowedExts = array(".gif", ".jpeg", ".jpg", ".png"); // passar para o config

		// Verifica a acao para pegar a variavel do path correta
		Session::get('act_post') == 'create' ? $var_path = Session::get('path_post') : $var_path = Session::get('path_edit_post');

		$path = 'public/img/user/'. strtolower( PREFIX_SESSION ).date('Ymd_his').'-'.Session::get('userid') .'/';

		// Edita o campo path no banco
		$this->model->edit( ['path' => $path], Session::get('userid') );

		$ext = strtolower(substr($name[0],-4));

		if(in_array($ext, $allowedExts))
		{
			$new_name = 'foto-perfil.jpg';
			$image = WideImage::load( $tmp_name[0] );
			$image = $image->resize(350, 350, 'inside');
			$image = $image->crop('center', 'center', 350, 350);

			if( !is_dir( $path ) )
				mkdir( $path, 0777, true);

			$image->saveToFile( $path . $new_name, 60 );

		}
		//echo 'ok';
	}

	public function delete_fotoperfil()
	{
		Session::init();
		$this->model->obterUser(Session::get('userid'));

		// Varre a pasta apagando os arquivos
		foreach( glob( $this->model->getPath() . "/*.*" ) as $foto )
		{
			if( file_exists( $foto ) )
			{
				unlink( $foto );
				//echo 'Removeu ' . $foto.'<br>';
			}
		}

		// Remove o diretorio
		if( is_dir( $this->model->getPath() ) )
			rmdir( $this->model->getPath() );

		header('Location: ' . URL . 'user/form/' . base64_encode( Session::get('userid') ));
		//echo 'deletou diretorio : ' . $dir;
	}

}
