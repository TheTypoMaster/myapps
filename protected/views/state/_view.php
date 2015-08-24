<?php
/* @var $this StateController */
/* @var $data State */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('state_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->state_id), array('view', 'id'=>$data->state_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />


</div>