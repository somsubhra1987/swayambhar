<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate())
        {
	        $user = $this->getUser(); /* Check the credentials on user identity page*/
	        if($user)
	        {
                if(isset($user->active) && $user->active == 0)
                {
                    $this->addError('password', "Account has been deactivated !");
                }
                elseif($user->validateCredentials($this->username, $this->password))
                {
                    $login = Yii::$app->user->login($this->getUser());
                    return $login;
                }
                else
                {
                    $this->addError('password', "Incorrect username or password !");
                }
        	}
        	else
        	{
                $this->addError('password', "Incorrect username or password !");
        	}
            return false;        	        	
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByCredentials($this->username, $this->password);
        }

        return $this->_user;
    }
}
