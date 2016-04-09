<?php 

class Ftopic extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Ftopic";
		$this->view->listarFtopic = $this->model->listarFtopic();

		$this->view->render( "header" );
		$this->view->render( "ftopic/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Ftopic";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Ftopic";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterFtopic( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "ftopic/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'id_ftopic' => $_POST["id_ftopic"], 
			'name' => $_POST["name"], 
			'description' => $_POST["description"], 
			'id_fcategory' => $_POST["id_fcategory"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "ftopic?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			"id_ftopic" 	=> $id,
			'id_ftopic' => $_POST["id_ftopic"], 
			'name' => $_POST["name"], 
			'description' => $_POST["description"], 
			'id_fcategory' => $_POST["id_fcategory"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "ftopic?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "ftopic?st=".$msg);
	}
}
