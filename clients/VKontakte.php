<?php

/**
 *
 * @name : eg-user
 * @Version 1.0.0
 * @Author : Jalal Jaberi
 *
 * based on Dektrium user <http://github.com/dektrium>
 */

namespace elephantsGroup\user\clients;

use Yii;
use yii\authclient\clients\VKontakte as BaseVKontakte;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class VKontakte extends BaseVKontakte implements ClientInterface
{
    /** @inheritdoc */
    public $scope = 'email';

    /** @inheritdoc */
    public function getEmail()
    {
        return $this->getAccessToken()->getParam('email');
    }

    /** @inheritdoc */
    public function getUsername()
    {
        return isset($this->getUserAttributes()['screen_name'])
            ? $this->getUserAttributes()['screen_name']
            : null;
    }

    /** @inheritdoc */
    protected function defaultTitle()
    {
        return Yii::t('user', 'VKontakte');
    }
}
