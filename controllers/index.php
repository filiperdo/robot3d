<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        //Auth::handleLogin();
    }
    
    function index() {

    	/**
    	 * Criar arquivos de do template para dar includes
    	 * da parte aberta ao usuario
    	 */
    	// 
        $this->view->title = 'Home';
        //$this->view->render('header');
        $this->view->render('index/index');
        //$this->view->render('footer');
    
    }
    
}