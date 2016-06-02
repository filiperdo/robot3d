<?php

class Index extends Controller {

	private $menu;
	
    function __construct() {
        parent::__construct();
        //Auth::handleLogin();

    }
    
    function index() {
 
        $this->view->title = 'Home';
        $this->view->render('header.inc');
        $this->view->render('col-left');
        $this->view->render('index/index');
        $this->view->render('col-right');
        $this->view->render('footer.inc');
    	
    }
    
    function docs()
    {
    	$this->view->title = 'Docsx';
    	$this->view->render('index/index');
    }
    
}