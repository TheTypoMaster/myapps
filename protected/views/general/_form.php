<?php
/* @var $this GeneralController */
/* @var $model General */
/* @var $form CActiveForm */
?>
<script type="text/javascript">
  $(document).ready(function(){
     $("#general-form-update").submit(function(event) {
 
    /* Stop form from submitting normally */
    event.preventDefault();
    /* Get some values from elements on the page: */
    var values = $(this).serialize();
     var company_name = $('#General_company_name option:selected').text();
         values+='&company_name='+company_name;
         
        $.ajax({
       
        type: "post",
        data: values,
        success: function(data){
          
           window.location = "<?php echo Yii::app()->getBaseUrl();?>/index.php/general/admin";
        },
        error:function(){
            
            alert('There is error while submit');
            //$("#result").html('There is error while submit');
        }
    });
  });  
   
  });
 </script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'general-form-update',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


                      <table border="0" width="680">

                <?php echo $form->errorSummary($model); ?>

                <tr><td width="40%">

                        <?php echo $form->labelEx($model,'company_name'); ?>
                </td>
                <td width="60%">
                        <?php echo $form->dropDownList($model, 'company_id',
             
                         CHtml::listData(Registration::model()->findAll('1 ORDER BY company_name'),'company_id','company_name'),array(
                                'prompt'=>'Please Choose',
                                'name' => 'General_company_name',
                                'id' => 'General_company_name',
                                'selected'
//                                'ajax'=>array(
//                                        'type'=>'POST',
//                                        'url'=>CController::createUrl('general/companyIds'),
//                                        'update'=>'#company_id'
//                                ),
                        )
                        ); ?>
                </td></tr>
                <tr><td>
		<?php echo $form->labelEx($model,'year'); ?></td>
		<td>
		<?php echo $form->dropDownList($model,'year',
		 CHtml::listData(Year::model()->findAll(),'year','year'),array('name'=>'year','prompt'=>'Please Choose')
		); ?>
		<?php echo $form->error($model,'year'); ?></td>
                </tr>
               
        

            <?php foreach ($items as $item): ?>
                <tr>
                <?php $star = $item['isMandatory']==true?"<span style='color: red;'>*</span>":"";?>
		<td><?php echo "<label>".$item['name'].$star."</label>"?></td>
                <td><?php echo "<input type='text' name='item_".$item['id']."' value='".$item['value']."' />"?></td>
               </tr>
            <?php endforeach; ?>
	</table>
	<div class="row buttons">
		<button class="btn btn-warning">Update</button>
	</div>
                

<?php $this->endWidget(); ?>

</div><!-- form -->