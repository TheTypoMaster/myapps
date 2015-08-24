<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Messages:sent"); ?>
<?php

$this->breadcrumbs=array(
	'You are viewing Sent Message.',
);

?>

<table border="1" width="800">
<?php
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_message.JPG', "this is alt tag of image");
?>
</table>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>

<h4><?php echo MessageModule::t('Sent Message'); ?></h4>

<?php if ($messagesAdapter->data): ?>
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-delete-form',
		'enableAjaxValidation'=>false,
		'action' => $this->createUrl('delete/')
	)); ?>

	<table class="dataGrid" border="0">
		<tr>
			<td  class="label" width="200" bgcolor="FFCD00">To</td> 
			<td></td>
			<td></td>
			<td  class="label" width="200">Subject</td>
			<td></td>
			<td></td>
			<td  class="label" width="200">Date</td>
		</tr>
	</table>
	<table class="dataGrid" border="0">
		<?php foreach ($messagesAdapter->data as $index => $message): ?>
			<tr>
				<td width="200">
					<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
					<?php echo $form->hiddenField($message,"[$index]id"); ?>
					<?php echo $message->getReceiverName() ?>
				</td>
				<td width="10"></td>
				<td width="200"><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
				<td width="10"></td>
				<td width="200"><span class="date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></td>
			</tr>
		<?php endforeach ?>
		
		<tr>
				
				<td rowspan="4">
				</br>
						<?php echo CHtml::submitButton(MessageModule::t("Delete Selected")); ?>
					
				</td>
	</tr>
	</table>


	<?php $this->endWidget(); ?>

	<?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
<?php endif; ?>
