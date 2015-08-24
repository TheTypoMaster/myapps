<?php
/* @var $this AccrualsController */

$this->breadcrumbs=array(
	'report',
);
?>

<script type="text/javascript">
     $(document).ready(function(){
        
        $("#report_company_id").change(function (){
            $("#company_name").val($('#report_company_id option:selected').text())
        });
        
        
    });
    
</script>
<table border="1" width="800">
<?php
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_report.JPG', "this is alt tag of image");
?>
</table>
</br>

<div>
    <?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
        'id' =>'report_form'
            )); ?>
                <?php 
                $compaies = Yii::app()->db->createCommand("select C.company_id, C.company_name from tbl_registration as C inner join tbl_item_value as IV on C.company_id = IV.company_id group by C.company_id")->queryAll();

                ?>
                <table width="820" border="0">
                    <tr>
                        <td><label>Company <span style="color:red;">*</span></label></td>
                        <td width="300">
                            <select id="report_company_id" name="report_company_id">
                                    <option value="">Select Company</option>
                                <?php foreach($compaies as $comp):?>
                                <option value="<?php echo $comp["company_id"];?>"><?php echo $comp["company_name"];?></option>
                               <?php endforeach;?>
                            </select>
                            <input type="hidden" name="company_name" value="" id="company_name">
                        </td>

                    
                        <td> <button  class="btn btn-warning">Generate Report</button></td>
                        <td></td>
                    </tr>

                </table>
            <?php $this->endWidget(); ?>
</div>

