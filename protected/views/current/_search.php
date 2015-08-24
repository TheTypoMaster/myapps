<?php
/* @var $this CurrentController */
/* @var $model Current */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tradeReceive'); ?>
		<?php echo $form->textField($model,'tradeReceive'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'otherReceive'); ?>
		<?php echo $form->textField($model,'otherReceive'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amountSub'); ?>
		<?php echo $form->textField($model,'amountSub'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amountAssc'); ?>
		<?php echo $form->textField($model,'amountAssc'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fixedDeposit'); ?>
		<?php echo $form->textField($model,'fixedDeposit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cash_bank'); ?>
		<?php echo $form->textField($model,'cash_bank'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_2'); ?>
		<?php echo $form->textField($model,'total_2'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->