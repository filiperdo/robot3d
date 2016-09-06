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
	public function dashboard( $id )
	{
		$this->view->title = "Dashboard";
		
		require_once 'models/project_model.php';
		$objProject = new Project_Model();
		
		$this->view->listProject = $objProject->listarProjectByUser( base64_decode( $id ) );
		
		$this->view->obj = $this->model->obterUser( base64_decode( $id ) );
		
		$this->view->render( "header.inc" );
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
		$data = array(
			'name' 				=> $_POST["name"], 
			'email' 			=> $_POST["email"], 
			'website' 			=> $_POST["website"], 
			'bio' 				=> $_POST["bio"], 
			'linguage' 			=> $_POST["linguage"],
			'github' 			=> $_POST["github"]
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
		
		$allowedExts = array(".gif", ".jpeg", ".jpg", ".png");
		
		// Verifica a acao para pegar a variavel do path correta
		Session::get('act_post') == 'create' ? $var_path = Session::get('path_post') : $var_path = Session::get('path_edit_post');
		
		$dir = 'public/img/user/'. Session::get('userid') .'/';
		
		for($i = 0; $i < count($tmp_name); $i++)
		{
			$ext = strtolower(substr($name[$i],-4));
				
			if(in_array($ext, $allowedExts))
			{
				$new_name = strtolower( PREFIX_SESSION ).date('Ymd_his').'_'.$name[$i];
		
				// cria a img default =========================================
				$image = WideImage::load( $tmp_name[$i] );
				$image = $image->resize(600, 600, 'inside');
				//$image = $image->crop('center', 'center', 170, 180);
		
				// verifica so o diretorio existe
				// caso contrario, criamos o diretorio com permissao para escrita
				if( !is_dir( $dir ) )
					mkdir( $dir, 0777);
		
				$image->saveToFile( $dir . $new_name );
	
				// cria a img thumb ==========================================
				$image_thumb = WideImage::load( $tmp_name[$i] );
				$image_thumb = $image_thumb->resize(170, 170, 'outside');
				$image_thumb = $image_thumb->crop('center', 'center', 170, 170);
	
				$dir_thumb = $dir.'thumb/';
				
				// verifica so o diretorio existe
				// caso contrario, criamos o diretorio com permissao para escrita
				if( !is_dir( $dir_thumb ) )
					mkdir( $dir_thumb, 0777);
	
				$image_thumb->saveToFile( $dir_thumb . $new_name );
			}
		}
		
		//echo 'ok';
	}
	
	public function delete_fotoperfil()
	{
		Session::init();
		$dir = 'public/img/user/'. Session::get('userid') .'/';
		
		// Varre a pasta apagando os arquivos
		foreach( glob( $dir . "/*.*" ) as $foto )
		{
			if( file_exists( $foto ) )
			{
				unlink( $foto );
				//echo 'Removeu ' . $foto.'<br>';
			}
		}
		 
		// Remove o diretorio
		if( is_dir( $dir ) )
			rmdir( $dir );
		
		header('Location: ' . URL . 'user/form/' . base64_encode( Session::get('userid') ));
		//echo 'deletou diretorio : ' . $dir;
	}
	
}
