<?php 

class Blog extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index( $id_post )
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
		
		require_once 'models/comment_model.php';
		$this->view->objComment = new Comment_Model();
		
		$this->view->render( "header.inc" );
		$this->view->render( "blog/index" );
		$this->view->render( "footer.inc" );
	}
}