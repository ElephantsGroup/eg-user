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

use yii\authclient\clients\Google as BaseGoogle;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Google extends BaseGoogle implements ClientInterface
{
    /** @inheritdoc */
    public function getEmail()
    {
        return isset($this->getUserAttributes()['emails'][0]['value'])
            ? $this->getUserAttributes()['emails'][0]['value']
            : null;
    }

    /** @inheritdoc */
    public function getUsername()
    {
        return;
    }
}
