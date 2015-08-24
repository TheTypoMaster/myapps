<?php
/* @var $this InputController */
/* @var $data Input */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_name')); ?>:</b>
	<?php echo CHtml::encode($data->company_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_id')); ?>:</b>
	<?php echo CHtml::encode($data->company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year_1')); ?>:</b>
	<?php echo CHtml::encode($data->year_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_1')); ?>:</b>
	<?php echo CHtml::encode($data->pro_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('intangible_1')); ?>:</b>
	<?php echo CHtml::encode($data->intangible_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('development_1')); ?>:</b>
	<?php echo CHtml::encode($data->development_1); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('invest_sub_1')); ?>:</b>
	<?php echo CHtml::encode($data->invest_sub_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invest_aso_1')); ?>:</b>
	<?php echo CHtml::encode($data->invest_aso_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_1')); ?>:</b>
	<?php echo CHtml::encode($data->other_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_1')); ?>:</b>
	<?php echo CHtml::encode($data->total_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tradeReceivable')); ?>:</b>
	<?php echo CHtml::encode($data->tradeReceivable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otherReceivable')); ?>:</b>
	<?php echo CHtml::encode($data->otherReceivable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amountSubsidy')); ?>:</b>
	<?php echo CHtml::encode($data->amountSubsidy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amountAssociated')); ?>:</b>
	<?php echo CHtml::encode($data->amountAssociated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fixedDeposit')); ?>:</b>
	<?php echo CHtml::encode($data->fixedDeposit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cash_bank')); ?>:</b>
	<?php echo CHtml::encode($data->cash_bank); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_2')); ?>:</b>
	<?php echo CHtml::encode($data->total_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otherPayable')); ?>:</b>
	<?php echo CHtml::encode($data->otherPayable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amountOwnSubsidy')); ?>:</b>
	<?php echo CHtml::encode($data->amountOwnSubsidy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amountOwnDirect')); ?>:</b>
	<?php echo CHtml::encode($data->amountOwnDirect); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchasePayable')); ?>:</b>
	<?php echo CHtml::encode($data->purchasePayable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bankOverdraft')); ?>:</b>
	<?php echo CHtml::encode($data->bankOverdraft); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taxation')); ?>:</b>
	<?php echo CHtml::encode($data->taxation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_3')); ?>:</b>
	<?php echo CHtml::encode($data->total_3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('net_current_liabilities')); ?>:</b>
	<?php echo CHtml::encode($data->net_current_liabilities); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shareCapital')); ?>:</b>
	<?php echo CHtml::encode($data->shareCapital); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sharePremium')); ?>:</b>
	<?php echo CHtml::encode($data->sharePremium); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('preferenceShare')); ?>:</b>
	<?php echo CHtml::encode($data->preferenceShare); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('foreignExchange')); ?>:</b>
	<?php echo CHtml::encode($data->foreignExchange); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AccLost')); ?>:</b>
	<?php echo CHtml::encode($data->AccLost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_4')); ?>:</b>
	<?php echo CHtml::encode($data->total_4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('preferenceShare1')); ?>:</b>
	<?php echo CHtml::encode($data->preferenceShare1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('minorityInterest')); ?>:</b>
	<?php echo CHtml::encode($data->minorityInterest); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_5')); ?>:</b>
	<?php echo CHtml::encode($data->total_5); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchasePayable1')); ?>:</b>
	<?php echo CHtml::encode($data->purchasePayable1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taxLiabilities')); ?>:</b>
	<?php echo CHtml::encode($data->taxLiabilities); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_6')); ?>:</b>
	<?php echo CHtml::encode($data->total_6); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('revenue')); ?>:</b>
	<?php echo CHtml::encode($data->revenue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_operating_income')); ?>:</b>
	<?php echo CHtml::encode($data->other_operating_income); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direct_operating_expenses')); ?>:</b>
	<?php echo CHtml::encode($data->direct_operating_expenses); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('administration_expenses')); ?>:</b>
	<?php echo CHtml::encode($data->administration_expenses); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finance_cost')); ?>:</b>
	<?php echo CHtml::encode($data->finance_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shared_lossprofit')); ?>:</b>
	<?php echo CHtml::encode($data->shared_lossprofit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taxation_2')); ?>:</b>
	<?php echo CHtml::encode($data->taxation_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('minority_shared')); ?>:</b>
	<?php echo CHtml::encode($data->minority_shared); ?>
	<br />

	*/ ?>

</div>