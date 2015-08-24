<?php $this->pageTitle=Yii::app()->name . ' - ' . MessageModule::t("Compose Message"); ?>
<?php $isIncomeMessage = $viewedMessage->receiver_id == Yii::app()->user->getId() ?>

<?php

$this->breadcrumbs=array(
	'You are viewing your Message.',
);

?>

<table border="1" width="800">
<?php
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_message.JPG', "this is alt tag of image");
?>
</table>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'message-delete-form',
	'enableAjaxValidation'=>false,
	'action' => $this->createUrl('delete/', array('id' => $viewedMessage->id))
)); ?>


	</br>
	<table border="0" cellpadding="0">
	
		<?php $this->endWidget(); ?>
		<tr><td width="500">
		<?php if ($isIncomeMessage): ?>
			<h4 class="breadcrumb">From: <?php echo $viewedMessage->getSenderName() ?></h4></td></tr>
		
		<tr><td>
		<?php else: ?>
			<h4 class="message-to">To: <?php echo $viewedMessage->getReceiverName() ?></h4></td></tr>
		
		<tr><td>
		<?php endif; ?>
		 <h4 class="breadcrumb">Subject: <?php echo CHtml::encode($viewedMessage->subject) ?></h4></td></tr>
		
		<tr><td>
		<span  class="label">
		<?php  echo date(Yii::app()->getModule('message')->dateFormat, strtotime($viewedMessage->created_at)) ?></span>
		
		<div class="message-body">
			<?php echo CHtml::encode($viewedMessage->body) ?>
		</div>
		</td></tr>
		
	</table>
		
		<hr width="500">

		<h2><?php echo MessageModule::t('Reply') ?></h2>

		<div class="form">
			<?php $form = $this->beginWidget('CActiveForm', array(
				'id'=>'message-form',
				'enableAjaxValidation'=>false,
			)); ?>

			<?php echo $form->errorSummary($message); ?>

			<div class="row">
				<?php echo $form->hiddenField($message,'receiver_id'); ?>
				<?php echo $form->error($message,'receiver_id'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($message,'subject'); ?>
				<?php echo $form->textField($message,'subject'); ?>
				<?php echo $form->error($message,'subject'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($message,'body'); ?>
				<?php echo $form->textArea($message,'body'); ?>
				<?php echo $form->error($message,'body'); ?>
			</div>

			<div class="row buttons">
				<?php echo CHtml::submitButton(MessageModule::t("Reply")); ?>
			</div>

	<?php $this->endWidget(); ?>
</div>
