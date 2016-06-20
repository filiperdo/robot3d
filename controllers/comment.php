<?php 

class Comment extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Comment";
		$this->view->listarComment = $this->model->listarComment();

		$this->view->render( "header" );
		$this->view->render( "comment/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Comment";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Comment";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterComment( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "comment/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		Session::init();
		
		$data = array(
			'content' 	=> $_POST["content"],
			'id_user' 	=> Session::get('userid')
		);
		
		// Verifica e configura se eh um comment de um post ou project
		$_POST['comment_type'] == 'post' ? $data['id_post'] = $_POST['id_item'] : $data['id_project'] = $_POST['id_item'];
		
		if( !$this->model->create( $data ) )
		{
			echo 'Erro! O sistema não conseguiu gravar seu comentário!';
		}
		else
		{
			// <li> comentarios inseridos na home </i>
			echo '<li class="qf"><a class="qj" href="#"><img class="qh cu" src="' . Data::getPhotoUser( Session::get('userid') ) . '"></a>';
			echo '<div class="qg"><strong><a href="' . URL . 'user/dashboard/' . base64_encode( Session::get('userid') ) . ' ">' . Session::get('user_login') . ':</a> </strong>' . $_POST["content"] . '</div></li>';
		}
		
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'content' 	=> $_POST["content"],
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "comment?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "comment?st=".$msg);
	}
}
