<?php

/**
 *
 * @name : eg-user
 * @Version 1.0.0
 * @Author : Jalal Jaberi
 *
 * based on Dektrium user <http://github.com/dektrium>
 */

namespace elephantsGroup\user\traits;

use elephantsGroup\user\events\AuthEvent;
use elephantsGroup\user\events\ConnectEvent;
use elephantsGroup\user\events\FormEvent;
use elephantsGroup\user\events\ProfileEvent;
use elephantsGroup\user\events\ResetPasswordEvent;
use elephantsGroup\user\events\UserEvent;
use elephantsGroup\user\models\Account;
use elephantsGroup\user\models\Profile;
use elephantsGroup\user\models\RecoveryForm;
use elephantsGroup\user\models\Token;
use elephantsGroup\user\models\User;
use yii\authclient\ClientInterface;
use yii\base\Model;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
trait EventTrait
{
    /**
     * @param  Model     $form
     * @return FormEvent
     * @throws \yii\base\InvalidConfigException
     */
    protected function getFormEvent(Model $form)
    {
        return \Yii::createObject(['class' => FormEvent::className(), 'form' => $form]);
    }

    /**
     * @param  User      $user
     * @return UserEvent
     * @throws \yii\base\InvalidConfigException
     */
    protected function getUserEvent(User $user)
    {
        return \Yii::createObject(['class' => UserEvent::className(), 'user' => $user]);
    }

    /**
     * @param  Profile      $profile
     * @return ProfileEvent
     * @throws \yii\base\InvalidConfigException
     */
    protected function getProfileEvent(Profile $profile)
    {
        return \Yii::createObject(['class' => ProfileEvent::className(), 'profile' => $profile]);
    }


    /**
     * @param  Account      $account
     * @param  User         $user
     * @return ConnectEvent
     * @throws \yii\base\InvalidConfigException
     */
    protected function getConnectEvent(Account $account, User $user)
    {
        return \Yii::createObject(['class' => ConnectEvent::className(), 'account' => $account, 'user' => $user]);
    }

    /**
     * @param  Account         $account
     * @param  ClientInterface $client
     * @return AuthEvent
     * @throws \yii\base\InvalidConfigException
     */
    protected function getAuthEvent(Account $account, ClientInterface $client)
    {
        return \Yii::createObject(['class' => AuthEvent::className(), 'account' => $account, 'client' => $client]);
    }

    /**
     * @param  Token        $token
     * @param  RecoveryForm $form
     * @return ResetPasswordEvent
     * @throws \yii\base\InvalidConfigException
     */
    protected function getResetPasswordEvent(Token $token = null, RecoveryForm $form = null)
    {
        return \Yii::createObject(['class' => ResetPasswordEvent::className(), 'token' => $token, 'form' => $form]);
    }
}
