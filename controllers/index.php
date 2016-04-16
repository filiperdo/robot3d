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
       		1 => array('link' => 'profile', 	'label' => 'Profile', 	'toggle' => ''),
        	2 => array('link' => '#msgModal', 	'label' => 'Messages', 	'toggle' => 'data-toggle="modal"'),
        	3 => array('link' => 'index/docs',	'label' => 'Docs', 	'toggle' => ''),
       		4 => array('link' => 'index',		'label' => 'Forum', 	'toggle' => ''),
        );
        
    }
    
    function index() {
 
        $this->view->title = 'Home';
        //$this->view->render('header');
        $this->view->render('index/index');
        //$this->view->render('footer');
    	
    }
    
    function docs()
    {
    	$this->view->title = 'Docsx';
    	$this->view->render('index/index');
    }
    
}