<?php

class Data
{
    /**
     * Implementar
     * date( 'd/m/Y', strtotime( $this->dataRegistro ) )
     */
    
	static public function formataData($data)
	{
		if (!empty($data))
		{
			return implode('/', array_reverse(explode('-', $data)));
		}
	}
	
	static public function formataDataHora($data)
	{
		if (!empty($data))
		{
			$d = explode(' ', $data);
			return implode('/', array_reverse(explode('-', $d[0]))) . ' ' . $d[1];
		}
	}
	
	static public function formataDataRetiraHora($data)
	{
		if (!empty($data))
		{
			$d = explode(' ', $data);
			$data_hora = implode('/', array_reverse(explode('-', $d[0]))) . ' ' . $d[1];
			return substr($data_hora,0,10);
		}
	}
	
	static public function formataDataBD($data)
	{
		if (!empty($data))
		{
			return implode('-', array_reverse(explode('/', $data)));
		}
	}
	
	static public function formataMoeda($valor)
	{
		if (!empty($valor))
			return number_format($valor, 2, ',', '.');
	}
	
	static public function formataMoedaBD($valor)
	{
		$valor = str_replace('.', '', $valor);
		$valor = str_replace(',', '.', $valor);
		return $valor;
	}
	
	static public function formataTel($tel)
	{
		$retorno = '';
		if ($tel != 0 && !empty($tel)) {
			$retorno = '('.substr($tel, 0, 2).')'.substr($tel, 2, 4).'-'.substr($tel, -4);
		}
		return $retorno;
	}
	
	static public function formataCep($cep)
	{
		if (!empty($cep))
		{
			return substr($cep, 0, 5) . '-' . substr($cep, -3);
		}
	}
	
	static public function formataCepBD($cep)
	{
		if( !empty($cep) )
		{
			return str_replace('-','', $cep);
		}
	}
	
	static public function gerarSenha($length = 6)
	{
		$array = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U",1,2,3,4,5,6,7,8,9,0);
		shuffle( $array );
		$senha = array_slice( $array, 0, $length );
		$senha = implode( "", $senha );
	
		return $senha; 
	}
	
	/**
	 * Obtem a imagem do perfil do usuario
	 * Em formatos JPG ou PNG
	 * @param unknown $id
	 */
	static public function getPhotoUser( $id )
	{
		$pasta = 'public/img/user/' . $id . '/';
		$foto_padrao = URL . 'public/img/avatar-fat.jpg';
		
		if ( is_dir( $pasta ) )
		{
			$diretorio = dir($pasta);
			$retorno = false;
			
			while(($arquivo = $diretorio->read()) !== false)
			{
				$tipo = substr($arquivo,-4);
				if( $tipo == ".jpg" || $tipo == ".png" )
				{
					return URL . $pasta . $arquivo ;
					$retorno = true;
				}
			}
			$diretorio->close();
				
			if( $retorno == false )
				return $foto_padrao;
		}
		else {
			return $foto_padrao;
		}
	}
	
	/**
	 * Obtem as imagens dos post ou projetos para exibir na home
	 * @param unknown $type
	 * @param unknown $id
	 * @return unknown[]
	 */
	static public function getImgPost( $type, $id )
	{
		$array_img = array();
		
		foreach( glob('public/img/'. $type .'/'. $id .'/*.*' ) as $key => $imagem )
		{
			$array_img[] = $imagem;
		}
		
		return $array_img;
	}


	static function timeAgo( $time_ago )
	{
		$cur_time   = time();
		$time_elapsed   = $cur_time - $time_ago;
		$seconds    = $time_elapsed ;
		$minutes    = round($time_elapsed / 60 );
		$hours      = round($time_elapsed / 3600);
		$days       = round($time_elapsed / 86400 );
		$weeks      = round($time_elapsed / 604800);
		$months     = round($time_elapsed / 2600640 );
		$years      = round($time_elapsed / 31207680 );
		// Seconds
		if($seconds <= 60){
		    echo "$seconds segundos atrás";
		}
		//Minutes
		else if($minutes <=60){
		    if($minutes==1){
		        echo "um minuto atrás";
		    }
		    else{
		        echo "$minutes minutos atrás";
		    }
		}
		//Hours
		else if($hours <=24){
		    if($hours==1){
		        echo "uma hora atrás";
		    }else{
		        echo "$hours horas atrás";
		    }
		}
		//Days
		else if($days <= 7){
		    if($days==1){
		        echo "ontem";
		    }else{
		        echo "$days dias atrás";
		    }
		}
		//Weeks
		else if($weeks <= 4.3){
		    if($weeks==1){
		        echo "à uma semana";
		    }else{
		        echo "$weeks semanas atrás";
		    }
		}
		//Months
		else if($months <=12){
		    if($months==1){
		        echo "um mês atrás";
		    }else{
		        echo "$months meses atrás";
		    }
		}
		//Years
		else{
		    if($years==1){
		        echo "um ano atrás";
		    }else{
		        echo "$years anos atrás";
		    }
		}
	}

}

?>
