<?php

class Downloads extends Controller {
	
    function __construct() {
        parent::__construct();
        //Auth::handleLogin();
    }
    
    public function index() 
    {
        $this->view->title = 'Downloads';
        
        $this->view->render('header.inc');
        $this->view->render('col-left');
        $this->view->render('downloads/index');
        $this->view->render('col-right');
        $this->view->render('footer.inc');
    }
    
    public function manual()
    {
    	new Download('public/files/manual.pdf', 'manual.pdf');
    }
    
    public function nucleo()
    {
    	new Download('public/files/nucleo.hex', 'nucleo.hex');
    }
    
    public function robo3d_server()
    {
    	new Download('public/files/robo3d_server.exe', 'robo3d_server.exe');
    }
    
}