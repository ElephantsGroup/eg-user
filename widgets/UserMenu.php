<?php

/**
 *
 * @name : eg-user
 * @Version 1.0.0
 * @Author : Jalal Jaberi
 *
 * based on Dektrium user <http://github.com/dektrium>
 */

namespace elephantsGroup\user\widgets;

use yii\widgets\Menu;
use Yii;
use yii\base\Widget;

/**
 * User menu widget.
 */
class UserMenu extends Widget
{
    
    /** @array \elephantsGroup\user\models\RegistrationForm */
    public $items;
    
    public function init()
    {
        parent::init();
        
        $networksVisible = count(Yii::$app->authClientCollection->clients) > 0;
        
        $this->items = [
                ['label' => Yii::t('user', 'Profile'), 'url' => ['/user/settings/profile']],
                ['label' => Yii::t('user', 'Account'), 'url' => ['/user/settings/account']],
                [
                    'label' => Yii::t('user', 'Networks'),
                    'url' => ['/user/settings/networks'],
                    'visible' => $networksVisible
                ],
            ];
    }
    
    /**
     * @inheritdoc
     */
    public function run()
    {
        return Menu::widget([
            'options' => [
                'class' => 'nav nav-pills nav-stacked',
            ],
            'items' => $this->items,
        ]);
    }
}
