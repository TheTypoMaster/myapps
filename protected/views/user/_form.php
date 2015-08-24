<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
  	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'saltPassword'); ?>
		<?php echo $form->passwordField($model,'saltPassword',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'saltPassword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'level_id'); ?>
		<?php echo $form->dropDownList($model,'level_id',
		CHtml::listData(Level::model()->findAll(),'id','level'),array('prompt'=>'Please Choose')
		
		); ?>
		<?php echo $form->error($model,'level_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php echo $form->fileField($model,'avatar',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>
	
	
	<?php if (extension_loaded('gd')): ?>
        <div class="row">
            <?php echo CHtml::activeLabelEx($model, 'verifyCode') ?>
        	<div>
        		<?php $this->widget('CCaptcha'); ?><br/>
        		<?php echo CHtml::activeTextField($model,'verifyCode'); ?>
        	</div>
        	<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
        </div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->