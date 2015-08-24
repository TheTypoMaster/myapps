<?php
/* @var $this InputController */
/* @var $model Input */
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
		<?php echo $form->label($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'year_1'); ?>
		<?php echo $form->textField($model,'year_1',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_1'); ?>
		<?php echo $form->textField($model,'pro_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'intangible_1'); ?>
		<?php echo $form->textField($model,'intangible_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'development_1'); ?>
		<?php echo $form->textField($model,'development_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invest_sub_1'); ?>
		<?php echo $form->textField($model,'invest_sub_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invest_aso_1'); ?>
		<?php echo $form->textField($model,'invest_aso_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'other_1'); ?>
		<?php echo $form->textField($model,'other_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_1'); ?>
		<?php echo $form->textField($model,'total_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tradeReceivable'); ?>
		<?php echo $form->textField($model,'tradeReceivable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'otherReceivable'); ?>
		<?php echo $form->textField($model,'otherReceivable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amountSubsidy'); ?>
		<?php echo $form->textField($model,'amountSubsidy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amountAssociated'); ?>
		<?php echo $form->textField($model,'amountAssociated'); ?>
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

	<div class="row">
		<?php echo $form->label($model,'otherPayable'); ?>
		<?php echo $form->textField($model,'otherPayable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amountOwnSubsidy'); ?>
		<?php echo $form->textField($model,'amountOwnSubsidy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amountOwnDirect'); ?>
		<?php echo $form->textField($model,'amountOwnDirect'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'purchasePayable'); ?>
		<?php echo $form->textField($model,'purchasePayable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bankOverdraft'); ?>
		<?php echo $form->textField($model,'bankOverdraft'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'taxation'); ?>
		<?php echo $form->textField($model,'taxation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_3'); ?>
		<?php echo $form->textField($model,'total_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'net_current_liabilities'); ?>
		<?php echo $form->textField($model,'net_current_liabilities'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shareCapital'); ?>
		<?php echo $form->textField($model,'shareCapital'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sharePremium'); ?>
		<?php echo $form->textField($model,'sharePremium'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'preferenceShare'); ?>
		<?php echo $form->textField($model,'preferenceShare'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'foreignExchange'); ?>
		<?php echo $form->textField($model,'foreignExchange'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AccLost'); ?>
		<?php echo $form->textField($model,'AccLost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_4'); ?>
		<?php echo $form->textField($model,'total_4'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'preferenceShare1'); ?>
		<?php echo $form->textField($model,'preferenceShare1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'minorityInterest'); ?>
		<?php echo $form->textField($model,'minorityInterest'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_5'); ?>
		<?php echo $form->textField($model,'total_5'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'purchasePayable1'); ?>
		<?php echo $form->textField($model,'purchasePayable1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'taxLiabilities'); ?>
		<?php echo $form->textField($model,'taxLiabilities'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_6'); ?>
		<?php echo $form->textField($model,'total_6'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'revenue'); ?>
		<?php echo $form->textField($model,'revenue'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'other_operating_income'); ?>
		<?php echo $form->textField($model,'other_operating_income'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direct_operating_expenses'); ?>
		<?php echo $form->textField($model,'direct_operating_expenses'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'administration_expenses'); ?>
		<?php echo $form->textField($model,'administration_expenses'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'finance_cost'); ?>
		<?php echo $form->textField($model,'finance_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shared_lossprofit'); ?>
		<?php echo $form->textField($model,'shared_lossprofit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'taxation_2'); ?>
		<?php echo $form->textField($model,'taxation_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'minority_shared'); ?>
		<?php echo $form->textField($model,'minority_shared'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->