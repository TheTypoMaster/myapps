<?php
/* @var $this GeneralController */
/* @var $model General */
/* @var $form CActiveForm */
?>




<!--MENU START HERE-->

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
        'id' =>'mcnichols_form'
            )); ?>
                <?php 
                $compaies = Yii::app()->db->createCommand("select C.company_id, C.company_name from tbl_registration as C inner join tbl_item_value as IV on C.company_id = IV.company_id group by C.company_id")->queryAll();

                ?>
                <table width="820">
                    <tr>
                        <td><label>Company <span style="color:red;">*</span></label></td>
                        <td>
                            <select id="accruals_company_id_3" name="accruals_company">
                                    <option value="">Select Company</option>
                                <?php foreach($compaies as $comp):?>
                                <option value="<?php echo $comp["company_id"];?>"><?php echo $comp["company_name"];?></option>
                               <?php endforeach;?>
                            </select>
                        </td>

                    </tr>
                    <tr>
                        <td><label>Year <span style="color: red;">*</span></label></td>
                        <td>
                                    <select id="accruals_model_year_3" name="accruals_model_year">
                                    <option value="">Choose company first</option>
                                    </select>

                        </td>


                    </tr>
                    <tr><td>
                            <label>Error Term in Year (e)</label>
                   </td>
                    <td>
                    <input type="text" name="epsinol">
		</td></tr>
                   
	<tr><td>
		<?php echo $form->labelEx($model,'b0'); ?></td>
		<td>
                    <input type="text" id="b0" name="b0">
		</td></tr>
	<tr><td>
		<?php echo $form->labelEx($model,'b1'); ?></td>
		<td>
                    <input type="text" id="b1" name="b1" >
		</td></tr>
	<tr><td>
		<?php echo $form->labelEx($model,'b2'); ?></td>
		<td>
                    <input type="text" id="b1" name="b2">
		</td></tr>
	<tr><td>
		<?php echo $form->labelEx($model,'b3'); ?></td>
		<td>
                    <input type="text" id="b3" name="b3">
		</td></tr>
	<tr><td>
		<?php echo $form->labelEx($model,'b4'); ?></td>
		<td>
                    <input type="text" id="b4" name="b4">
		</td></tr>
	<tr><td>
		<?php echo $form->labelEx($model,'b5'); ?></td>
		<td>
                    <input type="text" id="b5" name="b5">
		</td></tr>
	<tr><td>
		<?php echo $form->labelEx($model,'b6'); ?></td>
		<td>
                    <input type="text" id="b6" name="b6">
		</td></tr>

<tr><td colspan="2">

	<div class="row buttons">
		 <button  class="btn btn-warning">Calculate</button>
	</div>
</td></tr>

	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->



<!--END OF MENU-->
