<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        //Auth::handleLogin();
    }

    public function index()
    {
        $this->view->title = 'Home';
        //$this->view->js[] = 'index.js'; este arquivo esta sendo carregado no blog/post, ACERTAR!!!

        require_once 'models/post_model.php';
        require_once 'models/project_model.php';
        require_once 'models/comment_model.php';
        require_once 'models/index_model.php';

        $objPost = new Post_Model();

        $objProject = new Project_Model();

        $this->view->objComment = new Comment_Model();

        $objIndex = new Index_Model();
        $this->view->listarHome = $objIndex->listarHome();

        $this->view->render('header.inc');
        $this->view->render('col-left');
        $this->view->render('index/test');
        $this->view->render('col-right');
        $this->view->render('footer.inc');
    }

    public function trends()
    {
        $content = file_get_contents('http://www.robo3d.com.br/_files/reports/arduino-mercadolivre.json');

        $array = json_decode($content);

        foreach ($array as $value) {
            $value->vendidos = trim( str_replace('vendidos', '', $value->vendidos) );

            $centavos = substr($value->preco, -2);
            $reais = substr($value->preco, 0, -2);

            $value->preco = $reais .','. $centavos;
        }

        //var_dump($array);
        //exit();

        // Compara se $a é maior que $b
        function cmp($a, $b) {
        	return $a->vendidos < $b->vendidos;
        }

        // Ordena
        usort($array, 'cmp');
        $this->view->json = $array;

        //var_dump($this->view->json);
        $this->view->render('index/trends');
    }

	public function indexTest($num_page)
	{
		Session::init();

		$this->view->title = 'Home';
		//$this->view->js[] = 'index.js';

		require_once 'models/post_model.php';
		require_once 'models/project_model.php';
		require_once 'models/comment_model.php';
		require_once 'models/index_model.php';

		$objPost = new Post_Model();
		$objProject = new Project_Model();
		$objComment = new Comment_Model();

		require_once 'models/index_model.php';
		$objIndex = new Index_Model();


		foreach( $objIndex->listarHome($num_page) as $key => $list )
		{
			$html  = '<li class="qf b aml">';
	        $html .= '<div class="qg">';
	        $html .= '<div class="qn">';

			$html .= '<small class="eg dp">' . Data::timeAgo( $list['date'] ) . '</small>';
	        $html .= '<h4 class="title-post-home" style="text-transform: uppercase;">';

			if( $list['tipo'] == 'post' ) {
          		$link = URL . 'blog/post/' . $list['slug'];
          		$html .= '<a href="' . $link . '">' . strtoupper($list['title']) . '</a>';
          	} else {
          		$link = URL . 'project/detail/' . $list['id'];
          		$html .= '<a href="'. $link .'">'.strtoupper($list['title']).'</a>';
          	}

			$html .= '</h4>';
			$html .= '</div>';

			if( !empty( $list['mainpicture'] ) ) {

	            $mainpicture = URL .'public/img/post/'.$list['path'].'/'. $list['mainpicture'];

                list( $width, $height, $type, $attr ) = getimagesize( $mainpicture );
				$html .= '<div class="any" data-grid="images">';
		        $html .= '<img data-action="zoom" data-width="'. $width .'" data-height="'. $height.'" src="'.$mainpicture.'">';
            	$html .= '</div>';
			}

	        $html .= '<p>'. substr(strip_tags( $list['content'] ), 0,300)."...  - <small><a href='{$link}'>veja mais</a></small>".'</p>';

	        /*$html .= '<div class="any" data-grid="images">';
	        $array_img = Data::getImgPost( $list['tipo'], $list['path'] );

	        foreach( $array_img as $key => $img )
			{
		        if( $key < 2 && $img != $list['mainpicture'] )
				{
		        	list($width, $height, $type, $attr) = getimagesize( $img );
		             //$html .= '<div style="display: none">';
		             $html .= "<img data-action='zoom' data-width='{$width}' data-height='{$height}'src='{$img}'>";
		             //$html .= '</div>';
				} // fim if
			} // fim foreach

			$html .= '</div>';*/

			// Comentarios
			$html .= '<p class="page-header">'.$objComment->getTotalComment( $list['tipo'], $list['id'] ).' <small>Comentários</small> </p>  ';

			$html .= '<ul class="qo alm">';

            if( Session::get('loggedIn' ) )
			{
	            $html .= '<li class="qf">';
	            $html .= '<a class="qj" href="#">';
				$html .= '<img class="qh cu" src="'. Data::getPhotoUser( Session::get('userid') ) .'">';
	            $html .= '</a>';
	            $html .= '<div class="qg">';
	            //$html .= '<strong>'. Session::get('user_login') .': </strong>';

	        	$html .= '<input type="hidden" id="comment_type-' . $list['id'] .'" name="comment_type" value="'. $list['tipo'] .'">';
	            $html .= '<input type="hidden" id="" name="id_item" value="'. $list['id'] .'">';
	            $html .= '<div class="row">';
				$html .= '<div class="col-md-9"><input type="text" class="form-control" name="content" id="content-'. $list['id'] .'" placeholder="Escrava um comentário" style="margin-bottom: 5px"></div>';

				$html .= '<div class="col-md-3"><a class="cg ts fx bt-sub-form" id="'. $list['id'] .'"><span class="h aah"></span> Publicar</a></div>';
				$html .= '</div>';
	            $html .= '</div>';
	            $html .= '</li>';
            }

            $html .= '<li class="qf" id="result-'. $list['id'] .'" style="display: none"><img alt="Carregando..." src="'. URL .'public/img/loader.gif"> Carregando...</li>';

            foreach( $objComment->listCommentByType( $list['tipo'], $list['id'], 3 ) as $comment )
			{
            	$html .= '<li class="qf">';
                $html .= '<a class="qj" href="#">';
                $html .= '<img class="qh cu" src="'. Data::getPhotoUser( $comment->getUser()->getId_user() ) .'">';
                $html .= '</a>';
                $html .= '<div class="qg">';
                $html .= '<strong><a href="'. URL . 'user/dashboard/'. $comment->getUser()->getLogin().'"> '. $comment->getUser()->getLogin().' </a></strong>';
                $html .= '<small>('. Data::formatDateShort( $comment->getDate() ) .')</small>: ';
                $html .= $comment->getContent();
                $html .= '</div>';
              	$html .= '</li>';
            }

            $html .= '</ul>';

			$html .= '</div>';
	        $html .= '</li>';

			echo $html;

		}// fim foreach

	}

}
