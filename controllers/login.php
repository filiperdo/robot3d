<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();    
    }
    
    function index() 
    {    
        $this->view->title = 'Login';
        $this->view->render('header.inc');
        $this->view->render('col-left');
        $this->view->render('login/index');
        $this->view->render('col-right');
        $this->view->render('footer.inc');
    }
    
    public function register()
    {
    	Session::init();
    	
    	$this->view->title = 'Cadastrar';
    	
    	if( isset( $_SESSION[ PREFIX_SESSION . 'post_email'] ) ) {
    		$this->view->email = Session::get('post_email');
    		$this->view->login = Session::get('post_login');
    	}
    	else {
    		$this->view->email = '';
    		$this->view->login = '';
    	}
    	
    	$this->view->render('header.inc');
    	$this->view->render('col-left');
    	$this->view->render('login/register');
    	$this->view->render('col-right');
    	$this->view->render('footer.inc');
    }
    
    
    
    function cadastro()
    {
    	$this->view->title = 'Cadastrar';
    	$this->view->render('login/form');
    }
    
    function run()
    {
        $this->model->run();
    }
    
    function logout()
    {
    	$this->model->logout();
    }
    
    public function testeEmail()
    {
    	require_once 'util/email.class.php';
    	
    	$objEmail = new Email();
    	$objEmail->teste_envio();
    }

}