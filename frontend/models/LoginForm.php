<?php
namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{

    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;

    public function attributeLabels()
    {
        return [
            'username' => 'username',
            'password' => 'password'
        ];
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * 验证密码
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Mismatch of username and password');
            }
        }
    }

    /**
     * 使用用户名和密码登录
     * @return boolean
     */
    public function login()
    {
        if ($this->validate())
        {
            $model = $this->getUser();
            $isLogin = Yii::$app->user->login($model, $this->rememberMe ? 86400 * 0.7 : 0);
            //登录成功,记录登录时间和IP
            if($isLogin) {

            }
            return $isLogin;
        }

        return false;
    }

    /**
     * 通过username查找用户
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }

}