<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'calc-kira-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'field1'); ?>
		<?php echo $form->textField($model,'field1'); ?>
		<?php echo $form->error($model,'field1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'field2'); ?>
		<?php echo $form->textField($model,'field2'); ?>
		<?php echo $form->error($model,'field2'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->