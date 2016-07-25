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
	private $website;
	private $bio;
	private $numlogin;
	private $date;
	private $linguage;
	private $typeuser;
	private $lastlogin;
	private $status;
	private $token;

	public function __construct()
	{
		parent::__construct();

		$this->id_user = '';
		$this->name = '';
		$this->login = '';
		$this->password = '';
		$this->email = '';
		$this->website = '';
		$this->bio = '';
		$this->numlogin = '';
		$this->date = '';
		$this->linguage = '';
		$this->typeuser = new Typeuser_Model();
		$this->lastlogin = '';
		$this->status = '';
		$this->token = '';
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

	public function setWebsite( $website )
	{
		$this->website = $website;
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

	public function getWebsite()
	{
		return $this->website;
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
		$this->setWebsite( $row["website"] );
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

		return $this;
	}
}
?>