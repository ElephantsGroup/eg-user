<?php

/**
 *
 * @name : eg-user
 * @Version 1.0.0
 * @Author : Jalal Jaberi
 *
 * based on Dektrium user <http://github.com/dektrium>
 */

namespace elephantsGroup\user\filters;

/**
 * Access rule class for simpler RBAC.
 * @see http://yii2-user.dmeroff.ru/docs/custom-access-control
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class AccessRule extends \yii\filters\AccessRule
{
    /**
     * @inheritdoc
     * */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }

        foreach ($this->roles as $role) {
            if ($role === '?') {
                if (\Yii::$app->user->isGuest) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!\Yii::$app->user->isGuest) {
                    return true;
                }
            } elseif ($role === 'admin') {
                if (!\Yii::$app->user->isGuest && \Yii::$app->user->identity->isAdmin) {
                    return true;
                }
            } elseif ($user->can($role)) {
                return true;
            }
        }

        return false;
    }
}
