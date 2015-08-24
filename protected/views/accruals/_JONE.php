<?php
/* @var $this GeneralController */
/* @var $model General */
/* @var $form CActiveForm */
?>



<div class="form">
<!--MENU START HERE-->
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
        'id' =>'jone_form'
            )); ?>
                <?php 
                $compaies = Yii::app()->db->createCommand("select C.company_id, C.company_name from tbl_registration as C inner join tbl_item_value as IV on C.company_id = IV.company_id group by C.company_id")->queryAll();

                ?>
                <table width="820">
                    <tr>
                        <td><label>Company <span style="color:red;">*</span></label></td>
                        <td>
                            <select id="accruals_company_id" name="accruals_company">
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
                                    <select id="accruals_model_year" name="accruals_model_year">
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
                    <tr>
                        <td>  <button  class="btn btn-warning">Calculate</button></td>
                        <td></td>
                    </tr>

                </table>
            <?php $this->endWidget(); ?>

</div><!-- form -->



<!--END OF MENU-->
