<?php

/**
 *
 * @name : eg-user
 * @Version 1.0.0
 * @Author : Jalal Jaberi
 *
 * based on Dektrium user <http://github.com/dektrium>
 */

use yii\bootstrap\Nav;

?>

<?= Nav::widget([
    'options' => [
        'class' => 'nav-tabs',
        'style' => 'margin-bottom: 15px',
    ],
    'items' => [
        [
            'label' => Yii::t('user', 'Users'),
            'url' => ['/user/admin/index'],
        ],
        [
            'label' => Yii::t('user', 'Roles'),
            'url' => ['/rbac/role/index'],
            'visible' => isset(Yii::$app->extensions['elephantsGroup/yii2-rbac']),
        ],
        [
            'label' => Yii::t('user', 'Permissions'),
            'url' => ['/rbac/permission/index'],
            'visible' => isset(Yii::$app->extensions['elephantsGroup/yii2-rbac']),
        ],
        [
            'label' => \Yii::t('user', 'Rules'),
            'url'   => ['/rbac/rule/index'],
            'visible' => isset(Yii::$app->extensions['elephantsGroup/yii2-rbac']),
        ],
        [
            'label' => Yii::t('user', 'Create'),
            'items' => [
                [
                    'label' => Yii::t('user', 'New user'),
                    'url' => ['/user/admin/create'],
                ],
                [
                    'label' => Yii::t('user', 'New role'),
                    'url' => ['/rbac/role/create'],
                    'visible' => isset(Yii::$app->extensions['elephantsGroup/yii2-rbac']),
                ],
                [
                    'label' => Yii::t('user', 'New permission'),
                    'url' => ['/rbac/permission/create'],
                    'visible' => isset(Yii::$app->extensions['elephantsGroup/yii2-rbac']),
                ],
                [
                    'label' => \Yii::t('user', 'New rule'),
                    'url'   => ['/rbac/rule/create'],
                    'visible' => isset(Yii::$app->extensions['elephantsGroup/yii2-rbac']),
                ]
            ],
        ],
    ],
]) ?>
