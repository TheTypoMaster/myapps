<?php
/* @var $this CurrentController */
/* @var $data Current */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tradeReceive')); ?>:</b>
	<?php echo CHtml::encode($data->tradeReceive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otherReceive')); ?>:</b>
	<?php echo CHtml::encode($data->otherReceive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amountSub')); ?>:</b>
	<?php echo CHtml::encode($data->amountSub); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amountAssc')); ?>:</b>
	<?php echo CHtml::encode($data->amountAssc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fixedDeposit')); ?>:</b>
	<?php echo CHtml::encode($data->fixedDeposit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cash_bank')); ?>:</b>
	<?php echo CHtml::encode($data->cash_bank); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('total_2')); ?>:</b>
	<?php echo CHtml::encode($data->total_2); ?>
	<br />

	*/ ?>

</div>