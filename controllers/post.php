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
	public function form( $id_post = NULL )
	{
		Session::init();
		
		$this->view->title = "Cadastrar Post";
		$this->view->action = "create";
		$this->view->js[] = 'clipboard.min.js';
		$this->view->obj = $this->model;
		$this->view->array_category = array();
		
		require_once 'models/category_model.php';
		$objCategoria = new Category_Model();
		$this->view->listCategory = $objCategoria->listarCategory();
		
		$this->view->path = '';
		
		if( $id_post == NULL )
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
			$this->view->title = "Editar Post: " . $id_post;
			$this->view->action = "edit/".$id_post;
			$this->view->obj = $this->model->obterPost( $id_post );
			
			$this->view->path = $this->view->obj->getPath();
			Session::set( 'path_edit_post', $this->view->obj->getPath() );
			Session::set('act_post', 'edit');
			
			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
			
			// Monta o array com as categorias vinculadas ao post
			foreach ( $objCategoria->listCategoryByPost( $id_post ) as $category )
			{
				$this->view->array_category[] = $category->getId_category();
			}
		}
		
		// debug
// 		if( Session::get('act_post') == 'create' )
// 			$this->view->title = 'Session: ' . Session::get('act_post').': '.Session::get('path_post');
// 		else
// 			$this->view->title = 'Session: ' . Session::get('act_post').': '.Session::get('path_edit_post');
		// end debug -------------------------------------
		
		$this->view->render( "header" );
		
		$this->view->render( "post/form" );
		
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		Session::init();
		
		$this->model->db->beginTransaction();
		
		/**
		 * Cadastra o post
		 * @var unknown
		 */	
		$data = array(
			'title' 		=> $_POST["title"], 
			'slug'			=> Data::formatSlug($_POST["title"]),
			'content' 		=> $_POST["content"], 
			'status' 		=> $_POST["status"],
			'path'			=> $_POST['path'],
			'mainpicture'	=> str_replace('../', '', $_POST['mainpicture']),
			'id_user'		=> Session::get('userid'),
			'author'		=> $_POST['author'],
			'source'		=> $_POST['source']
		);
		
		if( !$id_post = $this->model->create( $data ) )
		{
			$this->model->db->rollBack();
			$msg = base64_encode( "OPERACAO_ERRO" );
			header("location: " . URL . "post?st=".$msg);
		}
		
		/**
		 * Cadastra as categorias do post
		 */
		if( isset($_POST['categoria']) )
		{
			foreach( $_POST['categoria'] as $id_categoria )
			{
				$data_category = array(
					'id_post'		=> $id_post,
					'id_category'	=> $id_categoria
				);
				
				if( !$this->model->db->insert( "post_category", $data_category, false ) )
				{
					$this->model->db->rollBack();
					$msg = base64_encode( "OPERACAO_ERRO" );
					header("location: " . URL . "post?st=".$msg);
				}
			}
		}
		
		// Destruir sessao do path do post
		Session::destroy('path_post');
		
		/**
		 * Realiza o commit e retorna a view
		 */
		$this->model->db->commit();
		$msg = base64_encode( "OPERACAO_SUCESSO" );
		header("location: " . URL . "post?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$this->model->db->beginTransaction();
		
		/**
		 * Edita os dados do post
		 * @var unknown
		 */
		$data = array(
			'title' 		=> $_POST["title"],
			'slug'			=> Data::formatSlug($_POST["title"]),
			'content' 		=> $_POST["content"], 
			'status' 		=> $_POST["status"],
			'mainpicture'	=> str_replace('../', '', $_POST['mainpicture']),
			'author'		=> $_POST['author'],
			'source'		=> $_POST['source']
		);
		
		if( !$this->model->edit( $data, $id ) )
		{
			$this->model->db->rollBack();
			$msg = base64_encode( "OPERACAO_ERRO" );
			header("location: " . URL . "post?st=".$msg."&erro=1");
		}
		
		/**
		 * Cadastra as categorias do post
		 */
		// Deleta todas as categorias vinculadas ao post
		$this->model->db->deleteComposityKey( 'post_category', "id_post = {$id}" );
		
		if( isset($_POST['categoria']) )
		{
			foreach( $_POST['categoria'] as $id_categoria )
			{
				$data_category = array(
					'id_post'		=> $id,
					'id_category'	=> $id_categoria
				);
				
				if( !$this->model->db->insert( "post_category", $data_category, false ) )
				{
					$this->model->db->rollBack();
					$msg = base64_encode( "OPERACAO_ERRO" );
					header( "location: " . URL . "post?st=".$msg."&erro=3" );
				}
			}
		}
		
		// Destruir sessao do path do post
		Session::destroy('path_post');
		
		/**
		 * Realiza o commit e retorna a view
		 */
		$this->model->db->commit();
		
		$msg = base64_encode( "OPERACAO_SUCESSO" );
		header("location: " . URL . "post?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		// deletar primeiro os ids da tabela post_categor
		
		// estudar o que fazer com as imagens
		// talvez deixar a opcao para selecionar opcionalmente para deletar o post e as imagens
		
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "post?st=".$msg);
	}
	
	/**
	 * Faz o upload das imagens recebidas de um form
	 */
	public function wideimage_ajax()
	{
		Session::init();
		
		require_once 'util/wideimage/WideImage.php';
		
		date_default_timezone_set("Brazil/East");
		
		$name 	= $_FILES['fileUpload']['name'];
		$tmp_name = $_FILES['fileUpload']['tmp_name'];
		
		$allowedExts = array(".gif", ".jpeg", ".jpg", ".png");
		
		// Verifica a acao para pegar a variavel do path correta
		Session::get('act_post') == 'create' ? $var_path = Session::get('path_post') : $var_path = Session::get('path_edit_post');
		
		$dir = 'public/img/post/'. $var_path .'/';
		
		for($i = 0; $i < count($tmp_name); $i++)
		{
			$ext = strtolower(substr($name[$i],-4));
			
			if(in_array($ext, $allowedExts))
			{
				$new_name = strtolower( PREFIX_SESSION ).date('Ymd_his').'_'.$name[$i];
				
				// cria a img default =========================================
				$image = WideImage::load( $tmp_name[$i] );
				$image = $image->resize(800, 600, 'inside');
				//$image = $image->crop('center', 'center', 170, 180);
		
				// verifica so o diretorio existe
				// caso contrario, criamos o diretorio com permissao para escrita
				if( !is_dir( $dir ) )
					mkdir( $dir, 0777);
				
				$image->saveToFile( $dir . $new_name );
				
				// cria a img thumb ==========================================
				$image_thumb = WideImage::load( $tmp_name[$i] );
				$image_thumb = $image_thumb->resize(170, 150, 'outside');
				$image_thumb = $image_thumb->crop('center', 'center', 170, 150);
				
				$dir_thumb = $dir.'thumb/';
				// verifica so o diretorio existe
				// caso contrario, criamos o diretorio com permissao para escrita
				if( !is_dir( $dir_thumb ) )
					mkdir( $dir_thumb, 0777);
				
				$image_thumb->saveToFile( $dir_thumb . $new_name );
			}
		}
		
		echo 'Funfou';
	}
	
}
