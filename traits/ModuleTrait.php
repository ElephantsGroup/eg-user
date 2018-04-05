<?php

namespace elephantsGroup\user\traits;

use elephantsGroup\user\Module;

/**
 * Trait ModuleTrait
 *
 * @property-read Module $module
 * @package elephantsGroup\user\traits
 */

trait ModuleTrait
{
    /**
     * @return Module
     */
    public function getModule()
    {
        return \Yii::$app->getModule('user');
    }

    /**
     * @return string
     */
    public static function getDb()
    {
        return \Yii::$app->getModule('user')->getDb();
    }
}
