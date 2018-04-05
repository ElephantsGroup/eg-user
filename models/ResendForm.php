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

use elephantsGroup\user\Finder;
use elephantsGroup\user\Mailer;
use yii\base\Model;

/**
 * ResendForm gets user email address and if user with given email is registered it sends new confirmation message
 * to him in case he did not validate his email.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class ResendForm extends Model
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var Mailer
     */
    protected $mailer;

    /**
     * @var Finder
     */
    protected $finder;

    /**
     * @param Mailer $mailer
     * @param Finder $finder
     * @param array  $config
     */
    public function __construct(Mailer $mailer, Finder $finder, $config = [])
    {
        $this->mailer = $mailer;
        $this->finder = $finder;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'emailRequired' => ['email', 'required'],
            'emailPattern' => ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => \Yii::t('user', 'Email'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function formName()
    {
        return 'resend-form';
    }

    /**
     * Creates new confirmation token and sends it to the user.
     *
     * @return bool
     */
    public function resend()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = $this->finder->findUserByEmail($this->email);

        if ($user instanceof User && !$user->isConfirmed) {
            /** @var Token $token */
            $token = \Yii::createObject([
                'class' => Token::className(),
                'user_id' => $user->id,
                'type' => Token::TYPE_CONFIRMATION,
            ]);
            $token->save(false);
            $this->mailer->sendConfirmationMessage($user, $token);
        }

        \Yii::$app->session->setFlash(
            'info',
            \Yii::t(
                'user',
                'A message has been sent to your email address. It contains a confirmation link that you must click to complete registration.'
            )
        );

        return true;
    }
}
