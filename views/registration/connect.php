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
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var elephantsGroup\user\models\User $model
 * @var elephantsGroup\user\models\Account $account
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 text-center">
                <div class="row form-login">
					<div class="panel-heading">
						<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
					</div>
					<div class="panel-body">
						<div class="alert alert-info">
							<p>
								<?= Yii::t(
									'user',
									'In order to finish your registration, we need you to enter following fields'
								) ?>:
							</p>
						</div>
						<?php $form = ActiveForm::begin([
							'id' => 'connect-account-form',
						]); ?>

						<?= $form->field($model, 'email') ?>

						<?= $form->field($model, 'username') ?>

						<?= Html::submitButton(Yii::t('user', 'Continue'), ['class' => 'btn btn-success btn-block']) ?>

						<?php ActiveForm::end(); ?>
					</div>
				</div>
				<p class="text-center">
					<?= Html::a(
						Yii::t(
							'user',
							'If you already registered, sign in and connect this account on settings page'
						),
						['/user/settings/networks']
					) ?>.
				</p>
			</div>
				</div>
            </div>
        </div>
    </div>
</section>  