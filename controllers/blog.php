<?php 

class Blog extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function post( $id_post )
	{
		$this->view->title = "Blog";
		
		require_once 'models/post_model.php';
		$objPost = new Post_Model();
		$objPost->obterPost( $id_post );
		
		$this->view->obj = $objPost;
		
		$this->view->render( "header.inc" );
		$this->view->render( "blog/post" );
		$this->view->render( "footer.inc" );
	}
}