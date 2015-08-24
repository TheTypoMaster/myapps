<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $saltPassword
 * @property string $email
 * @property string $joinDate
 * @property integer $level_id
 * @property string $avatar
 */
class User extends CActiveRecord
{

	public $password2;
	public $verifyCode;
	public $isActive;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('username, password, email,saltPassword,avatar,verifyCode,level_id', 'required','message'=>'{attribute} cannot be blank'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
			array('level_id', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			array('username', 'unique','message'=>'This Username is already in use'),
			array('email','email'),
			array('password, saltPassword, email', 'length', 'max'=>50),
			array('avatar','file', 'types'=>'gif,png,jpg'),
			array('id, username, password, saltPassword, email, joinDate, level_id, avatar, isActive', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		'level' => array(self::BELONGS_TO, 'Level', 'level_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'saltPassword' => 'Confirm Password',
			'email' => 'Email',
			'joinDate' => 'Join Date',
			'level_id' => 'Level',
			'avatar' => 'Profile Picture',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('saltPassword',$this->saltPassword,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('joinDate',$this->joinDate,true);
		$criteria->compare('level_id',$this->level_id);
		$criteria->compare('avatar',$this->avatar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


		public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->saltPassword)===$this->password;
	}
	
	public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}


	public function generateSalt()
	{
		return uniqid('',true);
	}
	
	public function status($ii)
	{
		if($ii==0)
			return 'Belum Aktif / Banned';
		else 
			return 'Aktif';
	}
	
	public function getFullName() {
    return $this->username;
	}
	public function getSuggest($q) {
    $c = new CDbCriteria();
    $c->addSearchCondition('username', $q, true, 'OR');
    $c->addSearchCondition('email', $q, true, 'OR');
    return $this->findAll($c);
	}
}