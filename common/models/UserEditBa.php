<?php

namespace common\models;

use Yii;
use yii\base\InvalidParamException;
use yii\base\Model;
use common\models\User;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property string $active
 * @property int $created_at
 * @property int $updated_at
 * @property string $fullname
 * @property string $address
 * @property string $id_prov
 * @property string $id_kab
 * @property string $id_kec
 * @property string $id_kel
 * @property string $nomorHandphone
 * @property string $nomorRumah
 */
class UserEdit extends \yii\db\ActiveRecord
{
    public $oldPassword;
    public $newPassword;
    public $retypePassword;
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'fullname', 'address', 'id_prov', 'id_kab', 'id_kec', 'nomorHandphone'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['fullname'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 500],
            [['id_prov'], 'string', 'max' => 2],
            [['active'], 'string'],
            [['foto'], 'string', 'max' => 500],
            [['file'], 'file'],
            [['id_kab'], 'string', 'max' => 4],
            [['id_kec'], 'string', 'max' => 6],
            [['id_kel'], 'string', 'max' => 10],
            [['nomorHandphone', 'nomorRumah'], 'string', 'max' => 12],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['oldPassword', 'newPassword', 'retypePassword'], 'required'],
            [['oldPassword'], 'validatePassword'],
            [['newPassword'], 'string', 'min' => 6],
            [['retypePassword'], 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'fullname' => 'Fullname',
            'address' => 'Address',
            'id_prov' => 'Provinsi',
            'id_kab' => 'Kabupaten',
            'id_kec' => 'Kecamatan',
            'id_kel' => 'Kelurahan',
            'provinsi.nama' => 'Provinsi',
            'kabupaten.nama' => 'Kabupaten',
            'kecamatan.nama' => 'Kecamatan',
            'kelurahan.nama' => 'Kelurahan',
            'file' => 'Foto',
            'nomorHandphone' => 'Nomor Handphone',
            'nomorRumah' => 'Nomor Rumah',
            'oldPassword' => 'Password Lama',
            'newPassword' => 'Password Baru',
            'retypePassword' => 'Ketikan Kembali Password Baru Anda',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        /* @var $user User */
        $user = Yii::$app->user->identity;
        if (!$user || !$user->validatePassword($this->oldPassword)) {
            $this->addError('oldPassword', 'Incorrect old password.');
        }
    }

    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id_kec' => 'id_kec']);
    }

    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::className(), ['id_prov' => 'id_prov']);
    }

    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::className(), ['id_kab' => 'id_kab']);
    }

    public function getKelurahan()
    {
        return $this->hasOne(Kelurahan::className(), ['id_kel' => 'id_kel']);
    }
}
