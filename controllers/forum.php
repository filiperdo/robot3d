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
		$this->view->title = "Forum";
		
		require_once 'models/subject_model.php';
		$objSubject = new Subject_Model();
		
		$this->view->listarSubject = $objSubject->listarSubject();

		require_once 'models/topic_model.php';
		$this->view->objTopic = new Topic_Model();
		
		$this->view->render( "header.inc" );
		$this->view->render( "forum/index" );
		$this->view->render( "col-right" );
		$this->view->render( "footer.inc" );
	}

	
	/**
	 * Metodo item
	 * @param unknown $id_topic
	 */
	public function item( $id_topic )
	{
		$this->view->title = "Forum";
		$this->view->js[] = 'forum.js';
		
		require_once 'models/topic_model.php';
		$objTopic = new Topic_Model();
		$objTopic->obterTopic( $id_topic );
		$this->view->objTopic = $objTopic;
		
		require_once 'models/item_model.php';
		$this->view->objItem = new Item_Model();
		
		$this->view->render( "header.inc" );
		$this->view->render( "forum/item" );
		$this->view->render( "col-right" );
		$this->view->render( "footer.inc" );
	}
	
	/**
	 * Metodo detail
	 * @param unknown $id_item
	 */
	public function detail( $id_item )
	{
		$this->view->title = "Forum";
		
		require_once 'models/item_model.php';
		$objItem = new Item_Model();
		$objItem->obterItem($id_item);
		
		$this->view->objItem = $objItem;
		
		require_once 'models/replie_model.php';
		$objReplie = new Replie_Model();
		
		$this->view->objReplie = $objReplie;
		
		
		$this->view->render( "header.inc" );
		$this->view->render( "forum/detail" );
		$this->view->render( "col-right" );
		$this->view->render( "footer.inc" );
		
	}
	
	
	public function write( $id_topic, $id_item = NULL ) 
	{
		$this->view->title = "Forum";
		$this->view->action = "create";
		
		require_once 'models/topic_model.php';
		$objTopic = new Topic_Model();
		$objTopic->obterTopic( $id_topic );
		$this->view->objTopic = $objTopic;
		
		require_once 'models/item_model.php';
		$objItem = new Item_Model();
		
		if( $id_item )
		{
			$this->view->action = "edit/".$id_item;
			$objItem->obterItem( $id_item );
		}
		
		$this->view->objItem = $objItem;
		
		$this->view->render( "header.inc" );
		$this->view->render( "forum/write" );
		$this->view->render( "col-right" );
		$this->view->render( "footer.inc" );
	}
}
