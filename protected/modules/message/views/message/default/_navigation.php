
<br/>
<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    Action
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    
	<li><a href="<?php echo $this->createUrl('inbox/') ?>">Inbox
		<?php if (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())): ?>
			(<?php echo Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()); ?>)
		<?php endif; ?>
	</a></li>
	<li><a href="<?php echo $this->createUrl('sent/sent') ?>">Sent Message</a></li>
	<li><a href="<?php echo $this->createUrl('compose/') ?>">Compose New Message</a></li>
	
  </ul>
</div>



<?php if(Yii::app()->user->hasFlash('messageModule')): ?>
	<div class="success">
		<?php echo Yii::app()->user->getFlash('messageModule'); ?>
	</div>
<?php endif; ?>
