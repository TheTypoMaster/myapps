<?php
/* @var $this RatioController */

$this->breadcrumbs=array(
	'SelectGeneral',
);
?> 
<link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl();?>/js/jquery-ui.css">
  <script src="<?php echo Yii::app()->getBaseUrl();?>/js/jquery-1.9.1.js"></script>
  <script src="<?php echo Yii::app()->getBaseUrl();?>/js/jquery-ui.js"></script>
  <script src="<?php echo Yii::app()->getBaseUrl();?>/js/jquery.PrintArea.js_4.js"></script>
  
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
   @media print {
        body * {
          visibility: hidden;
        }
        #print_content, #print_content * {
          visibility: visible;
        }
        #print_content {
          position: absolute;
          left: 0;
          top: 0;
        }
      }
  </style>
  <script>
  $(function() {
    var name = $( "#name" ),
      email = $( "#email" ),
      password = $( "#password" ),
      allFields = $( [] ).add( name ).add( email ).add( password ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
    function getBaseURL () {
      return location.protocol + "//" + location.hostname + 
         (location.port && ":" + location.port) + "/";
   }
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
    $(".delete").click(function(event) {
        var result = confirm("Are you sure to delete this item?");
        if (result==false) {
           return false;
        }
        var url=$(this).attr('href');
        var array_url = url.split("/");
        var item_id = array_url[array_url.length-1];
        $(this).attr('href','#');
        $(this).closest('tr').remove();
        var values = 'item_id='+item_id;
        $.ajax({
        url: "deletenew", 
        type: "post",
        data: values,
        success: function(data){
          
          
        },
        error:function(){
            
            alert('There is error while submit');
            //$("#result").html('There is error while submit');
        }
    });
      
         return false;
    });
      
      
 $(".del").click(function(event) {
        
            
        var result = confirm("Are you sure to delete this item?");
     
        if (result==false) {
           return false;
        }
            var values="item_id="+event.target.id.substring(4);
            
            
            $.ajax({
           url: "deleteitem",
           type: "post",
           data: values,
           success: function(){
               
                 
               
           },
           error:function(e){

               alert(e);
               //$("#result").html('There is error while submit');
           }
           });
       $(this).closest('label').remove();
        
    });
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 380,
      width: 500,
      modal: true,
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
    $( "#close-dialog" )
      .click(function() {
        $( "#dialog-form" ).dialog( "close" );
      });
      $( ".create-item" )
      .button()
      .click(function() {
        var id = $(this).attr('id');
          
        switch(id)
        {
                
          case "btn_non_cureent_asset":
              $("#category_item").val("NON CURRENT ASSET");
              $('#main_category_item').val("");
              break;
                
          case "btn_cureent_asset":
              $("#category_item").val("CURRENT ASSETS");
              $('#main_category_item').val("");
               break; 
                
          case 'btn_cureent_liabilities':
              $('#category_item').val("CURRENT LIABILITIES");
              $('#main_category_item').val("");
              break;
                
          case 'btn_no_cureent_liabilities':
              $('#category_item').val("NON-CURRENT LIABILITIES");
              $('#main_category_item').val("");
              break;
                
          case 'btn_financed_by_equity':
              $('#category_item').val("FINANCED BY / EQUITY");
              $('#main_category_item').val("");
               break;
                
          case 'btn_revenue':
              $('#category_item').val("REVENUE");
              $('#main_category_item').val("(LOSS)/PROFIT FROM OPERATIONS");
          break;
                
          case 'btn_cost_of_good_sold':
              $('#category_item').val("COST OF GOOD SOLD");
              $('#main_category_item').val("(LOSS)/PROFIT FROM OPERATIONS");
          break;
                
          case 'btn_other_imcome':
              $('#category_item').val("OTHER INCOME");
              $('#main_category_item').val("(LOSS)/PROFIT FROM OPERATIONS");  
          break;
                
          case 'btn_expenses':
              $('#category_item').val("EXPENSES");
              $('#main_category_item').val("(LOSS)/PROFIT FROM OPERATIONS");
          break;
                
          case 'btn_expensesBT':
              $('#category_item').val("EXPENSES");
              $('#main_category_item').val("(LOSS)/PROFIT BEFORE TAXATION");
          break;
                
          case 'btn_expensesAT':
              $('#category_item').val("EXPENSES");
              $('#main_category_item').val("(LOSS)/PROFIT AFTER TAXATION");
          break;
                
          case 'btn_expensesFY':
              $('#category_item').val("EXPENSES");
              $('#main_category_item').val("NET (LOSS)/PROFIT FOR THE FINANCIAL YEAR");
          break;
                
           case 'btn_cash_flow_from_operating':
              $('#category_item').val("CASH FLOW FROM OPERATING ACTIVITIES");
              $('#main_category_item').val("");
              break; 
                
           case 'btn_cash_flow_from_investing':
              $('#category_item').val("CASH FLOW FROM INVESTING ACTIVITIES");
              $('#main_category_item').val("");
              break;
                
           case 'btn_net_cash_inflow_from_finnancing_activities':
              $('#category_item').val("NET CASH INFLOW FROM FINANCING ACTIVITIES");
              $('#main_category_item').val("");
              break;             
        }
        $( "#dialog-form" ).dialog( "open" );
      });
      
      
      
      $('#year,#General_company_name').change(function(){
              /* Send the data using post and put the results in a div */
      
        var values = $('#generate-general-form').serialize();
        
      
       $( "#CreateGeneralLedgerTable" ).empty();
        $.ajax({
        url: "creategeneralledger",
        type: "post",
        data: values,
        success: function(data){
            $('#CreateGeneralLedgerTable').append(data);
        },
        error:function(e){
            
            alert(e);
            //$("#result").html('There is error while submit');
        }
        });
        });
        
        
        
  $("#generate-general-form").submit(function(event) {
  
    /* Stop form from submitting normally */
    event.preventDefault();
    /* Get some values from elements on the page: */
    var values = $(this).serialize();
     var company_name = $('#General_company_name option:selected').text();
         values+='&company_name='+company_name;
         
        $.ajax({
        url: "generateledgergeneral",
        type: "post",
        data: values,
        success: function(data){
           alert("Generate sucessfully");
        },
        error:function(){
            
            alert('There is error while submit');
            //$("#result").html('There is error while submit');
        }
    });
  });
  
    $("#Company_report_sheet").change(function() {
    $("#year_report_sheet").empty();
    var values = "Company_report_sheet="+$(this).val();
    
        $.ajax({
        url: "yearreportsheet",
        type: "post",
        data: values,
        success: function(data){
           $("#year_report_sheet").append(data);
        },
        error:function(){
            
            alert('There is error while submit');
            //$("#result").html('There is error while submit');
        }
    });
  }); 
   $("#income_sheet_form").submit(function(event) {

    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
   //$("#result").html('');

    /* Get some values from elements on the page: */
    var values = $(this).serialize();
    var years_hide = $.map($('#year_report_sheet option'), function(e) { return e.value; });
    years_hide.join(',');
    values+='&years_hide='+years_hide;
    var company_report_sheet_name = $('#Company_report_sheet option:selected').text();
    values+='&Company_report_sheet_name='+company_report_sheet_name;
    $("#tab3_1").empty();
    $("#tab3_2").empty();
    $("#tab3_3").empty();
    /* Send the data using post and put the results in a div */
    $.ajax({
        url: "balancesheet",
        type: "post",
        data: values,
        success: function(data){
            $("#tab3_1").append(data);
        },
        error:function(){
            
            alert('There is error while submit');
            //$("#result").html('There is error while submit');
        }
    });
    $.ajax({
        url: "incomebalancesheet",
        type: "post",
        data: values,
        success: function(data){
            $("#tab3_2").append(data);
        },
        error:function(){
            
            alert('There is error while submit');
            //$("#result").html('There is error while submit');
        }
    });
    $.ajax({
        url: "cashflowstatement",
        type: "post",
        data: values,
        success: function(data){
            $("#tab3_3").append(data);
        },
        error:function(){
            
            alert('There is error while submit');
            //$("#result").html('There is error while submit');
        }
    });
});


  $("#select_leger_items").submit(function(event) {
    if( $('#select_leger_items_company option:selected[value!=""]').length ===0) {
                 alert("Please choose company");
                 return false;
            }  
    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
   //$("#result").html('');

    /* Get some values from elements on the page: */
    var values = $(this).serialize();
 

    /* Send the data using post and put the results in a div */
    $.ajax({
        url: "selectlegeritem",
        type: "post",
        data: values,
        success: function(){
            
            alert("Selected sucessfuly!");
        },
        error:function(){
            
            alert('There is error while submit');
            //$("#result").html('There is error while submit');
        }
    });
});
      
      
//*********************************************This is for the dialog form*********************************************
   $("#create-dialog-form").submit(function(event) {

    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
   //$("#result").html('');

    /* Get some values from elements on the page: */
    var values = $(this).serialize();
    var main_category = $("#main_category_item").val();
    var category = $("#category_item").val();
    var itemName = $("#item-name").val();
    
    /* Send the data using post and put the results in a div */
    $.ajax({
        url: "addmoreitem",
        type: "post",
        data: values,
        success: function(data){
            $( "#dialog-form" ).dialog( "close" );
            var base_url = "<?php echo Yii::app()->getBaseUrl();?>";
            var edit_del = "&nbsp;&nbsp;<img class=del id=del_"+data+" src="+base_url+"/images/icon-delete_13.png />";
            
            switch (category) {
                    
               case 'NON CURRENT ASSET':  
                   $( "#btn_non_cureent_asset" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName + edit_del +'</label>' );
                   break;
                    
               case 'CURRENT ASSETS':  
                   $( "#btn_cureent_asset" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName + edit_del + '</label>' );
                   break;  
                    
               case 'CURRENT LIABILITIES':  
                   $( "#btn_cureent_liabilities" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName+ edit_del+'</label>');
                   break; 
                    
               case 'NON-CURRENT LIABILITIES': 
                   $( "#btn_no_cureent_liabilities" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName+ edit_del+'</label>' );
                   break; 
                    
               case 'FINANCED BY / EQUITY':  
                   $( "#btn_financed_by_equity" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName+ edit_del+'</label>' );
                   break; 
               
               case 'REVENUE':
                    if(main_category == '(LOSS)/PROFIT FROM OPERATIONS')
                    {
                                        $( "#btn_revenue" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName+ edit_del+'</label>' );
                        
                    }
               break; 
                    
               case 'COST OF GOOD SOLD':
                    
                    if(main_category == '(LOSS)/PROFIT FROM OPERATIONS')
                    {
                    
                            $( "#btn_cost_of_good_sold" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName+ edit_del+'</label>' );
                    }
                    
               break;
                    
               case 'OTHER INCOME':
                    
                    if(main_category == '(LOSS)/PROFIT FROM OPERATIONS')
                    {
                    
                            $( "#btn_other_imcome" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName+ edit_del+'</label>' );
                    }
                    
               break;
                    
               case 'EXPENSES':
                    
                    if(main_category == '(LOSS)/PROFIT FROM OPERATIONS')
                    {
                            $( "#btn_expenses" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName+ edit_del+'</label>' );
                    }
                    else if(main_category == '(LOSS)/PROFIT BEFORE TAXATION'){
                             $( "#btn_expensesBT" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName+ edit_del+'</label>' );
                        
                    }
                    else if(main_category == '(LOSS)/PROFIT AFTER TAXATION'){
                             $( "#btn_expensesAT" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName+ edit_del+'</label>' );
                        
                    }
                    else if(main_category == 'NET (LOSS)/PROFIT FOR THE FINANCIAL YEAR'){
                             $( "#btn_expensesFY" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName+ edit_del+'</label>' );
                        
                    }
                    
               break;
              
                    
               case 'CASH FLOW FROM OPERATING ACTIVITIES':  
                   $( "#btn_cash_flow_from_operating" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName+ edit_del+'</label>' );
                   break;  
                    
               case 'CASH FLOW FROM INVESTING ACTIVITIES':  
                   $( "#btn_cash_flow_from_investing" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName+ edit_del+'</label>' );
                   break; 
                    
               case 'NET CASH INFLOW FROM FINANCING ACTIVITIES':  
                   $( "#btn_net_cash_inflow_from_finnancing_activities" ).before( '<label><input type="checkbox" name="item'+data+'" value="'+data+'"/>&nbsp;&nbsp;'+itemName+ edit_del+'</label>' );
                   break;   
                    
            }
            
        },
        error:function(){
            
            alert('There is error while submit');
            //$("#result").html('There is error while submit');
        }
    });
});
//*************************************************************************************************************************************
 
 
        
 
      });

   
  
  </script>
  <script type="text/javascript">
    $(function() {
	
	$('#print').click(function() {
		
		window.print();
		
	});
	
});
    
</script>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#general-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div id="dialog-form" title="Create new items">
<form id="create-dialog-form">
  <fieldset>
    <label for="name">Select category</label>
     <select id="category_item" name="category_item" style="width: 450px">
           <option value="NON CURRENT ASSET">NON CURRENT ASSET</option>
           <option value="CURRENT ASSETS">CURRENT ASSETS</option>
           <option value="CURRENT LIABILITIES">CURRENT LIABILITIES</option>
           <option value="FINANCED BY / EQUITY">FINANCED BY / EQUITY</option>
           <option value="NON-CURRENT LIABILITIES">NON-CURRENT LIABILITIES</option>
           <option value="REVENUE">REVENUE</option>
           <option value="COST OF GOOD SOLD">COST OF GOOD SOLD</option>
           <option value="OTHER INCOME">OTHER INCOME</option>
           <option value="EXPENSES">EXPENSES</option>
           <option value="CASH FLOW FROM OPERATING ACTIVITIES">CASH FLOW FROM OPERATING ACTIVITIES</option>
           <option value="CASH FLOW FROM INVESTING ACTIVITIES">CASH FLOW FROM INVESTING ACTIVITIES</option>
           <option value="NET CASH INFLOW FROM FINANCING ACTIVITIES">NET CASH INFLOW FROM FINANCING ACTIVITIES</option>
     </select>
      
      <label for="name">Select Main Category</label>
      <font color="red">**Ignore if unnecessary</font>
      <select id="main_category_item" name="main_category_item" style="width: 450px">
           <option value=""></option>
           <option value="(LOSS)/PROFIT FROM OPERATIONS">(LOSS)/PROFIT FROM OPERATIONS</option>
           <option value="(LOSS)/PROFIT BEFORE TAXATION">(LOSS)/PROFIT BEFORE TAXATION</option>
           <option value="(LOSS)/PROFIT AFTER TAXATION">(LOSS)/PROFIT AFTER TAXATION</option>
           <option value="NET (LOSS)/PROFIT FOR THE FINANCIAL YEAR">NET (LOSS)/PROFIT FOR THE FINANCIAL YEAR</option>
      </select>
      
      
    <label for="email">Item name</label>
    <input type="text" name="item-name" id="item-name" value="" class="text ui-widget-content ui-corner-all">
    <button id="create-item" class="btn btn-warning">Create item</button>
  </fieldset>
</form> 
</div>
<?php $this->pageTitle=Yii::app()->name; ?>


<?php
$this->breadcrumbs=array(
	'You are about to manage General Ledger'
);
/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#general-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");   */
?>
<script type="text/javascript">
//    $(document).ready(function(){
//        $('#General_year').change(function(){
//       // var url = "index.php/general/selectYearExisted/company_name/"+$('#General_company_name').val()+"/year/"+ $( this ).val();
//        $.ajax({
//			url:'index.php/general/selectYearExisted',
//                        data: "company_id="+$('#General_company_name').val()+"&year="+$( this ).val(),
//			success: function(data){
////                               //console.log('Testing console');
//                                alert(data);},
//                         error: function (xhr, ajaxOptions, thrownError) {
//                            alert(xhr.status);
//                            alert(thrownError);
//                          }
//                                
//			
//		});
//
//        
//      });
//    });
   
</script>
<table border="1" width="800">
<?php
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_general.JPG', "this is alt tag of image");
?>
</table>

</br>
 <style>
         .item_panel
         {
            padding-left: 20px;
            padding-bottom: 20px;
         }
         .item_panel button
         {
             width: 100px;
             height: 40px;
         }
         .item_panel .blue
         {
            color: #00B067; 
         }
         
         #company{
             height: 40px;
             width: 420px;
         }
         #save_continue_button
         {
             width: 150px;
             height: 40px;
             margin-left: 347px;
             margin-top: -20px;
         }
 </style>
