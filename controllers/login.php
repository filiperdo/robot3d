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
    	$this->view->title = 'Cadastrar';
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
    

}