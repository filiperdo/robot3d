<?php

class Index extends Controller {

	private $menu;
	
    function __construct() {
        parent::__construct();
        //Auth::handleLogin();
        
        /**
         * Menu
         */
        $this->view->menu = array(
        	0 => array('link' => 'index', 		'label' => 'Home', 		'toggle' => ''),
       		//1 => array('link' => 'index/docs',	'label' => 'Sobre', 	'toggle' => ''),
        	2 => array('link' => 'profile', 	'label' => 'Projetos', 	'toggle' => ''),
        	3 => array('link' => '#msgModal', 	'label' => 'Tutoriais',	'toggle' => 'data-toggle="modal"'),
       		4 => array('link' => 'index',		'label' => 'Fórum', 	'toggle' => ''),
        	5 => array('link' => 'index',		'label' => 'Suporte', 	'toggle' => ''),
        );
        
    }
    
    function index() {
 
        $this->view->title = 'Home';
        $this->view->render('header.inc');
        $this->view->render('index/index');
        $this->view->render('footer.inc');
    	
    }
    
    function docs()
    {
    	$this->view->title = 'Docsx';
    	$this->view->render('index/index');
    }
    
}