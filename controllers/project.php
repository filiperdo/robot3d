<?php 

class Project extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Project";
		$this->view->listarProject = $this->model->listarProject();

		$this->view->render( "header" );
		$this->view->render( "project/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Project";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Project";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterProject( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "project/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'id_project' => $_POST["id_project"], 
			'name' => $_POST["name"], 
			'website' => $_POST["website"], 
			'link_image' => $_POST["link_image"], 
			'description' => $_POST["description"], 
			'level' => $_POST["level"], 
			'date' => $_POST["date"], 
			'id_user' => $_POST["id_user"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "project?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			"id_project" 	=> $id,
			'id_project' => $_POST["id_project"], 
			'name' => $_POST["name"], 
			'website' => $_POST["website"], 
			'link_image' => $_POST["link_image"], 
			'description' => $_POST["description"], 
			'level' => $_POST["level"], 
			'date' => $_POST["date"], 
			'id_user' => $_POST["id_user"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "project?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "project?st=".$msg);
	}
}