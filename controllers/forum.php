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
		
		// Instancia do item_model
		require_once 'models/item_model.php';
		$this->view->objItem = new Item_Model();
		
		// Instancia do replie_model
		require_once 'models/replie_model.php';
		$this->view->objReplie = new Replie_Model();
		
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
		Session::init();
		
		require_once 'util/time-ago/westsworld.datetime.class.php';
		require_once 'util/time-ago/timeago.inc.php';
		
		$this->view->title = "Forum";
		$this->view->js[] = 'forum.js';
		
		require_once 'models/topic_model.php';
		$objTopic = new Topic_Model();
		$objTopic->obterTopic( $id_topic );
		$this->view->objTopic = $objTopic;
		
		require_once 'models/item_model.php';
		$this->view->objItem = new Item_Model();
		
		// Instancia do replie_model
		require_once 'models/replie_model.php';
		$this->view->objReplie = new Replie_Model();
		
		require_once 'models/notify_model.php';
		$objNotify = new Notify_Model();
		$obj = $objNotify->searchNotify( $id_topic, Session::get('userid') );
		
		$this->view->flag_notify = array( 'no' => '', 'alert' => '', 'email' => '', 'two' => '' );
		
		if( $obj )
			$this->view->flag_notify[ $obj->getType() ] = '<i class="glyphicon glyphicon-ok"></i>';
		else
			$this->view->flag_notify[ 'no' ] = '<i class="glyphicon glyphicon-ok"></i>';
		
		require_once 'models/datalog_model.php';
		$this->view->datalog = new Datalog_Model();
			
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
		
		// Inicio Data log
		// ------------------------------------------------------------
		require_once 'models/datalog_model.php';
		$objDataLog = new Datalog_Model();
		
		// Configura as variaveis para efetuar a pesquisa do log
		$dados = array( 'id' => $id_item, 'ip' => $_SERVER["REMOTE_ADDR"], 'type' => 'id_item' );
		
		// Verifica se ja existe o log especifico
		if(!$objDataLog->getDataLog($dados))
		{
			// configura o id do item correto do log
			$dados['id_item'] = $id_item;
			$result = $objDataLog->create($dados);
		}
		// ------------------------------------------------------------
		// Fim datalog
		
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
