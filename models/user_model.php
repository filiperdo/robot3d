<?php

/**
 * Classe User
 * @author __
 *
 * Data: 01/06/2016
 */

include_once 'typeuser_model.php';

class User_Model extends Model
{
	/**
	* Atributos Private
	*/
	private $id_user;
	private $name;
	private $login;
	private $password;
	private $email;
	private $bio;
	private $numlogin;
	private $date;
	private $linguage;
	private $typeuser;
	private $lastlogin;
	private $status;
	private $token;
	private $path;
	private $views;
	private $website;
	private $github;
	private $facebook;
	private $twitter;
	private $youtube;

	public function __construct()
	{
		parent::__construct();

		$this->id_user = '';
		$this->name = '';
		$this->login = '';
		$this->password = '';
		$this->email = '';
		$this->bio = '';
		$this->numlogin = '';
		$this->date = '';
		$this->linguage = '';
		$this->typeuser = new Typeuser_Model();
		$this->lastlogin = '';
		$this->status = '';
		$this->token = '';
		$this->path = '';
		$this->views = '';
		$this->website = '';
		$this->github = '';
		$this->facebook = '';
		$this->twitter = '';
		$this->youtube = '';
	}

	/**
	* Metodos set's
	*/
	public function setId_user( $id_user )
	{
		$this->id_user = $id_user;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setLogin( $login )
	{
		$this->login = $login;
	}

	public function setPassword( $password )
	{
		$this->password = $password;
	}

	public function setEmail( $email )
	{
		$this->email = $email;
	}

	public function setBio( $bio )
	{
		$this->bio = $bio;
	}

	public function setNumlogin( $numlogin )
	{
		$this->numlogin = $numlogin;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	public function setLinguage( $linguage )
	{
		$this->linguage = $linguage;
	}

	public function setTypeuser( Typeuser_Model $typeuser )
	{
		$this->typeuser = $typeuser;
	}

	public function setLastlogin( $lastlogin )
	{
		$this->lastlogin = $lastlogin;
	}

	public function setStatus( $status )
	{
		$this->status = $status;
	}

	public function setToken( $token )
	{
		$this->token = $token;
	}

	public function setPath( $path )
	{
		$this->path = $path;
	}

	public function setViews( $views )
	{
		$this->views = $views;
	}

	public function setWebsite( $website )
	{
		$this->website = $website;
	}

	public function setGithub( $github )
	{
		$this->github = $github;
	}

	public function setFacebook( $facebook )
	{
		$this->facebook = $facebook;
	}

	public function setTwitter( $twitter )
	{
		$this->twitter = $twitter;
	}

	public function setYoutube( $youtube )
	{
		$this->youtube = $youtube;
	}


	/**
	* Metodos get's
	*/
	public function getId_user()
	{
		return $this->id_user;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getBio()
	{
		return $this->bio;
	}

	public function getNumlogin()
	{
		return $this->numlogin;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getLinguage()
	{
		return $this->linguage;
	}

	public function getTypeuser()
	{
		return $this->typeuser;
	}

	public function getLastlogin()
	{
		return $this->lastlogin;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getToken()
	{
		return $this->token;
	}

	public function getPath()
	{
		return $this->path;
	}

	public function getViews()
	{
		return $this->views;
	}

	public function getWebsite()
	{
		return $this->website;
	}

	public function getGithub()
	{
		return $this->github;
	}

	public function getFacebook()
	{
		return $this->facebook;
	}

	public function getTwitter()
	{
		return $this->twitter;
	}

	public function getYoutube()
	{
		return $this->youtube;
	}

	/**
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "user", $data ) ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return true;
	}

	/**
	* Metodo edit
	*/
	public function edit( $data, $id )
	{
		$this->db->beginTransaction();

		if( !$update = $this->db->update("user", $data, "id_user = {$id} ") ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $update;
	}

	/**
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->db->beginTransaction();

		if( !$delete = $this->db->delete("user", "id_user = {$id} ") ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/**
	* Metodo obterUser
	*/
	public function obterUser( $id_user )
	{
		$sql  = "select * ";
		$sql .= "from user ";
		$sql .= "where id_user = :id ";

		$result = $this->db->select( $sql, array("id" => $id_user) );
		return $this->montarObjeto( $result[0] );
	}

	/**
	* Metodo obterUser
	*/
	public function obterUserByLogin( $login )
	{
		$sql  = "select * ";
		$sql .= "from user ";
		$sql .= "where login = :login ";

		$result = $this->db->select( $sql, array("login" => $login) );
		return $this->montarObjeto( $result[0] );
	}

	/**
	 * Metodo obterUserByEmail
	 * @param unknown $id_user
	 */
	public function obterUserByEmail( $email )
	{
		$sql  = "select * ";
		$sql .= "from user as u ";
		$sql .= "where u.email = :email ";

		$result = $this->db->select( $sql, array("email" => trim($email))  );
		return $this->montarObjeto( $result[0] );
	}

	/**
	 * Metodo obterUserByToken
	 * @param unknown $id_user
	 */
	public function obterUserByToken( $token )
	{
		$sql  = "select * ";
		$sql .= "from user as u ";
		$sql .= "where u.token = :token ";

		$result = $this->db->select( $sql, array("token" => trim($token))  );
		return $this->montarObjeto( $result[0] );
	}

	/**
	 * Metodo listarUser
	 */
	public function listarUserTeste($return = NULL)
	{
		Session::init();
		//
		$quantidade = 10;
		$page = isset($_GET['page']) && $_GET['page'] > 0 ? $_GET['page'] : 1;
		$inicio = ( $page * $quantidade ) - $quantidade;

		$sql  = "select * ";
		$sql .= "from user as u ";

		if( Session::get('userid') != NULL )
		{
			$sql .= "where u.id_user != ". Session::get('userid') ."  ";
			$sql .= "and u.id_user not in(select f.id_user from follow as f where f.id_follower = ". Session::get('userid') .")"; // exclui os users que ja esta seguindo
		}

		$sql .= "order by u.id_user desc ";
		$sql .= "limit {$inicio},{$quantidade} ";

		$result = $this->db->select( $sql );

		if( $return )
			echo json_encode( $result );
		else
			return $this->montarLista($result);
	}

	/**
	* Metodo listarUser
	*/
	public function listarUser()
	{
		$sql  = "select * ";
		$sql .= "from user ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_user like :id "; // Configurar o like com o campo necessario da tabela
			$result = $this->db->select( $sql, array("id" => "%{$_POST["like"]}%") );
		}
		else
			$result = $this->db->select( $sql );

		return $this->montarLista($result);
	}

	/**
	 * Lista o ultimos usuarios cadastrados
	 * @param unknown $limit
	 */
	public function listUserRecent( $limit = NULL )
	{
		$sql  = "select * ";
		$sql .= "from user as u ";
		$sql .= "order by u.id_user desc ";

		if( $limit )
			$sql .= "limit {$limit} ";

		$result = $this->db->select( $sql );
		return $this->montarLista($result);
	}

	/**
	 * Lista o ultimos usuarios cadastrados
	 * para uma lista de sugestoes para seguir
	 *
	 * @param unknown $limit
	 */
	public function listTopWhoToFollow($limit)
	{
		Session::init();

		$sql  = "select * ";
		$sql .= "from user as u ";

		if( Session::get('userid') != NULL )
		{
			$sql .= "where u.id_user != ". Session::get('userid') ."  ";
			$sql .= "and u.id_user not in(select f.id_user from follow as f where f.id_follower = ". Session::get('userid') .")"; // exclui os users que ja esta seguindo
		}

		$sql .= "order by u.id_user desc ";

		if( isset( $limit ) )
			$sql .= "limit {$limit} ";

		$result = $this->db->select( $sql );
		return $this->montarLista($result);
		//echo json_encode( $result );
	}


	/**
	 * Verifica se o e-mail ja existe no banco de dados
	 * @param unknown $email
	 */
	public function checkUserExisting( $email )
	{
		$sql  = 'select * ';
		$sql .= 'from user as u ';
		$sql .= "where u.email = :email ";

		$result = $this->db->select( $sql, array( "email" => $email ) );

		if( count( $result ) > 0 )
			return true;
		else
			return false;
	}

	/**
	* Metodo montarLista
	*/
	private function montarLista( $result )
	{
		$objs = array();
		if( !empty( $result ) )
		{
			foreach( $result as $row )
			{
				$obj = new self();
				$obj->montarObjeto( $row );
				$objs[] = $obj;
				$obj = null;
			}
		}
		return $objs;
	}

	/**
	* Metodo montarObjeto
	*/
	private function montarObjeto( $row )
	{
		$this->setId_user( $row["id_user"] );
		$this->setName( $row["name"] );
		$this->setLogin( $row["login"] );
		$this->setPassword( $row["password"] );
		$this->setEmail( $row["email"] );
		$this->setBio( $row["bio"] );
		$this->setNumlogin( $row["numlogin"] );
		$this->setDate( $row["date"] );
		$this->setLinguage( $row["linguage"] );

		$objTypeuser = new Typeuser_Model();
		$objTypeuser->obterTypeuser( $row["id_typeuser"] );
		$this->setTypeuser( $objTypeuser );
		$this->setLastlogin( $row["lastlogin"] );
		$this->setStatus( $row["status"] );
		$this->setToken( $row['token'] );
		$this->setPath( $row['path'] );
		$this->setViews( $row["views"] );
		$this->setWebsite( $row["website"] );
		$this->setGithub( $row["github"] );
		$this->setFacebook( $row["facebook"] );
		$this->setTwitter( $row["twitter"] );
		$this->setYoutube( $row["youtube"] );

		return $this;
	}
}
?>
