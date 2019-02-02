<?php

/**
 *
 * @name : eg-user
 * @Version 1.0.0
 * @Author : Jalal Jaberi
 *
 * based on Dektrium user <http://github.com/dektrium>
 */

namespace elephantsGroup\user\models;

use elephantsGroup\user\traits\ModuleTrait;
use yii\db\ActiveRecord;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string  $first_name
 * @property string  $last_name
 * @property string  $mobile
 * @property string  $thumb
 * @property string  $public_email
 * @property string  $location
 * @property string  $website
 * @property string  $bio
 * @property string  $timezone
 * @property string  $creation_time
 * @property string  $update_time
 * @property User    $user
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class Profile extends ActiveRecord
{
    use ModuleTrait;
    /** @var \elephantsGroup\user\Module */
    protected $module;

    public $image_file;

    public static $upload_url;
    public static $upload_path;

    /** @inheritdoc */
    public function init()
    {
        $this->module = \Yii::$app->getModule('user');
        self::$upload_path = str_replace('/backend', '', Yii::getAlias('@webroot')) . '/uploads/eg-user/user/';
        self::$upload_url = str_replace('/backend', '', Yii::getAlias('@web')) . '/uploads/eg-user/user/';
        parent::init();
    }

    // /**
    //  * Returns avatar url or null if avatar is not set.
    //  * @param  int $size
    //  * @return string|null
    //  */
    // public function getAvatarUrl($size = 200)
    // {
    //     return '//gravatar.com/avatar/' . $this->gravatar_id . '?s=' . $size;
    // }

    /**
     * @return \yii\db\ActiveQueryInterface
     */
    public function getUser()
    {
        return $this->hasOne($this->module->modelMap['User'], ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // 'bioString'            => ['bio', 'string'],
            // 'timeZoneValidation'   => ['timezone', 'validateTimeZone'],
            // 'publicEmailPattern'   => ['public_email', 'email'],
            // 'websiteUrl'           => ['website', 'url'],
            // 'firstNameLength'      => ['first_name', 'string', 'max' => 255],
            // 'lastNameLength'       => ['last_name', 'string', 'max' => 255],
            // 'publicEmailLength'    => ['public_email', 'string', 'max' => 255],
            // 'locationLength'       => ['location', 'string', 'max' => 255],
            // 'websiteLength'        => ['website', 'string', 'max' => 255],
            [['website', 'location', 'public_email', 'last_name', 'first_name'], 'string', 'max' => 255],
            [['bio'], 'string'],
            [['mobile'], 'string', 'max' => 32],
            [['timezone'], 'validateTimeZone'],
            [['public_email'], 'email'],
            [['website'], 'url'],
            [['creation_time', 'update_time'], 'date', 'format'=>'php:Y-m-d H:i:s'],
            [['image_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false],
            [['user_id'], 'required'],
            [['thumb'], 'default', 'value'=>'default.png'],
						[['update_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')],
						[['creation_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
      $module = \Yii::$app->getModule('base');
        return [
          'user_id' => $module::t('User ID'),
          'first_name' => $module::t('First Name'),
          'last_name' => $module::t('Last Name'),
          'mobile' => $module::t('Mobile'),
          'public_email' => $module::t('Email (public)'),
          'thumb' => $module::t('Thumbnail'),
          'location' => $module::t('Location'),
          'website' => $module::t('Website'),
          'bio' => $module::t('Bio'),
          'timezone' => $module::t('Time zone'),
          'creation_time' => $module::t('Creation Time'),
          'update_time' => $module::t('Update Time'),
        ];
    }

    /**
     * Validates the timezone attribute.
     * Adds an error when the specified time zone doesn't exist.
     * @param string $attribute the attribute being validated
     * @param array $params values for the placeholders in the error message
     */
    public function validateTimeZone($attribute, $params)
    {
        if (!in_array($this->$attribute, timezone_identifiers_list())) {
            $this->addError($attribute, \Yii::t('user', 'Time zone is not valid'));
        }
    }

    /**
     * Get the user's time zone.
     * Defaults to the application timezone if not specified by the user.
     * @return \DateTimeZone
     */
    public function getTimeZone()
    {
        try {
            return new \DateTimeZone($this->timezone);
        } catch (\Exception $e) {
            // Default to application time zone if the user hasn't set their time zone
            return new \DateTimeZone(\Yii::$app->timeZone);
        }
    }

    /**
     * Set the user's time zone.
     * @param \DateTimeZone $timezone the timezone to save to the user's profile
     */
    public function setTimeZone(\DateTimeZone $timeZone)
    {
        $this->setAttribute('timezone', $timeZone->getName());
    }

    /**
     * Converts DateTime to user's local time
     * @param \DateTime the datetime to convert
     * @return \DateTime
     */
    public function toLocalTime(\DateTime $dateTime = null)
    {
        if ($dateTime === null) {
            $dateTime = new \DateTime();
        }

        return $dateTime->setTimezone($this->getTimeZone());
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
      $date = new \DateTime();
  		$date->setTimestamp(time());
  		$date->setTimezone(new \DateTimezone('Iran'));
  		$this->update_time = $date->format('Y-m-d H:i:s');
  		if($this->isNewRecord)
  			$this->creation_time = $date->format('Y-m-d H:i:s');
      return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
      if($this->image_file)
      {
        $dir = self::$upload_path . $this->user_id . '/';
        if(!file_exists($dir))
          mkdir($dir, 0777, true);
              $file_name = 'profile-' . $this->user_id . '.' . $this->image_file->extension;
              $this->image_file->saveAs($dir . $file_name);
              $this->updateAttributes(['thumb' => $file_name]);
       }
      return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
  	{
  		if($this->thumb != 'default.png')
  		{
  			$file_path = self::$upload_path . $this->user_id . '/' . $this->thumb;
  			if(file_exists($file_path))
  				unlink($file_path);
  		}
  		return parent::beforeDelete();
  	}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }
}
