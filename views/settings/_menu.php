<?php

/**
 *
 * @name : eg-user
 * @Version 1.0.0
 * @Author : Jalal Jaberi
 *
 * based on Dektrium user <http://github.com/dektrium>
 */

use yii\helpers\Html;
use elephantsGroup\user\widgets\UserMenu;
use elephantsGroup\user\models\Profile;


/**
 * @var elephantsGroup\user\models\User $user
 */

$user = Yii::$app->user->identity;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
          <?php if (!empty($user->profile['thumb']) && $user->profile['thumb'] != "default.png"): ?>
            <?= Html::img(Profile::$upload_url . $user->profile['user_id'] . '/' . $user->profile['thumb'], [
                'class' => 'img-rounded',
                'alt' => $user->username,
            ]) ?>
          <?php endif; ?>
          <?= $user->username ?>
        </h3>
    </div>
    <div class="panel-body">
        <?= UserMenu::widget() ?>
    </div>
</div>
