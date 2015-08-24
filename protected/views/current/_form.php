<?php
/* @var $this CurrentController */
/* @var $model Current */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'current-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tradeReceive'); ?>
		<?php echo $form->textField($model,'tradeReceive'); ?>
		<?php echo $form->error($model,'tradeReceive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'otherReceive'); ?>
		<?php echo $form->textField($model,'otherReceive'); ?>
		<?php echo $form->error($model,'otherReceive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amountSub'); ?>
		<?php echo $form->textField($model,'amountSub'); ?>
		<?php echo $form->error($model,'amountSub'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amountAssc'); ?>
		<?php echo $form->textField($model,'amountAssc'); ?>
		<?php echo $form->error($model,'amountAssc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fixedDeposit'); ?>
		<?php echo $form->textField($model,'fixedDeposit'); ?>
		<?php echo $form->error($model,'fixedDeposit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cash_bank'); ?>
		<?php echo $form->textField($model,'cash_bank'); ?>
		<?php echo $form->error($model,'cash_bank'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_2'); ?>
		<?php echo $form->textField($model,'total_2'); ?>
		<?php echo $form->error($model,'total_2'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->