<?php 

class Notify extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Notify";
		$this->view->listarNotify = $this->model->listarNotify();

		$this->view->render( "header" );
		$this->view->render( "notify/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Notify";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Notify";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterNotify( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "notify/form" );
		$this->view->render( "footer" );
	}

	public function loadNotify()
	{
		Session::init();
		
		$icone = '<i class="glyphicon glyphicon-tag"></i> ';
		
		$obj = $this->model->searchNotify( $_POST["id_topic"], Session::get('userid') );
		
		if( $obj )
		{
			switch ( $obj->getType() )
			{
				case 'alert' 	: $txt = 'Receber alertas'; break;
				case 'email' 	: $txt = 'Receber e-mails'; break;
				case 'two' 		: $txt = 'Receber e-mails e alertas'; break;
			}
			
			echo $icone . $txt;
		}
		else 
			echo $icone . 'Não receber alertas ou e-mail.';
	}
	
	/** 
	* Metodo create
	*/
	public function create()
	{
		Session::init();
		
		$obj = $this->model->searchNotify( $_POST["id_topic"], Session::get('userid') );
		
		if( $obj )
			$this->delete( $obj->getId_notify() );
		
		$msg = 'DELETAR';
			
		if( $_POST["type"] != 1 )
		{
			switch ( $_POST["type"] )
			{
				case 2 : $type = 'alert'; break;
				case 3 : $type = 'email'; break;
				case 4 : $type = 'two'; break;
			}
			
			$data = array(
				'type' 		=> $type,
				'id_user' 	=> Session::get('userid'),
				'id_topic' 	=> $_POST["id_topic"],
			);
			
			$this->model->create( $data ) ? $msg = "OPERACAO_SUCESSO" : $msg = "OPERACAO_ERRO";
		}
		// Debug
		echo $msg;
	}

	
	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'type' => $_POST["type"], 
			'id_user' => $_POST["id_user"],
			'id_item' => $_POST["id_item"],
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "notify?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		//header("location: " . URL . "notify?st=".$msg);
	}
}
