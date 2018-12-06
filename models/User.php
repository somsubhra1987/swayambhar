<?php
namespace app\models;

use app\lib\Core;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $isActive;
    public $error;
	public $userType;
    
    public static function findIdentity($id)
    {
	    $sql = "SELECT customerID AS id, emailAddress as username
	    		FROM cust_customer
	    		WHERE customerID = :customerID ";
	    		
	   	$user = Core::getRow($sql, array('customerID'=>$id));
        return empty($user) ? null : new static($user);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }
    
    public static function findByCredentials($username, $password)
    {
        $sql = "SELECT customerID AS id, emailAddress as username, password, isActive
        		FROM cust_customer
        		WHERE emailAddress = :emailAddress AND password = MD5(:password)";
        			
        $user = Core::getRow($sql, array('emailAddress'=>$username,'password'=>$password));
        if(!empty($user) && isset($user))
        {
          return empty($user) ? null : new static($user);
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $sql = "SELECT customerID AS id, emailAddress as username
	    		FROM cust_customer
	    		WHERE emailAddress = :emailAddress";
	    		
	   	$user = Core::getRow($sql, array('emailAddress'=>$username));	   
        return empty($user) ? null : new static($user);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validateCredentials($username, $password)
    {
	    /*$password = Db::getMd5Value($password);*/
	    
	    $sql = "SELECT customerID AS id
	    		FROM cust_customer
	    		WHERE emailAddress = :emailAddress
	    			AND password = MD5(:password)
	    			AND isActive = 1";
	    		
	   	$id = Core::getData($sql, array('emailAddress'=>$username,'password'=>$password));
	   	
	   	if($id) return true;
	   	return false;
    }
    
}