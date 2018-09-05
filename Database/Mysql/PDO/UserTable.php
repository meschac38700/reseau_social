<?php 

namespace Database\Mysql\PDO;

class UserTable
{

	private static $pdo = null;

	private $last_name;
	private $first_name;
	private $email;
	private $pseudo;
	private $password;
	private $token;
	private $identifier;

	public function __construct( $data )
	{
		try
		{
			if(!self::$pdo)
			{
				include(__DIR__ . '/../../../config/database.php');
				self::$pdo = new \PDO(
					'mysql:host=' . $config['database']['host'] .
						';dbname=' . $config['database']['dbname'],
					$config['database']['user'],
					$config['database']['password']
				);
				self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);

			}
			$this->last_name = $data['last_name'] ?? null;
			$this->first_name = $data['first_name'] ?? null;
			$this->email = $data['email'] ?? null;
			$this->pseudo = $data['pseudo'] ?? null;
			$this->password = $data['password'] ?? null;
			$this->identifier = $data['identifier'] ?? null;
			$this->token = $data['token'] ?? null;
			
		}
		catch(\Exception $e)
		{
			die('impossible de se connecter à la bdd !\n'.$e->getMessage());
		}
	}

	/**
	 * Getters and setters
	 */

	public function getToken()
	{
		return $this->token;
	}
	
	public function setToken( $new_token )
	{
		$this->token = $new_token;
	}
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


	public static function getPDO()
	{
		return self::$pdo;
	}

    /**
     * get an user idenfied by his password
     * @param $password
     * @return mixed|null
     */
	public function checkPassword( $password )
    {
        try
        {
            $request =  "SELECT * FROM users WHERE password= :password";
            $query = self::$pdo->prepare($request);
            $query->execute(['password'=>sha1($password)]);
            return $query->rowCount();
        }
        catch(\Exception $e){}
		return null;
    }

	public function delete( $pseudo )
	{
		$requete = "DELETE FROM users WHERE pseudo='". $pseudo ."'";
		$result = self::$pdo->exec($requete);
		return $result;
	}

	/**
	 * get all the user presents in the DB
	 * @return Array(Object, Object...) 
	 */
	public function all()
	{
		$results = self::$pdo->exec('select * from users');
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
			$query = self::$pdo->prepare("select * from users where pseudo =:pseudo");
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
			$query = self::$pdo->prepare("select * from users where email =:email");
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
            $query = self::$pdo->prepare("select * from users where id =:id");
			$query->execute( ['id'=> $id ?? $this->id] );
			return $query->fetch();
		}
		catch(\Exception $e)
		{
			return null;
		}
	}
	/**
	 * specifique query, that can be insert query for example 
	 */
	public static function query(string $request, array $data=null )
	{
		try
		{
			$query = self::$pdo->prepare($request);
			$query->execute($data);
			if( $query->rowCount()>0)
			{
				return $query->fetch();
			}
		}
		catch(\Exception $e){}
		return null;
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
		elseif( preg_match('%^_[a-z0-9]+%i', $filter??$this->identifier))
		{
			$user = $this->getByToken( $filter );
		}
		else
		{
			$user = $this->getByPseudo( $filter );
		}
		return $user;
	}

	/**
	 *  the current user
	 * @return [type] [description]
	 */
	public function active ($pseudo)
	{
		$request = "UPDATE users SET  active='1' WHERE pseudo = '".$pseudo."'";
		$success = self::$pdo->exec($request);
		return $success;
	}
	/**
	 * identifier an user
	 * @param  [type] $filter [description]
	 * @return [type]         [description]
	 */
	public function identifier($filter=null, $validePassword= false)
	{
		$user = null;
		try
		{
			$user = $this->get($filter);
			if( $user )
			{
				if( $validePassword ) // si demande de validation du mdp utilisateur (ex : en cas de connexion)
				{
					if( $user->password === sha1($this->password) )
					{
						return $user;
					}
					return false;
					return false;
				}
				return $user;//sinon retournons l'utilisateur trouvé
			}
		}
		catch(\Exception $e)
		{}
		return false;
	}

	public function getByToken( $p_token=null )
	{
		$request = "SELECT * FROM users WHERE token=:token";
		$query = self::$pdo->prepare($request);
		$query->execute(['token'=>$token??$this->token]);
		if( $query->rowCount() > 0 )
		{
			return $query->fetch();
		}
		return null;
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
			$requete 	= "insert into users(last_name, first_name, email, password, pseudo, token) values(:last_name, :first_name, :email, :password, :pseudo, :token)";

			$query 		= self::$pdo->prepare($requete);

			$query->execute([
				'last_name' 		=> $this->last_name,
				'first_name' 		=> $this->first_name,
				'email' 			=> $this->email,
				'password' 			=> sha1($this->password),
				'pseudo' 			=> $this->pseudo,
				'token'				=> $this->token
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