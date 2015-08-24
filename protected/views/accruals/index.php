<?php
/* @var $this AccrualsController */

$this->breadcrumbs=array(
	'accruals',
);
?>

<style>
    @media print {
        body * {
          visibility: hidden;
        }
        
        #tab1_content, #tab1_content * {
          visibility: visible;
        }
        #tab1_content {
          position: absolute;
          left: 0;
          top: 0;
        }
		#tab2_content, #tab2_content * {
          visibility: visible;
        }
        #tab2_content {
          position: absolute;
          left: 0;
          top: 0;
        }
		#tab3_content, #tab3_content * {
          visibility: visible;
        }
        .print{
            display: none;
        }
        #tab_content {
          position: absolute;
          left: 0;
          top: 0;
        }
      }
</style>
<table border="1" width="800">
<?php
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_general.JPG', "this is alt tag of image");
?>
</table>
</br>
<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-folder-close"></i>JONES MODEL</a></li>
    <li><a href="#tab2" data-toggle="tab"><i class="icon-folder-close"></i>DECHOW AND DICHEV MODEL</a></li>
    <li><a href="#tab3" data-toggle="tab"><i class="icon-wrench"></i>McNICHOLS MODEL</a></li>
	
  </ul>
    <div class="tab-content" id="print_content">
        <div class="tab-pane active" id="tab1">
          <?php echo $this->renderPartial('_JONE', array('model'=>$model)); ?>
           <div id="tab1_content">
           </div>
        </div>
        <div class="tab-pane" id="tab2">

             <?php echo $this->renderPartial('_ DECHOW', array('model'=>$model)); ?>
             <div id="tab2_content">
           
            </div>
        </div>
        <div class="tab-pane" id="tab3">
             <?php echo $this->renderPartial('_McNICHOLS', array('model'=>$model)); ?>
            <div id="tab3_content">
           
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
  
    $(document).ready(function(){
    $("#accruals_company_id").change(function() {
   
    $("#accruals_model_year").empty();
    var values = "accruals_company_id="+$(this).val();
    
        $.ajax({
        url: "<?php echo Yii::app()->getBaseUrl();?>/index.php/accruals/yearreportsheet",
        type: "post",
        data: values,
        success: function(data){
           $("#accruals_model_year").append(data);
        },
        error:function(){
            
            alert('There is error while submit');
            //$("#result").html('There is error while submit');
        }
    });
  });
  
  $("#accruals_company_id_2").change(function() {
   
    $("#accruals_model_year_2").empty();
    var values = "accruals_company_id="+$(this).val();
    
        $.ajax({
        url: "<?php echo Yii::app()->getBaseUrl();?>/index.php/accruals/yearreportsheet",
        type: "post",
        data: values,
        success: function(data){
           $("#accruals_model_year_2").append(data);
        },
        error:function(){
            
            alert('There is error while submit');
            //$("#result").html('There is error while submit');
        }
    });
  });
  
  $("#accruals_company_id_3").change(function() {
   
    $("#accruals_model_year_3").empty();
    var values = "accruals_company_id="+$(this).val();
    
        $.ajax({
        url: "<?php echo Yii::app()->getBaseUrl();?>/index.php/accruals/yearreportsheet",
        type: "post",
        data: values,
        success: function(data){
           $("#accruals_model_year_3").append(data);
        },
        error:function(){
            
            alert('There is error while submit');
            //$("#result").html('There is error while submit');
        }
    });
  });
  
  
  
        $("#jone_form").submit(function(event) {
        
  
        /* Stop form from submitting normally */
        event.preventDefault();
         $("#tab1_content").empty();
        /* Get some values from elements on the page: */
        var values = $(this).serialize();
        var company_name = $('#accruals_company_id option:selected').text();
        values+="&company_name="+company_name;
            $.ajax({
            url: "<?php echo Yii::app()->getBaseUrl();?>/index.php/accruals/jonemodel",
            type: "post",
            data: values,
            success: function(data){
               $("#tab1_content").append(data);
            },
            error:function(){

                alert('There is error while submit');
                //$("#result").html('There is error while submit');
            }
            });
          });
           $("#dechow_form").submit(function(event) {
        
      
        /* Stop form from submitting normally */
        event.preventDefault();
         $("#tab2_content").empty();
        /* Get some values from elements on the page: */
        var values = $(this).serialize();
        var company_name = $('#accruals_company_id option:selected').text();
        values+="&company_name="+company_name;
            $.ajax({
            url: "<?php echo Yii::app()->getBaseUrl();?>/index.php/accruals/dechowmodel",
            type: "post",
            data: values,
            success: function(data){
               $("#tab2_content").append(data);
            },
            error:function(){

                alert('There is error while submit');
                //$("#result").html('There is error while submit');
            }
            });
          });
          
          $("#mcnichols_form").submit(function(event) {
        
      
        /* Stop form from submitting normally */
        event.preventDefault();
         $("#tab3_content").empty();
        /* Get some values from elements on the page: */
        var values = $(this).serialize();
        var company_name = $('#accruals_company_id option:selected').text();
        values+="&company_name="+company_name;
            $.ajax({
            url: "<?php echo Yii::app()->getBaseUrl();?>/index.php/accruals/mcnichomodel",
            type: "post",
            data: values,
            success: function(data){
               $("#tab3_content").append(data);
            },
            error:function(){

                alert('There is error while submit');
                //$("#result").html('There is error while submit');
            }
            });
          });
    });
     
     
   $('body').on('click', '.print', function () {
     window.print();
}); 

</script>


   