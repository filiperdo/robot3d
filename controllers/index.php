<?php

class Index extends Controller {
	
    function __construct() {
        parent::__construct();
        //Auth::handleLogin();
    }
    
    public function index() 
    {
        $this->view->title = 'Home';
        $this->view->js[] = 'index.js';	
        
        require_once 'models/post_model.php';
        require_once 'models/project_model.php';
        require_once 'models/comment_model.php';
        require_once 'models/index_model.php';
        
        $objPost = new Post_Model();
        
        $objProject = new Project_Model();
        
        $this->view->objComment = new Comment_Model();
        
        $objIndex = new Index_Model();
        $this->view->listarHome = $objIndex->listarHome();
        /*
        $list_home = array();
        
        $indice = 0;
        
        foreach( $objPost->listPostHome() as $post )
        {
        	$list_home[$indice]['type']		= 'post';
        	$list_home[$indice]['id'] 		= $post->getId_post();
        	$list_home[$indice]['title'] 	= $post->getTitle();
        	$list_home[$indice]['content'] 	= $post->getContent();
        	$list_home[$indice]['date'] 	= $post->getDate();
        	$list_home[$indice]['path'] 	= $post->getPath();
        	$list_home[$indice]['mainpicture'] = $post->getMainpicture();
        	
        	$indice++;
        }
        
        foreach( $objProject->listarProjectHome() as $project )
        {
        	$list_home[$indice]['type']		= 'project';
        	$list_home[$indice]['id'] 		= $project->getId_project();
        	$list_home[$indice]['title'] 	= $project->getTitle();
        	$list_home[$indice]['content'] 	= $project->getContent();
        	$list_home[$indice]['date'] 	= $project->getDate();
        	$list_home[$indice]['path'] 	= $project->getPath();
        	$list_home[$indice]['mainpicture'] = $project->getMainpicture();
        	
        	$indice++;
        }

        
        $this->view->list = $list_home;
        */
        $this->view->render('header.inc');
        $this->view->render('col-left');
        $this->view->render('index/index');
        $this->view->render('col-right');
        $this->view->render('footer.inc');
    }
    
}