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
use yii\authclient\clients\Yandex as BaseYandex;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Yandex extends BaseYandex implements ClientInterface
{
    /** @inheritdoc */
    public function getEmail()
    {
        $emails = isset($this->getUserAttributes()['emails'])
            ? $this->getUserAttributes()['emails']
            : null;

        if ($emails !== null && isset($emails[0])) {
            return $emails[0];
        } else {
            return null;
        }
    }

    /** @inheritdoc */
    public function getUsername()
    {
        return isset($this->getUserAttributes()['login'])
            ? $this->getUserAttributes()['login']
            : null;
    }

    /** @inheritdoc */
    protected function defaultTitle()
    {
        return Yii::t('user', 'Yandex');
    }
}
