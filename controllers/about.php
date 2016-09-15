<?php 

class About extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "About";
		
		$this->view->render('header.inc');
        $this->view->render('col-left');
        $this->view->render('about/index');
        $this->view->render('col-right');
        $this->view->render('footer.inc');
	}

}
