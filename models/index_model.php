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
	
	public function listarHome()
	{
		$sql  = 'select ';
		$sql .= 'p.id_post as id, ';
		$sql .= 'p.title, ';
		$sql .= 'p.content, ';
		$sql .= 'p.date, ';
		$sql .= 'p.path, ';
		$sql .= 'p.mainpicture, ';
		$sql .= "'post' as tipo ";
		$sql .= 'from post as p ';
		$sql .= "where p.status = 'PUBLISHED' ";
		$sql .= 'union ';
		$sql .= 'select ';
		$sql .= 'p.id_project as id, ';
		$sql .= 'p.title, ';
		$sql .= 'p.content, ';
		$sql .= 'p.date, ';
		$sql .= 'p.path, ';
		$sql .= 'p.mainpicture, ';
		$sql .= "'project' as tipo ";
		$sql .= 'from project as p ';
		$sql .= 'order by 4 desc '; // 4 coluna
		
		$result = $this->db->select( $sql );
		return $result;
	}
	
	
}