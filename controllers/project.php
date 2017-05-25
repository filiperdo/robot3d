<?php

class Project extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/**
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Project";
		$this->view->listarProject = $this->model->listarProject();

		require_once 'models/datalog_model.php';
		$this->view->datalog = new Datalog_Model();

		require_once 'models/comment_model.php';
		$this->view->comment = new Comment_Model();

		$this->view->render( "header.inc" );
		$this->view->render( "project/index" );
		$this->view->render( "col-right" );
		$this->view->render( "footer.inc" );
	}

	public function lista()
	{
		$this->view->title = "Project";
		$this->view->listarProject = $this->model->listarProject();

		$this->view->render( "header" );
		$this->view->render( "project/lista" );
		$this->view->render( "footer" );
	}

	/**
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		Session::init();

		$this->view->title = "Cadastrar Project";
		$this->view->action = "create";
		$this->view->obj = $this->model;
		$this->view->js[] = 'clipboard.min.js';
		$this->view->method_upload = URL . 'project/wideimage_ajax/';

		if( $id == NULL )
		{
			if( !Session::get('path_post') )
			{
				Session::set( 'path_post', 'img_post_' . date('Ymd_his') );
			}
			Session::set('act_post', 'create');
			$this->view->path = Session::get('path_post');
		}
		else
		{
			$this->view->idtab = isset( $_GET['idTab'] ) ? $_GET['idTab'] : 1;

			$this->view->title = "Editar Project";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterProject( $id );
			$this->view->path = $this->view->obj->getPath();

			require_once 'models/component_model.php';
			$this->view->component = new Component_Model();

			Session::set( 'path_edit_post', $this->view->obj->getPath() );
			Session::set('act_post', 'edit');

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		// debug
 		if( Session::get('act_post') == 'create' )
 			$this->view->title = 'Session: ' . Session::get('act_post').': '.Session::get('path_post');
		else
 			$this->view->title = 'Session: ' . Session::get('act_post').': '.Session::get('path_edit_post');
		// end debug -------------------------------------

		$this->view->render( "header.inc" );
		$this->view->render( "col-left" );
		$this->view->render( "project/form" );
		$this->view->render( "footer.inc" );
	}

	public function detail( $id_project )
	{
		$this->view->obj = $this->model->obterProject( $id_project );

		require_once 'models/component_model.php';
		$this->view->objComponent = new Component_Model();

		include_once 'models/follow_model.php';
		$this->view->follow = new Follow_Model();

		// Inicio Data log
		// ------------------------------------------------------------
		require_once 'models/datalog_model.php';
		$objDataLog = new Datalog_Model();

		// Configura as variaveis para efetuar a pesquisa do log
		$dados = array( 'id' => $id_project, 'ip' => $_SERVER["REMOTE_ADDR"], 'type' => 'id_project' );

		// Verifica se ja existe o log especifico
		if(!$objDataLog->getDataLog($dados))
		{
			// configura o id do item correto do log
			$dados['id_project'] = $id_project;
			$result = $objDataLog->create($dados);
		}
		// ------------------------------------------------------------
		// Fim datalog

		// configura os dados para compartilhamento no facebook
		$this->view->meta_facebook = array(
			'url' 			=> URL . 'project/detail/' . $id_project,
			'type'			=> 'post',
			'title'			=> $this->view->obj->getTitle(),
			'description'	=> substr(strip_tags( $this->view->obj->getSummary() ), 0, 150)."...",
			'image'			=> URL . 'public/img/project/' . $this->view->obj->getPath() .'/' . $this->view->obj->getMainpicture()
		);

		$this->view->render( "header.inc" );
		$this->view->render( "project/detail" );
		//$this->view->render( "col-right" );
		$this->view->render( "footer.inc" );
	}

	/**
	* Metodo create
	*/
	public function create()
	{
		Session::init();

		$this->model->db->beginTransaction();

		// Fazer upload da foto
		require_once 'util/wideimage/WideImage.php';

		$name_img = $_FILES['photo_project']['name'];
		$tmp_name = $_FILES['photo_project']['tmp_name'];
		$ext = strtolower(substr($name_img,-4));
		$dir = 'public/img/project/'.Session::get('path_post').'/';
		$allowedExts = array(".gif", ".jpeg", ".jpg", ".png"); // passar estes parametros para o config

		if( in_array($ext, $allowedExts) )
		{
			$image = WideImage::load( $tmp_name );
			$image = $image->resize(800, 400, 'inside');
			$image = $image->crop('center', 'center', 800, 400);

			// verifica so o diretorio existe
			// caso contrario, cria o diretorio com permissao para escrita
			if( !is_dir( $dir ) )
				mkdir( $dir, 0777, true);

			$image->saveToFile( $dir . Data::formatSlug( $_POST["title"] ).$ext, 90 );
		}

		$data = array(
			'title' 			=> $_POST["title"],
			//'website' 		=> $_POST["website"],
			//'link_image' 		=> $_POST["link_image"],
			'summary'			=> $_POST['summary'],
			//'content' 			=> $_POST["content"],
			'level' 			=> $_POST["level"],
			'id_user' 			=> Session::get('userid'),
			'slug'				=> Data::formatSlug( $_POST["title"] ),
			'tags'				=> $_POST['tags'],
			'path'				=> Session::get('path_post'),
			'mainpicture'		=> Data::formatSlug( $_POST["title"] ).$ext,
			'status'			=> 'DRAFT'
		);

		if( !$id_project = $this->model->create( $data ) )
		{
			$msg = base64_encode( "OPERACAO_ERRO" );
		}
		else{
			$msg = base64_encode( "OPERACAO_SUCESSO" );
		}

		// Destruir sessao do path do post
		Session::destroy('path_post');

		$this->model->db->commit();
		header("location: " . URL . "project/form/{$id_project}?idTab=2&st=".$msg);
	}

	/**
	* Metodo edit
	*/
	public function edit( $id )
	{
		$this->model->obterProject($id);

		$name_mainpicture = $this->model->getMainpicture();

		if( isset($_FILES['photo_project']) )
		{
			// Fazer upload da foto
			require_once 'util/wideimage/WideImage.php';

			$name_img = $_FILES['photo_project']['name'];
			$tmp_name = $_FILES['photo_project']['tmp_name'];
			$ext = strtolower(substr($name_img,-4));
			$dir = 'public/img/project/'.$this->model->getPath().'/';

			$allowedExts = array(".gif", ".jpeg", ".jpg", ".png"); // passar estes parametros para o config

			if( in_array($ext, $allowedExts) )
			{

				$image = WideImage::load( $tmp_name );
				$image = $image->resize(800, 400, 'inside');
				$image = $image->crop('center', 'center', 800, 400);

				// verifica so o diretorio existe
				// caso contrario, cria o diretorio com permissao para escrita
				if( !is_dir( $dir ) )
					mkdir( $dir, 0777, true);

				$name_mainpicture = Data::formatSlug( $_POST["title"] ).$ext;
				$image->saveToFile( $dir . $name_mainpicture, 90 );

			}
		}

		$this->model->db->beginTransaction();

		$data = array(
			'title' 		=> $_POST["title"],
			'website' 		=> $_POST["website"],
			'summary'		=> $_POST['summary'],
			'content' 		=> $_POST["content"],
			'level' 		=> $_POST["level"],
			'slug'			=> Data::formatSlug( $_POST["title"] ),
			'mainpicture'	=> $name_mainpicture,
			'tags'			=> $_POST['tags']
		);

		if( !$this->model->edit( $data, $id ) )
		{
			$this->model->db->rollBack();
			$msg = base64_encode( "OPERACAO_ERRO" );
			header("location: " . URL . "project/form/{$id}?idTab=".$_POST['idTab']."&st=".$msg."&erro=1");
		}

		// Cadastrar os membros na tabela project_user

		// Cadastrar os componentes na tabela project_componemt
		if( $_POST['name_component'] != '' )
		{
			$data_component = array(
				'name'			=> $_POST['name_component'],
				'amount'		=> $_POST['amount_component'],
				'link'			=> Data::formataHttp($_POST['link_component']),
				'id_project'	=> $id
			);

			if( !$this->model->db->insert( "component", $data_component ) )
			{
				$this->model->db->rollBack();
				$msg = base64_encode( "OPERACAO_ERRO" );
				header("location: " . URL . "project/form/{$id}?idTab=".$_POST['idTab']."&st=".$msg."&erro=1");
			}

		}

		$this->model->db->commit();

		header("location: " . URL . "project/form/{$id}?idTab=".$_POST['idTab']."&st=".$msg);
	}

	/**
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "project?st=".$msg);
	}

	public function deleteimg($id, $path, $name_img)
	{
		Session::init();

		$imagem = 'public/img/project/' . $path . '/'.$name_img;

		if(file_exists($imagem))
		{
 			unlink($imagem);
			//echo 'Deletou: ' . $path_original.'/'.$nome_original;
 		}

		header('Location: ' . URL . 'project/form/'.$id);
	}

	/**
	 * Faz o upload das imagens recebidas de um form
	 */
	public function wideimage_ajax()
	{
		Session::init();

		require_once 'util/wideimage/WideImage.php';

		date_default_timezone_set("Brazil/East");

		$name 	= $_FILES['files']['name'];
		$tmp_name = $_FILES['files']['tmp_name'];

		$allowedExts = array(".gif", ".jpeg", ".jpg", ".png"); // passar estes parametros para o config

		// Verifica a acao para pegar a variavel do path correta
		Session::get('act_post') == 'create' ? $var_path = Session::get('path_post') : $var_path = Session::get('path_edit_post');

		$dir = 'public/img/project/'. $var_path .'/';

		for($i = 0; $i < count($tmp_name); $i++)
		{
			$ext = strtolower(substr($name[$i],-4));

			if(in_array($ext, $allowedExts))
			{
				$new_name = strtolower( PREFIX_SESSION ).date('Ymd_his').'_'.$name[$i];

				$indice_img = ($i+1); // para nao criar img-0.jpg
				$new_name = 'img-' . $indice_img . $ext;
				while ( file_exists($dir.$new_name) ) {
					$indice_img++;
					$new_name = 'img-' . $indice_img . $ext;
				}

				// cria a img default =========================================
				$image = WideImage::load( $tmp_name[$i] );
				$image = $image->resize(800, 600, 'inside');
				//$image = $image->crop('center', 'center', 170, 180);

				// verifica so o diretorio existe
				// caso contrario, criamos o diretorio com permissao para escrita
				if( !is_dir( $dir ) )
					mkdir( $dir, 0777, true);

				$image->saveToFile( $dir . $new_name, 60 );

				// cria a img thumb ==========================================
				$image_thumb = WideImage::load( $tmp_name[$i] );
				$image_thumb = $image_thumb->resize(170, 150, 'outside');
				$image_thumb = $image_thumb->crop('center', 'center', 170, 150);

				$dir_thumb = $dir.'thumb/';
				// verifica so o diretorio existe
				// caso contrario, criamos o diretorio com permissao para escrita
				if( !is_dir( $dir_thumb ) )
					mkdir( $dir_thumb, 0777, true);

				$image_thumb->saveToFile( $dir_thumb . $new_name );
			}
		}

		echo json_encode($new_name);
	}
}
