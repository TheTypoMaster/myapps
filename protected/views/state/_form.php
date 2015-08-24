<?php
/* @var $this StateController */
/* @var $model State */
/* @var $form CActiveForm */
?>


<table border="1" width="800">
<?php
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_state.JPG', "this is alt tag of image");
?>
</table>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'state-form',
	'enableAjaxValidation'=>false,
)); ?>

</br>

	<p class="note">Fields with <span class="required">*</span> are required to insert <b>State</b>.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>
	
<table>
<tr><td>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save', array('class'=>'btn btn-warning')); ?>
		
	</div> </td>
	<td><a href="admin"><button type="button" class="btn btn-warning">Cancel</button></a></td>
	</tr></table>
	
	
	</br></br></br></br></br></br>

<?php $this->endWidget(); ?>

</div><!-- form -->