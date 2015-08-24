<?php
/* @var $this InputController */
/* @var $model Input */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'input-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'year_1'); ?>
		<?php echo $form->textField($model,'year_1',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'year_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pro_1'); ?>
		<?php echo $form->textField($model,'pro_1'); ?>
		<?php echo $form->error($model,'pro_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'intangible_1'); ?>
		<?php echo $form->textField($model,'intangible_1'); ?>
		<?php echo $form->error($model,'intangible_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'development_1'); ?>
		<?php echo $form->textField($model,'development_1'); ?>
		<?php echo $form->error($model,'development_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invest_sub_1'); ?>
		<?php echo $form->textField($model,'invest_sub_1'); ?>
		<?php echo $form->error($model,'invest_sub_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invest_aso_1'); ?>
		<?php echo $form->textField($model,'invest_aso_1'); ?>
		<?php echo $form->error($model,'invest_aso_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_1'); ?>
		<?php echo $form->textField($model,'other_1'); ?>
		<?php echo $form->error($model,'other_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tradeReceivable'); ?>
		<?php echo $form->textField($model,'tradeReceivable'); ?>
		<?php echo $form->error($model,'tradeReceivable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'otherReceivable'); ?>
		<?php echo $form->textField($model,'otherReceivable'); ?>
		<?php echo $form->error($model,'otherReceivable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amountSubsidy'); ?>
		<?php echo $form->textField($model,'amountSubsidy'); ?>
		<?php echo $form->error($model,'amountSubsidy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amountAssociated'); ?>
		<?php echo $form->textField($model,'amountAssociated'); ?>
		<?php echo $form->error($model,'amountAssociated'); ?>
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
		<?php echo $form->labelEx($model,'otherPayable'); ?>
		<?php echo $form->textField($model,'otherPayable'); ?>
		<?php echo $form->error($model,'otherPayable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amountOwnSubsidy'); ?>
		<?php echo $form->textField($model,'amountOwnSubsidy'); ?>
		<?php echo $form->error($model,'amountOwnSubsidy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amountOwnDirect'); ?>
		<?php echo $form->textField($model,'amountOwnDirect'); ?>
		<?php echo $form->error($model,'amountOwnDirect'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'purchasePayable'); ?>
		<?php echo $form->textField($model,'purchasePayable'); ?>
		<?php echo $form->error($model,'purchasePayable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bankOverdraft'); ?>
		<?php echo $form->textField($model,'bankOverdraft'); ?>
		<?php echo $form->error($model,'bankOverdraft'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'taxation'); ?>
		<?php echo $form->textField($model,'taxation'); ?>
		<?php echo $form->error($model,'taxation'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'net_current_liabilities'); ?>
		<?php echo $form->textField($model,'net_current_liabilities'); ?>
		<?php echo $form->error($model,'net_current_liabilities'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shareCapital'); ?>
		<?php echo $form->textField($model,'shareCapital'); ?>
		<?php echo $form->error($model,'shareCapital'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sharePremium'); ?>
		<?php echo $form->textField($model,'sharePremium'); ?>
		<?php echo $form->error($model,'sharePremium'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'preferenceShare'); ?>
		<?php echo $form->textField($model,'preferenceShare'); ?>
		<?php echo $form->error($model,'preferenceShare'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'foreignExchange'); ?>
		<?php echo $form->textField($model,'foreignExchange'); ?>
		<?php echo $form->error($model,'foreignExchange'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AccLost'); ?>
		<?php echo $form->textField($model,'AccLost'); ?>
		<?php echo $form->error($model,'AccLost'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'preferenceShare1'); ?>
		<?php echo $form->textField($model,'preferenceShare1'); ?>
		<?php echo $form->error($model,'preferenceShare1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minorityInterest'); ?>
		<?php echo $form->textField($model,'minorityInterest'); ?>
		<?php echo $form->error($model,'minorityInterest'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'purchasePayable1'); ?>
		<?php echo $form->textField($model,'purchasePayable1'); ?>
		<?php echo $form->error($model,'purchasePayable1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'taxLiabilities'); ?>
		<?php echo $form->textField($model,'taxLiabilities'); ?>
		<?php echo $form->error($model,'taxLiabilities'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'revenue'); ?>
		<?php echo $form->textField($model,'revenue'); ?>
		<?php echo $form->error($model,'revenue'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_operating_income'); ?>
		<?php echo $form->textField($model,'other_operating_income'); ?>
		<?php echo $form->error($model,'other_operating_income'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direct_operating_expenses'); ?>
		<?php echo $form->textField($model,'direct_operating_expenses'); ?>
		<?php echo $form->error($model,'direct_operating_expenses'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'administration_expenses'); ?>
		<?php echo $form->textField($model,'administration_expenses'); ?>
		<?php echo $form->error($model,'administration_expenses'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'finance_cost'); ?>
		<?php echo $form->textField($model,'finance_cost'); ?>
		<?php echo $form->error($model,'finance_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shared_lossprofit'); ?>
		<?php echo $form->textField($model,'shared_lossprofit'); ?>
		<?php echo $form->error($model,'shared_lossprofit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'taxation_2'); ?>
		<?php echo $form->textField($model,'taxation_2'); ?>
		<?php echo $form->error($model,'taxation_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minority_shared'); ?>
		<?php echo $form->textField($model,'minority_shared'); ?>
		<?php echo $form->error($model,'minority_shared'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->