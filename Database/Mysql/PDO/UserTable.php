<?php 

namespace Database\Mysql\PDO;

class UserTable
{

	private $pdo;

	private $last_name;
	private $first_name;
	private $email;
	private $pseudo;
	private $password;
	private $identifier;

	public function __construct( $data )
	{
		include(__DIR__.'/../../../config/app.php');
		$this->pdo = new \PDO(
								'mysql:host='.$config['database']['host'].
								';dbname='.$config['database']['dbname'],
								$config['database']['user'],
								$config['database']['password']
							);
		$this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
		$this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);

		$this->last_name	= $data['last_name']??null;
		$this->first_name	= $data['first_name']??null; 
		$this->email 		= $data['email']??null;
		$this->pseudo		= $data['pseudo']??null;
		$this->password		= $data['password']??null;
		$this->identifier	= $data['identifier']??null;
	}

	/**
	 * Getters and setters
	 */
	
	public function getLastName()
	{
		return $this->last_name;
	}

	public function getFirstName()
	{
		return $this->first_name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPseudo()
	{
		return $this->pseudo;
	}
	public function getPassword()
	{
		return $this->password;
	}


	public function setLastName( $new_last_name)
	{
		$this->last_name = $new_last_name;
	}

	public function setFirstName( $new_first_name)
	{
		$this->first_name = $new_first_name;
	}

	public function setEmail( $new_email )
	{
		$this->email = $new_email;
	}

	public function setPseudo( $new_pseudo )
	{
		$this->pseudo = $new_pseudo;
	}
	public function setPassword( $new_password )
	{
		$this->password = $new_password;
	}


	public function getPDO()
	{
		return $this->pdo;
	}

	/**
	 * get all the user presents in the DB
	 * @return Array(Object, Object...) 
	 */
	public function all()
	{
		$results = $this->pdo->query('select * from users');
		return $results;
	}

	/**
	 * get only one user identified by his pseudo
	 * @param  string $pseudo user's pseudo
	 * @return Object      an user
	 */
	private function getByPseudo( $pseudo  = null )
	{
		try
		{
			$query = $this->pdo->prepare("select * from users where pseudo =:pseudo");
			$query->execute( ['pseudo'=> $pseudo ?? $this->identifier] );
			return $query->fetch();
		}
		catch(\Exception $e)
		{
			return null;
		}
	}

	/**
	 * get only one user identified by his email
	 * @param  string $email user's email
	 * @return Object      an user
	 */
	private function getByEmail( $email = null )
	{
		try
		{
			$query = $this->pdo->prepare("select * from users where email =:email");
			$query->execute( ['email'=>$email ?? $this->identifier] );
			return $query->fetch();
		}
		catch(\Exception $e)
		{
			return null;
		}
	}

	/**
	 * get only one user identified by his id
	 * @param  integer $id user's identifier
	 * @return Object      an user
	 */
	private function getById( $id = null )
	{
		try
		{
			$result = $this->pdo->query("select * from users where id =:id");
			$query->execute( ['id'=>$id ?? $this->id] );
			return $query->fetch();
		}
		catch(\Exception $e)
		{
			return null;
		}
	}
	/**
	 * get only one user identified either by pseudo or by email or by id
	 * @param  [type] $filter [description]
	 * @return [type]         [description]
	 */
	public function get( $filter = null )
	{
		$user = null;
		if( is_numeric($filter??$this->identifier) )
		{
			$user = $this->getById( $filter );
		}
		elseif( preg_match('%@%i', $filter??$this->identifier) )
		{
			$user = $this->getByEmail( $filter );
		}
		else
		{
			$user = $this->getByPseudo( $filter );
		}
		return $user;
	}

	public function identifier()
	{
		$user = null;
		try
		{
			$user = $this->get();
			if( $user && $user->password === sha1($this->password) )
			{
				return $user;
			}
		}
		catch(\Exception $e)
		{}
		return false;
	}

	/**
	 * insert an user into the db
	 * @param  Array $data user's data
	 * @return Array       
	 */
	public function insert( )
	{
		$execution=[];
		try
		{
			$requete 	= "insert into users(last_name, first_name, email, password, pseudo) values(:last_name, :first_name, :email, :password, :pseudo)";

			$query 		= $this->pdo->prepare($requete);

			$query->execute([
				'last_name' 		=> $this->last_name,
				'first_name' 		=> $this->first_name,
				'email' 			=> $this->email,
				'password' 			=> sha1($this->password),
				'pseudo' 			=> $this->pseudo
			]);
			$execution['status'] 	= true;
			$execution['message'] 	= "successful operation";
		}
		catch(\Exception $e)
		{
			$execution['status'] 	= false;
			$execution['message'] 	= $e->getMessage();
		}
		return $execution;

	}

}