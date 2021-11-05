<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class RestApi extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
      return '{{%api}}';
    }

    public static function findIdentity($id)
    {
        $user = self::find()->where(['id' => $id])->one();
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }

    public static function findIdentityByAccessToken($token, $userType = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {
        $user = self::find()->where(['username' => $username])->one();
        return $user;
    }

    public static function findByUser($username)
    {
        $user = self::find()->where(['username' => $username])->one();
        if (!count($user)) {
            return null;
        }
        return $user;
    }

    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString();
        return $this->access_token;
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password ===  md5($password);
    }

    public static function selectData($where)
    {
        return self::find()->where($where)->one();
    }

    public static function insertData($tabel, $data)
    {
        return Yii::$app->db->createCommand()->insert($tabel, $data)->execute();
    }
}
