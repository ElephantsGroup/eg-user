<?php

/**
 *
 * @name : eg-user
 * @Version 1.0.0
 * @Author : Jalal Jaberi
 *
 * based on Dektrium user <http://github.com/dektrium>
 */

namespace elephantsGroup\user\events;

use yii\base\Event;
use yii\base\Model;

/**
 * @property Model $model
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class FormEvent extends Event
{
    /**
     * @var Model
     */
    private $_form;

    /**
     * @return Model
     */
    public function getForm()
    {
        return $this->_form;
    }

    /**
     * @param Model $form
     */
    public function setForm(Model $form)
    {
        $this->_form = $form;
    }
}
