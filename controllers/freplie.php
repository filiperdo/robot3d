<?php 

class Freplie extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Freplie";
		$this->view->listarFreplie = $this->model->listarFreplie();

		$this->view->render( "header" );
		$this->view->render( "freplie/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Freplie";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Freplie";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterFreplie( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "freplie/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'id_freplie' => $_POST["id_freplie"], 
			'content' => $_POST["content"], 
			'id_fpost' => $_POST["id_fpost"], 
			'freplie_id_freplie' => $_POST["freplie_id_freplie"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "freplie?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			"id_freplie" 	=> $id,
			'id_freplie' => $_POST["id_freplie"], 
			'content' => $_POST["content"], 
			'id_fpost' => $_POST["id_fpost"], 
			'freplie_id_freplie' => $_POST["freplie_id_freplie"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "freplie?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "freplie?st=".$msg);
	}
}
