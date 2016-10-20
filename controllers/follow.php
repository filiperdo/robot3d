<?php 

class Follow extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Follow";
		$this->view->listarFollow = $this->model->listarFollow();

		$this->view->render( "header" );
		$this->view->render( "follow/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Follow";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Follow";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterFollow( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "follow/form" );
		$this->view->render( "footer" );
	}

	/**
	 * Metodo followUser
	 * @param unknown $id_user
	 */
	public function followUser( $id_user )
	{
		Session::init();
		
		$data = array(
			'id_follower' 	=> Session::get('userid'),
			'id_user' 		=> $id_user,
		);
		
		if( $this->model->create( $data ) )
			echo 'Seguindo';
		
		//header("location: " . URL . "follow?st=".$msg);
	}
	
	
	/**
	 * Metodo unfollowUser
	 * @param unknown $id
	 */
	public function unfollowUser( $id_user )
	{
		Session::init();
		
		$this->model->delete( $id_user, Session::get('userid') );
	
		//header("location: " . URL . "follow?st=".$msg);
	}
	
	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'id_follower' => $_POST["id_follower"], 
			'id_user' => $_POST["id_user"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "follow?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'id_follower' => $_POST["id_follower"], 
			'id_user' => $_POST["id_user"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "follow?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "follow?st=".$msg);
	}
}
