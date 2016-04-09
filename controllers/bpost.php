<?php 

class Bpost extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Bpost";
		$this->view->listarBpost = $this->model->listarBpost();

		$this->view->render( "header" );
		$this->view->render( "bpost/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Bpost";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Bpost";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterBpost( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "bpost/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'id_bpost' => $_POST["id_bpost"], 
			'title' => $_POST["title"], 
			'content' => $_POST["content"], 
			'date' => $_POST["date"], 
			'views' => $_POST["views"], 
			'status' => $_POST["status"], 
			'id_bcomment' => $_POST["id_bcomment"], 
			'id_bcategory' => $_POST["id_bcategory"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "bpost?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			"id_bpost" 	=> $id,
			'id_bpost' => $_POST["id_bpost"], 
			'title' => $_POST["title"], 
			'content' => $_POST["content"], 
			'date' => $_POST["date"], 
			'views' => $_POST["views"], 
			'status' => $_POST["status"], 
			'id_bcomment' => $_POST["id_bcomment"], 
			'id_bcategory' => $_POST["id_bcategory"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "bpost?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "bpost?st=".$msg);
	}
}
