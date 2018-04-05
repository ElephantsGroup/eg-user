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
 * @var elephantsGroup\user\models\ResendForm $model
 */

$this->title = Yii::t('user', 'Request new confirmation message');
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
						<?php $form = ActiveForm::begin([
							'id' => 'resend-form',
							'enableAjaxValidation' => true,
							'enableClientValidation' => false,
						]); ?>

						<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

						<?= Html::submitButton(Yii::t('user', 'Continue'), ['class' => 'btn btn-primary btn-block']) ?><br>

						<?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
		</div>
    </div>
</section>  
