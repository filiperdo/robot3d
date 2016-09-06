<?php 

class Blog extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/**
	 * Metodo index
	 */
	public function index()
	{
		$this->view->title = "Blog";
		$this->view->js[] = 'index.js';
	
		require_once 'models/post_model.php';
		$objPost = new Post_Model();
		$this->view->listarPost = $objPost->listPostHome();
		$this->view->listTopPost = $objPost->listTopPost(6);
	
		require_once 'models/category_model.php';
		$objCategory = new Category_Model();
		$this->view->listCategory = $objCategory->listarCategory();
		
		require_once 'models/comment_model.php';
		$objComment = new Comment_Model();
		$this->view->comment = $objComment;
		
		$ids_category = array();
		
		$this->view->render( "header.inc" );
		$this->view->render( "blog/index" );
		$this->view->render( "footer.inc" );
	}
	
	/** 
	* Metodo post
	*/
	public function post( $id_post )
	{
		$this->view->title = "Blog";
		$this->view->js[] = 'index.js';
		
		require_once 'models/post_model.php';
		$objPost = new Post_Model();
		$objPost->obterPost( $id_post );
		
		$this->view->obj = $objPost;
		
		require_once 'models/category_model.php';
		$objCategory = new Category_Model();
		$this->view->listCategory = $objCategory->listCategoryByPost( $id_post );
		
		$ids_category = array();
		
		// Monta um array com os ids das categorias relacionadas ao post
		foreach( $objCategory->listCategoryByPost( $id_post ) as $category )
		{
			$ids_category[] = $category->getId_category();
		}
		
		$this->view->listPostRelated = $objPost->listPostRelated( $id_post, $ids_category, 5 );
		
		require_once 'models/comment_model.php';
		$this->view->objComment = new Comment_Model();
		
		// Inicio Data log
		// ------------------------------------------------------------
		require_once 'models/datalog_model.php';
		$objDataLog = new Datalog_Model();
		
		// Configura as variaveis para efetuar a pesquisa do log
		$dados = array( 'id' => $id_post, 'ip' => $_SERVER["REMOTE_ADDR"], 'type' => 'id_post' );
		
		// Verifica se ja existe o log especifico
		if(!$objDataLog->getDataLog($dados))
		{
			// configura o id do item correto do log
			$dados['id_post'] = $id_post;
			$result = $objDataLog->create($dados);
		}
		// ------------------------------------------------------------
		// Fim datalog
		
		$this->view->render( "header.inc" );
		$this->view->render( "blog/post" );
		$this->view->render( "footer.inc" );
		
	}
}