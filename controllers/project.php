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

		$this->view->render( "header.inc" );
		$this->view->render( "project/index" );
		$this->view->render( "col-right" );
		$this->view->render( "footer.inc" );
	}

	public function lista()
	{
		$this->view->title = "Project";
		$this->view->listarProject = $this->model->listarProject();
		
		$this->view->render( "header" );
		$this->view->render( "project/lista" );
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

	public function detail( $id_project )
	{
		$this->view->obj = $this->model->obterProject( $id_project );
		
		require_once 'models/component_model.php';
		$this->view->objComponent = new Component_Model();
		
		$this->view->render( "header.inc" );
		$this->view->render( "project/detail" );
		//$this->view->render( "col-right" );
		$this->view->render( "footer.inc" );
	}
	
	/** 
	* Metodo create
	*/
	public function create()
	{
		Session::init();
		
		$data = array(
			'title' 			=> $_POST["title"], 
			'website' 			=> $_POST["website"], 
			'link_image' 		=> $_POST["link_image"], 
			'content' 			=> $_POST["content"], 
			'level' 			=> $_POST["level"], 
			//'date' 				=> date("Y-m-d H:i:s"), 
			'id_user' 			=> Session::get('userid')
		);
		
		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );
		
		header("location: " . URL . "project/lista?st=".$msg); // Ajustar o caminho de retorno
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'title' => $_POST["title"], 
			'website' => $_POST["website"], 
			'link_image' => $_POST["link_image"], 
			'content' => $_POST["content"], 
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
