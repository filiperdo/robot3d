<?php 

class Forum extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Fórum";
		
		require_once 'models/subject_model.php';
		$objSubject = new Subject_Model();
		
		$this->view->listarSubject = $objSubject->listarSubject();

		$this->view->render( "header.inc" );
		$this->view->render( "forum/index" );
		$this->view->render( "col-right" );
		$this->view->render( "footer.inc" );
	}

	
}
