<?php

/**
 * Classe Datalog
 * @author __
 *
 * Data: 01/06/2016
 */

class Index_Model extends Model
{
	/**
	 * Metodo construtor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function listarHome($num_page = NULL)
	{
		// Configura as variaveis de limites
		// para carregamento dinamico na home
		$quantidade = 5;
		$page = isset($num_page) && $num_page > 0 ? $num_page : 1;
		$inicio = ( $page * $quantidade ) - $quantidade;

		// Faz a selecao de post e projetos

		$sql  = 'select ';
		$sql .= 'p.id_post as id, ';
		$sql .= 'p.slug, ';
		$sql .= 'p.title, ';
		$sql .= 'p.content as content, ';
		$sql .= 'p.date, ';
		$sql .= 'p.path, ';
		$sql .= 'p.mainpicture, ';
		$sql .= "'post' as tipo ";
		$sql .= 'from post as p ';
		$sql .= "where p.status = 'PUBLISHED' ";
		$sql .= 'union ';
		$sql .= 'select ';
		$sql .= 'p.id_project as id, ';
		$sql .= 'p.slug, ';
		$sql .= 'p.title, ';
		$sql .= 'p.summary as content, ';
		$sql .= 'p.date, ';
		$sql .= 'p.path, ';
		$sql .= 'p.mainpicture, ';
		$sql .= "'project' as tipo ";
		$sql .= 'from project as p ';
		$sql .= 'order by 5 desc '; // 5 colun = date

		$sql .= "limit {$inicio},{$quantidade} ";

		$result = $this->db->select( $sql );
		return $result;
	}


}