<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-folder-close"></i>Select Ledger Items</a></li>
    <li><a href="#tab2" data-toggle="tab"><i class="icon-folder-close"></i>Create General Ledger</a></li>
    <li><a href="#tab3" data-toggle="tab"><i class="icon-wrench"></i>Manage General Ledger</a></li>
	<li><a href="#tab4" data-toggle="tab"><i class="icon-zoom-in"></i>View Statements</a></li>
  </ul>
  <div class="tab-content">
      
   <div class="tab-pane active" id="tab1">
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'select_leger_items',
            'enableAjaxValidation'=>false,
    )); ?>
      <div>
          <span style="padding-left: 200px;padding-right: 30px; font-size: 20px;"><b>COMPANY NAME</b></span>
         <?php echo $form->dropDownList($model, 'company_name',
		 CHtml::listData(Registration::model()->findAll('1 ORDER BY company_name'),'company_id','company_name'),array(
                        'id'=>'select_leger_items_company',
                        'name' =>'select_leger_items_company_name',
			'ajax'=>array(
				'type'=>'POST',
				'url'=>CController::createUrl('general/companyIds'),
				'update'=>'#company_id'
			),
                     'empty' => 'Please Choose',
                     
		)
		); ?>
         <?php $form->error($model,'company_name');?>
      </div>
    
     <table width="850" border ="1" align="center">
         <tr>
             <td width="33%" bgcolor="FCC857"><h5><span style="padding-left: 80px;">BALANCE SHEET</span></h5></td>
             <td width="33%" bgcolor="FCC857"><h5><span style="padding-left: 80px;">INCOME STATEMENT </span></h5></td>
             <td width="33%" bgcolor="FCC857"><h5><span style="padding-left: 80px;">CASH FLOW STATEMENT </span></h5></td>
         </tr>
            <td valign="top">
                <?php
                    $non_cureent_asset = Yii::app()->db->createCommand("select * from tbl_item where `category`='NON CURRENT ASSET'")->queryAll();
                ?>
                <div class="item_panel">
                    <h5>NON CURRENT ASSET</h5>
                    
                    <?php foreach ($non_cureent_asset as $item): ?>
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue"><input checked="true" type="checkbox" name ="<?php echo "item".$item['id'];?>" id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?></label>  
                        <?php else:?>
                            <label><input type="checkbox" name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?>&nbsp;&nbsp;<img class="del"  id="<?php echo "del_".$item['id'];?>" src="<?php echo Yii::app()->getBaseUrl();?>/images/icon-delete_13.png" /></label>
                        <?php endif;?>
                    <?php endforeach;?>
                   
                    <img id="btn_non_cureent_asset" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                </div>
                 <?php
                    $cureent_asset = Yii::app()->db->createCommand("select * from tbl_item where `category`='CURRENT ASSETS'")->queryAll();
                ?>
                <div class="item_panel">
                    <h5>CURRENT ASSET</h5>
                    
                    <?php foreach ($cureent_asset as $item): ?>
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue"><input checked="true" type="checkbox" name ="<?php echo "item".$item['id'];?>" id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?></label>  
                        <?php else:?>
                            <label><input type="checkbox" name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?>&nbsp;&nbsp;<img class="del"  id="<?php echo "del_".$item['id'];?>" src="<?php echo Yii::app()->getBaseUrl();?>/images/icon-delete_13.png" /></label>
                        <?php endif;?>
                    <?php endforeach;?>
                   
                    <img id="btn_cureent_asset" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                </div>
                  <?php
                    $cureent_liabilities = Yii::app()->db->createCommand("select * from tbl_item where `category`='CURRENT LIABILITIES'")->queryAll();
                ?>
                <div class="item_panel">
                    <h5>CURRENT LIABILITIES</h5>
                    
                    <?php foreach ($cureent_liabilities as $item): ?>
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue"><input checked="true" type="checkbox" name ="<?php echo "item".$item['id'];?>" id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?></label>  
                        <?php else:?>
                            <label><input type="checkbox" name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?>&nbsp;&nbsp;<img class="del"  id="<?php echo "del_".$item['id'];?>" src="<?php echo Yii::app()->getBaseUrl();?>/images/icon-delete_13.png" /></label>
                        <?php endif;?>
                    <?php endforeach;?>
                   
                    <img id="btn_cureent_liabilities" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                </div>
                
                 <?php
                    $financed_by_equity = Yii::app()->db->createCommand("select * from tbl_item where `category`='FINANCED BY / EQUITY'")->queryAll();
                ?>
                <div class="item_panel">
                    <h5>FINANCED BY / EQUITY</h5>
                    
                    <?php foreach ($financed_by_equity as $item): ?>
                        
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue"><input checked="true" type="checkbox" name ="<?php echo "item".$item['id'];?>" id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?></label>  
                        <?php else:?>
                            <label><input type="checkbox" name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?></label><a class="delete" href="#" id="<?php echo $item['id'];?>">&nbsp;&nbsp;Delete</a><br/>
                        <?php endif;?>
                    <?php endforeach;?>
                   
                    <img id="btn_financed_by_equity" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                </div>
                 <?php
                    $no_cureent_liabilities = Yii::app()->db->createCommand("select * from tbl_item where `category`='NON-CURRENT LIABILITIES'")->queryAll();
                ?>
                <div class="item_panel">
                    <h5>NON-CURRENT LIABILITIES</h5>
                    
                    <?php foreach ($no_cureent_liabilities as $item): ?>
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue"><input checked="true" type="checkbox" name ="<?php echo "item".$item['id'];?>" id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?></label>  
                        <?php else:?>
                            <label><input type="checkbox" name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?>&nbsp;&nbsp;<img class="del"  id="<?php echo "del_".$item['id'];?>" src="<?php echo Yii::app()->getBaseUrl();?>/images/icon-delete_13.png" /></label>
                        <?php endif;?>
                    <?php endforeach;?>
                   
                    <img id="btn_no_cureent_liabilities" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                </div>
                 
            </td>
         
         
         
         
            <td valign="top">
                 <?php
                    $revenue = Yii::app()->db->createCommand("select * 
                                                              from tbl_item 
                                                              where category='REVENUE'
                                                              and main_category='(LOSS)/PROFIT FROM OPERATIONS'
                                                              ")->queryAll();
                  ?>
                
            
                <div class="item_panel">
                    <h4>(LOSS)/PROFIT FROM OPERATIONS</h4>
                    
                    <h5>REVENUE</h5>
                    
                    <?php foreach ($revenue as $item): ?>
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue">
                                <input checked="true" type="checkbox" name ="<?php echo "item".$item['id'];?>" 
                                       id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?>
                            </label>  
                        <?php else:?>
                    
                            <label>
                                <input type="checkbox" 
                                       name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?>&nbsp;&nbsp;
                                <img class="del"  id="<?php echo "del_".$item['id'];?>" 
                                     src="<?php echo Yii::app()->getBaseUrl();?>/images/icon-delete_13.png" />
                            </label>
                    
                        <?php endif;?>
                    <?php endforeach;?>
                   
                    <img id="btn_revenue" class="create-item" 
                         src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                </div>
                 
                <?php
                    $cost_of_good_sold = Yii::app()->db->createCommand("select * 
                                                                        from tbl_item 
                                                                        where category='COST OF GOOD SOLD'
                                                                        and main_category='(LOSS)/PROFIT FROM OPERATIONS'
                                                                        ")->queryAll();
                ?>
                <div class="item_panel">
                    <h5>COST OF GOOD SOLD</h5>
                    
                    <?php foreach ($cost_of_good_sold as $item): ?>
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue">
                                <input checked="true" type="checkbox" 
                                       name ="<?php echo "item".$item['id'];?>" 
                                       id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?></label>  
                        <?php else:?>
                            <label>
                                <input type="checkbox" 
                                       name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?>&nbsp;&nbsp;
                                <img class="del"  id="<?php echo "del_".$item['id'];?>" 
                                     src="<?php echo Yii::app()->getBaseUrl();?>/images/icon-delete_13.png" />
                            </label>
                        <?php endif;?>
                    <?php endforeach;?>
                   
    <img id="btn_cost_of_good_sold" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                </div>
                 
                 <?php
                    $other_imcome = Yii::app()->db->createCommand("select * 
                                                                   from tbl_item 
                                                                   where category='OTHER INCOME'
                                                                   and main_category='(LOSS)/PROFIT FROM OPERATIONS'
                                                                   ")->queryAll();
                ?>
                <div class="item_panel">
                    <h5>OTHER INCOME</h5>
                    
                    <?php foreach ($other_imcome as $item): ?>
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue"><input checked="true" type="checkbox" 
                                                       name ="<?php echo "item".$item['id'];?>" 
                                                       id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?>
                            </label>
                    
                        <?php else:?>
                            <label>
                                <input type="checkbox" 
                                       name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?>&nbsp;&nbsp;
                                <img class="del"  id="<?php echo "del_".$item['id'];?>" 
                                     src="<?php echo Yii::app()->getBaseUrl();?>/images/icon-delete_13.png" />
                            </label>
                        <?php endif;?>
                    <?php endforeach;?>
                   
        <img id="btn_other_imcome" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                </div>
                 <?php
                    $expenses = Yii::app()->db->createCommand("select * 
                                                               from tbl_item 
                                                               where category='EXPENSES'
                                                               and main_category='(LOSS)/PROFIT FROM OPERATIONS'
                                                               ")->queryAll();
                ?>
                <div class="item_panel">
                    <h5>EXPENSES FOR OPERATIONS</h5>
                    
                    <?php foreach ($expenses as $item): ?>
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue">
                                <input checked="true" type="checkbox" 
                                                       name ="<?php echo "item".$item['id'];?>" 
                                       id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?>
                            </label>  
                        <?php else:?>
                    
                            <label>
                                <input type="checkbox" 
                                       name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?>&nbsp;&nbsp;
                                <img class="del"  id="<?php echo "del_".$item['id'];?>" 
                                     src="<?php echo Yii::app()->getBaseUrl();?>/images/icon-delete_13.png" />
                            </label>
                        <?php endif;?>
                    <?php endforeach;?>
                   
        <img id="btn_expenses" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                </div>
                
                
                <?php
                    $expensesBT = Yii::app()->db->createCommand("select * 
                                                               from tbl_item 
                                                               where category='EXPENSES'
                                                               and main_category='(LOSS)/PROFIT BEFORE TAXATION'
                                                               ")->queryAll();
                ?>
                <div class="item_panel">
                    <h4>(LOSS)/PROFIT BEFORE TAXATION</h4>
                    
                    <h5>EXPENSES BEFORE TAXATION</h5>
                    
                    <?php foreach ($expensesBT as $item): ?>
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue">
                                <input checked="true" type="checkbox" 
                                                       name ="<?php echo "item".$item['id'];?>" 
                                       id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?>
                            </label>  
                        <?php else:?>
                    
                            <label>
                                <input type="checkbox" 
                                       name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?>&nbsp;&nbsp;
                                <img class="del"  id="<?php echo "del_".$item['id'];?>" 
                                     src="<?php echo Yii::app()->getBaseUrl();?>/images/icon-delete_13.png" />
                            </label>
                        <?php endif;?>
                    <?php endforeach;?>
                   
        <img id="btn_expensesBT" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                    
                </div>
                
                
                 <?php
                    $expensesAT = Yii::app()->db->createCommand("select * 
                                                               from tbl_item 
                                                               where category='EXPENSES'
                                                               and main_category='(LOSS)/PROFIT AFTER TAXATION'
                                                               ")->queryAll();
                ?>
                <div class="item_panel">
                    <h4>(LOSS)/PROFIT AFTER TAXATION</h4>
                    
                    <h5>EXPENSES AFTER TAXATION</h5>
                    
                    <?php foreach ($expensesAT as $item): ?>
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue">
                                <input checked="true" type="checkbox" 
                                                       name ="<?php echo "item".$item['id'];?>" 
                                       id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?>
                            </label>  
                        <?php else:?>
                    
                            <label>
                                <input type="checkbox" 
                                       name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?>&nbsp;&nbsp;
                                <img class="del"  id="<?php echo "del_".$item['id'];?>" 
                                     src="<?php echo Yii::app()->getBaseUrl();?>/images/icon-delete_13.png" />
                            </label>
                        <?php endif;?>
                    <?php endforeach;?>
                   
        <img id="btn_expensesAT" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                    
                </div>
                
                
                <?php
                    $expensesFY = Yii::app()->db->createCommand("select * 
                                                               from tbl_item 
                                                               where category='EXPENSES'
                                                               and main_category='NET (LOSS)/PROFIT FOR THE FINANCIAL YEAR'
                                                               ")->queryAll();
                ?>
                <div class="item_panel">
                    <h4>NET (LOSS)/PROFIT FOR THE FINANCIAL YEAR</h4>
                    
                    <h5>EXPENSES FOR THE FINANCIAL YEAR</h5>
                    
                    <?php foreach ($expensesFY as $item): ?>
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue">
                                <input checked="true" type="checkbox" 
                                                       name ="<?php echo "item".$item['id'];?>" 
                                       id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?>
                            </label>  
                        <?php else:?>
                    
                            <label>
                                <input type="checkbox" 
                                       name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;
                                <?php echo $item['name'];?>&nbsp;&nbsp;
                                <img class="del"  id="<?php echo "del_".$item['id'];?>" 
                                     src="<?php echo Yii::app()->getBaseUrl();?>/images/icon-delete_13.png" />
                            </label>
                        <?php endif;?>
                    <?php endforeach;?>
                   
        <img id="btn_expensesFY" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                    
                </div>
               
            </td>
            <td valign="top" >
                <?php
                    $cash_flow_from_operating = Yii::app()->db->createCommand("select * 
                                                                               from tbl_item 
                                                                               where category='CASH FLOW FROM OPERATING ACTIVITIES'
                                                                              ")->queryAll();
                ?>
                <div class="item_panel">
                    <h5>CASH FLOW FROM OPERATING <br/>ACTIVITIES</h5>
                    
                    <?php foreach ($cash_flow_from_operating as $item): ?>
                        <div id="div_item_<?php echo $item['id']?>" style="width: 200px;">
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue"><input checked="true" type="checkbox" name ="<?php echo "item".$item['id'];?>" id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?></label>  
                        <?php else:?>
                            <label><input type="checkbox" name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?></label>
                        <?php endif;?>
                        </div>
                    <?php endforeach;?>
                   
                    <img id="btn_cash_flow_from_operating" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                </div>
                 <?php
                    $cash_flow_from_investing = Yii::app()->db->createCommand("select * from tbl_item where `category`='CASH FLOW FROM INVESTING ACTIVITIES'")->queryAll();
                ?>
                <div class="item_panel">
                    <h5>CASH FLOW FROM INVESTING </label><br/>ACTIVITIES</h5>
                    
                    <?php foreach ($cash_flow_from_investing as $item): ?>
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue"><input checked="true" type="checkbox" name ="<?php echo "item".$item['id'];?>" id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?></label>  
                        <?php else:?>
                            <label><input type="checkbox" name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?>&nbsp;&nbsp;<img class="del"  id="<?php echo "del_".$item['id'];?>" src="<?php echo Yii::app()->getBaseUrl();?>/images/icon-delete_13.png" /></label>
                        <?php endif;?>
                    <?php endforeach;?>
                   
                    <img id="btn_cash_flow_from_investing" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                </div>
                <?php
                    $net_cash_inflow_from_finnancing_activities = Yii::app()->db->createCommand("select * from tbl_item where `category`='NET CASH INFLOW FROM FINANCING ACTIVITIES'")->queryAll();
                ?>
                <div class="item_panel">
                    <h5>NET CASH INFLOW FROM </label><br/>FINANCING ACTIVITIES</h5>
                    
                    <?php foreach ($net_cash_inflow_from_finnancing_activities as $item): ?>
                        <?php if($item['isMandatory']== true):?>
                            <label class="blue"><input checked="true" type="checkbox" name ="<?php echo "item".$item['id'];?>" id="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?></label>  
                        <?php else:?>
                            <label><input type="checkbox" name="<?php echo "item".$item['id'];?>" value="<?php echo $item['id'];?>"/>&nbsp;&nbsp;<?php echo $item['name'];?>&nbsp;&nbsp;<img class="del"  id="<?php echo "del_".$item['id'];?>" src="<?php echo Yii::app()->getBaseUrl();?>/images/icon-delete_13.png" /></label>
                        <?php endif;?>
                    <?php endforeach;?>
                   
                    <img id="btn_net_cash_inflow_from_finnancing_activities" class="create-item" src="<?php echo Yii::app()->getBaseUrl(true)?>/images/addmore.png" alt="Add more" />
                </div>
                  
            </td>
         <tr>
         </tr>
     </table>
       <button  id="save_continue_button"  class="btn btn-success">SAVE</button>
     <?php $this->endWidget(); ?>
    </div>

    <div class="tab-pane" id="tab2">

        <div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'generate-general-form',
                'enableAjaxValidation'=>false,
        )); ?>

                <p class="note">Fields with <span class="required">*</span> are required.</p>

        <table border="0" width="980">

                <?php echo $form->errorSummary($model); ?>

                <tr><td width="40%">

                        <?php echo $form->labelEx($model,'company_name'); ?>
                </td>
                <td width="60%">
                        <?php echo $form->dropDownList($model, 'company_name',
                         CHtml::listData(Registration::model()->findAll('1 ORDER BY company_name'),'company_id','company_name'),array(
                                'prompt'=>'Please Choose',
                                'name' => 'General_company_name',
                                'id' => 'General_company_name',
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
               
        </table>
        <table border="0" width="980"  id="CreateGeneralLedgerTable">
            
        </table>
              
                <input type="submit" id="GenerateGeneralLedger" name="GenerateGeneralLedger"  class="btn btn-warning" value="Generate" />
        <?php $this->endWidget(); ?>

        </div><!-- form -->
     
    </div>
	
	
    <div class="tab-pane" id="tab3">

     <?php echo $this->renderPartial('admin', array('model'=>$model)); ?>




</div>

<div class="tab-pane" id="tab4">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
        'id' =>'income_sheet_form'
)); ?>
    <?php 
    $compaies = Yii::app()->db->createCommand("select C.company_id, C.company_name from tbl_registration as C inner join tbl_item_value as IV on C.company_id = IV.company_id group by C.company_id")->queryAll();
    
    ?>
    <table width="820">
        <tr>
            <td><label>Company <span style="color:red;">*</span></label></td>
            <td>
                <select id="Company_report_sheet" name="Company_report_sheet">
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
                        <select id="year_report_sheet" name="year_report_sheet">
                        <option value="">Choose company first</option>
                        </select>
               
            </td>

            
        </tr>
        <tr>
            <td> <button  class="btn btn-warning">Search</button></td>
            <td></td>
        </tr>
        
    </table>
<?php $this->endWidget(); ?>
<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
	<li class="active"><a href="#tab3_1" data-toggle="tab"><i class="icon-tasks"></i>Balance Sheet</a></li>
	<li><a href="#tab3_2" data-toggle="tab"><i class="icon-tasks"></i>Income Statement</a></li>
	<li><a href="#tab3_3" data-toggle="tab"><i class="icon-tasks"></i>Cash Flow Statement</a></li>
	<li>
		<a href=""><?php
	echo CHtml::image(Yii::app()->request->baseUrl.'/images/print-icon.png', "Print", array('id'=>'print','width'=>'25', 'height'=>'25'));
	?></a>
	
	</li>
  </ul>
  <div class="tab-content" id="print_content">
  
<div class="tab-pane active" id="tab3_1">
	
</div>
<div class="tab-pane" id="tab3_2">

</div>
<div class="tab-pane" id="tab3_3">

</div>
<div class="tab-pane" id="tab3_4">
<h3><span style="padding-left: 170px;">STATEMENT OF FINANCIAL PERFORMANCE / BALANCE SHEET</span></h3>
    <h4><span style="padding-left: 120px;">COMPANY NAME : < companyname > COMPANY ID :< company ID ></span></h4>
    <hr>
</div>
  </div>
 </div>
    
    
  </div>
</div>

</div>
<script type="text/javascript">
  $('body').on('click', '.del', function () {
     var values="item_id="+event.target.id.substring(4);
            
            
            $.ajax({
           url: "deleteitem",
           type: "post",
           data: values,
           success: function(){
               
                 
               
           },
           error:function(e){

               alert(e);
               //$("#result").html('There is error while submit');
           }
           });
       $(this).closest('label').remove();
});
                                                                                                 
</script>                                                                                                     
                                                                                                     