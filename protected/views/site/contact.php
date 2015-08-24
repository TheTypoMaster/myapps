<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';


$this->breadcrumbs=array(
	'You are about to compose Email to Client/Company.',
);

?>

<table border="1" width="800">
<?php
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_email.JPG', "this is alt tag of image");
?>
</table>
<div class="form">



<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<!--
<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p> -->

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	</br>
	<p class="note">Fields with <span class="required">*</span> are required to compose <b>Email</b>.</p>

	<?php echo $form->errorSummary($model); ?>

	
	<table border="0" cellpadding="0">
	<tr>
	<td width="200">
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?></td>
		<td>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	</td>
	</tr>
	
	<tr>
	<td width="200">
	<div class="row">
	<?php echo CHtml::activeFileField($model,'file'); ?>
	</div>
	</td>
	</tr>
	
	<tr>
	<td>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?></td>
		<td>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	</td>
	</tr>
	
	
	<tr>
	<td>
	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?></td>
		<td>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>
	</td>
	</tr>
	
	
	<tr>
	<td>
	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?></td>
		<td>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>
	</td>
	</tr>
	
	
	<tr>
	<td>
	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?></td>
		<td>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		</br>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>
	</td></tr>

	<tr><td colspan="2">
	<div class="row buttons">
		<?php echo CHtml::submitButton('Send'); ?>
	</div>
	</td></tr>
</table>
<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>