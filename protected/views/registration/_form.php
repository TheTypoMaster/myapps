<?php
/* @var $this RegistrationController */
/* @var $model Registration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<table border="0">

	<?php echo $form->errorSummary($model); ?>

	<tr>
		<td width="300">
		<?php echo $form->labelEx($model,'company_name'); ?></td>
		<td>
		<?php echo $form->textField($model,'company_name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'company_name'); ?></td></tr>
	

	<tr><td>
		<?php echo $form->labelEx($model,'company_id'); ?></td>
		<td>
		<?php echo $form->textField($model,'company_id',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'company_id'); ?>
</td></tr>

       	<tr><td>
		<?php echo $form->labelEx($model,'company_email'); ?></td>
		<td>
		<?php echo $form->textField($model,'company_email',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'company_email'); ?>
</td></tr>

<tr><td>		<?php echo $form->labelEx($model,'address'); ?></td>
		<td>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'address'); ?>
</td></tr>

<tr><td>		<?php echo $form->labelEx($model,'postcode'); ?></td>
		<td>
		<?php echo $form->textField($model,'postcode'); ?>
		<?php echo $form->error($model,'postcode'); ?>
</td></tr>

<tr><td>		<?php echo $form->labelEx($model,'city'); ?></td>
		<td>
		<?php echo $form->textField($model,'city',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'city'); ?>
</td></tr>

<tr><td>		<?php echo $form->labelEx($model,'state_id'); ?></td>
		<td>
		<?php echo $form->dropDownList($model,'state_id',
		 CHtml::listData(State::model()->findAll(),'state_id','state'),array('prompt'=>'Please Choose')
		); ?>
		<?php echo $form->error($model,'state_id'); ?>
</td></tr>

<tr><td>		<?php echo $form->labelEx($model,'no_tel'); ?></td>
		<td>
		<?php echo $form->textField($model,'no_tel',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'no_tel'); ?>
</td></tr>

<tr><td colspan="2">		
<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'btn btn-warning')); ?> 
</td></tr>



</td></tr>

	</table>


<?php $this->endWidget(); ?>

</div><!-- form -->