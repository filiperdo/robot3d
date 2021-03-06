<?php 

class Item extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Item";
		$this->view->listarItem = $this->model->listarItem();

		$this->view->render( "header" );
		$this->view->render( "item/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Item";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Item";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterItem( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "item/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		Session::init();
		
		$data = array(
			'title'		=> $_POST['title'],
			'content' 	=> $_POST["content"],
			'id_user' 	=> Session::get('userid'),
			'id_topic' 	=> $_POST["id_topic"],
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "forum/item/". $_POST["id_topic"] ."?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'title'		=> $_POST['title'],
			'content' 	=> $_POST["content"], 
			'id_topic' 	=> $_POST["id_topic"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "forum/item/". $_POST["id_topic"] ."?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "item?st=".$msg);
	}
}
