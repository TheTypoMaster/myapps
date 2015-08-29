<?php
/* @var $this ReportController */

$this->breadcrumbs=array(
	'Report',
);
?>
<script type="text/javascript">
     $(document).ready(function(){
        
      $('#print').click(function(){
          window.print();
      });
        
        
    });
    
</script>
<style>
    @media print {
        body * {
          visibility: hidden;
        }
        #content-print, #content-print * {
          visibility: visible;
        }
        #content-print {
          position: absolute;
          left: 0;
          top: 0;
        }
      }
</style>

<table border="0" width="800">
<?php
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_report.JPG', "this is alt tag of image");
?>
</table>
</br>

<input style="margin-left: 780px;" type="submit" id="print" value="Print">
<!--
<a style="margin-left: 450px;" href="<?php echo Yii::app()->getBaseUrl();?>/index.php/report"><img src="<?php echo Yii::app()->getBaseUrl();?>/images/back.jpg" alt="back"></a> -->


<table border ="0" id="content-print"	align="center" width="500">
    
    <tr>
       <!--
		<br/><span style="padding-left: 79px;">REPORT</span></h3></td> -->
		
		 <td align="center"><h3>FINANCIAL REPORT & GRAPHS </h3><hr>
		 <h5>Company Name : <?php echo $company_name;?></h5>
        
    </tr>
	
    <tr>
	
		
	
        <td>
            <h4><span style="padding-left: 15px;" >1. REVENUE VS EXPENSES</span></h4>
            
			<table class="report_table" border="1" width="489" height="70">
                <tr>
                    <td></td>
                    <?php  
                        $category = "[";
                        $revenue_data ="[";
                        $expense_data ="[";
   
                    ?>
                    <?php foreach ($years as $year ): ?>
                    <td><?php echo $year['year'];?></td>
                    <?php  
                        $category .=$year['year'].",";
                    ?>
                    
                    <?php endforeach; ?>
                    <?php  
                    
                     $category .= "]";
                    
                    ?>
                </tr>
                <tr>
                    <td>REVENUE</td>
                    <?php foreach ($revenues as $revenue ):?>
                    <td>
                    <?php 
                        echo number_format($revenue, 3, '.', ',');
                        $revenue_data.=$revenue.",";
                    ?></td>
                    <?php endforeach; ?>
                 <tr>
                 <tr>
                    <td>EXPENSES</td>
                    <?php foreach ($expenses as $expense ):?>
                    <td><?php 
                        echo  number_format($expense, 3, '.', ',');
                        $expense_data.=$expense.",";
                    ?></td>
                    <?php endforeach; ?>
                    <?php 
                    $revenue_data .="]";
                    $expense_data .="]";
                    
                    ?>
                 <tr>                     
            </table>
            <br/>
            
        </br>
            
            <?php
           
            
            $option = "{
                    colors: ['#587EBD', '#BF4F4B'],
                    chart: {
                        backgroundColor: {
                            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                            stops: [
                                [0, 'rgb(255, 255, 255)'],
                                [1, 'rgb(240, 240, 255)']
                            ]
                        },
                        width: 583,
                        height: 347,
                        borderWidth: 2,
                        plotBackgroundColor: 'rgba(255, 255, 255, .9)',
                        plotShadow: true,
                        plotBorderWidth: 1    
                    },       
                    'title': {
                        'text': 'REVENUE VS EXPENSES',
                        'x': -20 //center
                    },



                    'xAxis': {
                        'categories': ".$category."
                    },

                    'yAxis': {
                        'title': {
                            'text': '.'
                        },
                    },
                    'tooltip': {
                        'valueSuffix': 'C'
                    },
                    'legend': {
                        'layout': 'vertical',
                        'align': 'right',
                        'verticalAlign': 'middle',
                        'borderWidth': 0
                    },
                    'series': [{
                        'name': 'REVENUE',
                        'data': ".$revenue_data."
                        }, {
                        'name': 'EXPENSES',
                        'data': ".$expense_data."
                        }]
                    }";
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options'=>$option,
            ));
            ?>
</br></br>
        </td>
		
		
    </tr> <!--End of Graph 1-->
	
	</br>
	
      <tr>
        <td>
            <?php 
                $current_ratios_data ="[";
                $quick_ratios_data="[";
                $debt_to_equitys_data="[";
                $debt_to_total_assets_data="[";
                $debt_to_equitys_data ="[";
                $debt_to_total_assets_data ="[";
                $total_capitalisaions_data ="[";
                
            ?>
            <h4><span style="padding-left: 15px;" >2.LIQUIDITY RATIOS</span></h4>
            <table border="1" width="489" height="70">
                <tr>
                    <td></td>
                    <?php foreach ($years as $year ): ?>
                    <td><?php echo $year['year'];?></td>
                    <?php endforeach;?>
                </tr>
                <tr>
                    <td>CURRENT RATIOS</td>
                    <?php foreach ($current_ratios as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php $current_ratios_data.=$item.","; ?>
                    <?php endforeach;?>
                 <tr>
                 <tr>
                    <td>QUICK RATIO</td>
                   <?php foreach ($quick_ratios as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php $quick_ratios_data.=$item.","; ?>
                    <?php endforeach;?>
                 <tr>  
                  <tr>
                    <td>DEBT-TO-EQUITY</td>
                   <?php foreach ($debt_to_equitys as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php $debt_to_equitys_data.=$item.","; ?>
                    <?php endforeach;?>
                 <tr>  
                 <tr>
                    <td>DEBT-TO-TOTAL-ASSETS</td>
                   
                   <?php foreach ($debt_to_total_assets as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php $debt_to_total_assets_data.=$item.","; ?>
                    <?php endforeach;?>
                 <tr> 
                 <tr>
                    <td>TOTAL CAPITALISATION</td>
                   <?php foreach ($total_capitalisaions as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php $total_capitalisaions_data.=$item.","; ?>
                    <?php endforeach;?>
                 <tr>                      
            </table>
            <br/>
           
         </br>
              <?php 
                $current_ratios_data .="]";
                $quick_ratios_data.="]";
                $debt_to_equitys_data.="]";
                $debt_to_total_assets_data.="]";
                $debt_to_equitys_data .="]";
                $debt_to_total_assets_data .="]";
                $total_capitalisaions_data .="]";
                
            ?>
            <?php
            $option = "{
                    colors: ['#587EBD', '#BF4F4B'],
                    chart: {
                        backgroundColor: {
                            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                            stops: [
                                [0, 'rgb(255, 255, 255)'],
                                [1, 'rgb(240, 240, 255)']
                            ]
                        },
                        width: 583,
                        height: 347,
                        borderWidth: 2,
                        plotBackgroundColor: 'rgba(255, 255, 255, .9)',
                        plotShadow: true,
                        plotBorderWidth: 1    
                    },       
                    'title': {
                        'text': 'LIQUIDITY RATIOS',
                        'x': -20 //center
                    },



                    'xAxis': {
                        'categories': ".$category."
                    },

                    'yAxis': {
                        'title': {
                            'text': '.'
                        },
                    },
                    'tooltip': {
                        'valueSuffix': 'C'
                    },
                    'legend': {
                        'layout': 'vertical',
                        'align': 'right',
                        'verticalAlign': 'middle',
                        'borderWidth': 0
                    },
                    'series': [{
                        'name': 'CURRENT RATIOS',
                        'data': ".$current_ratios_data."
                        }, {
                        'name': 'QUICK RATIO',
                        'data': ".$quick_ratios_data."
                        }, {
                        'name': 'DEBT-TO-EQUITY',
                        'data': ".$debt_to_equitys_data."
                        }, {
                        'name': 'DEBT-TO-TOTAL-ASSETS',
                        'data': ".$debt_to_total_assets_data."
                        }, {
                        'name': 'TOTAL CAPITALISATION',
                        'data': ".$total_capitalisaions_data."
                        }]
                    }";
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options'=>$option
            ));
            ?>
</br></br>
        </td>
    </tr>
  <tr>
        <td>
            <?php
            $debt_to_equitys_data ="[";
            $debt_to_total_assets_data ="[";
            $total_capitalisaions_data ="[";
            
            ?>
            <h4><span style="padding-left: 15px;" >3.FINANCIAL LEVERAGE RATIOS</span></h4>
            <table border="1" width="489" height="70">
                <tr>
                    <td></td>
                   <?php foreach ($years as $year ): ?>
                    <td><?php echo $year['year'];?></td>
                    <?php endforeach;?>
                </tr>
                <tr>
                    <td>DEBT-TO-EQUITY</td>
                   <?php foreach ($debt_to_equitys as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php $debt_to_equitys_data.=$item.",";?>
                    <?php endforeach;?>
                 <tr>
                 <tr>
                    
                    <td>DEBT-TO-TOTAL-ASSETS</td>
                   <?php foreach ($debt_to_total_assets as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php $debt_to_total_assets_data.=$item.",";?>
                    <?php endforeach;?>
                 <tr> 
                 <tr>
                    <td>TOTAL CAPITALISATION</td>
                   <?php foreach ($total_capitalisaions as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php $total_capitalisaions_data.=$item.",";?>
                    <?php endforeach;?>
                 <tr>                       
            </table>
            <br/>
            
			
        
		
            <?php
            $debt_to_equitys_data .="]";
            $debt_to_total_assets_data .="]";
            $total_capitalisaions_data .="]";
            
          
            
            
            ?>
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options'=>"{
                    colors: ['#587EBD', '#BF4F4B','#9DBF60'],
                    chart: {
                        backgroundColor: {
                            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                            stops: [
                                [0, 'rgb(255, 255, 255)'],
                                [1, 'rgb(240, 240, 255)']
                            ]
                        },
                        width: 583,
                        height: 347,
                        borderWidth: 2,
                        plotBackgroundColor: 'rgba(255, 255, 255, .9)',
                        plotShadow: true,
                        plotBorderWidth: 1    
                    },       
                    'title': {
                        'text': 'FINANCIAL LEVERAGE RATIOS',
                        'x': -20 //center
                    },



                    'xAxis': {
                        'categories': ".$category."
                    },

                    'yAxis': {
                        'title': {
                            'text': '.'
                        },
                    },
                    'tooltip': {
                        'valueSuffix': 'C'
                    },
                    'legend': {
                        'layout': 'vertical',
                        'align': 'right',
                        'verticalAlign': 'middle',
                        'borderWidth': 0
                    },
                    'series': [{
                        'name': 'DEBT-TO-EQUITY',
                        'data': ".$debt_to_equitys_data."
                        }, {
                        'name': 'DEBT-TO-TOTAL-ASSETS',
                        'data': ".$debt_to_total_assets_data."
                        }, {
                        'name': 'TOTAL CAPITALISATION',
                        'data': ".$total_capitalisaions_data."
                        }]
                    }"
            ));
            ?>
</br></br>
        </td>
    </tr>
   <tr>
        <td>
            <h4><span style="padding-left: 15px;" >4.INCOME STATEMENT RATIOS</span></h4>
            <h5><span style="padding-left: 15px;" >COVERAGE / PROFITABILITY(MARGIN RATIOS)</span></h5>
            <table border="1" width="489" height="70">
                <tr>
                    <td></td>
                    
                   <?php foreach ($years as $year ): ?>
                    <td><?php echo $year['year'];?></td>
                    <?php endforeach;?>
                </tr>
                <tr>
                    <td>INTEREST COVERAGE</td>
                    
                   <?php foreach ($interes_coverages as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr>
                 <tr>
                    <td>GROSS PROFIT MARGIN</td>
                   <?php foreach ($gross_profit_margins as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr> 
                  <tr>
                    <td>NET PROFIT MARGIN</td>
                   <?php foreach ($net_profit_margins as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr> 
                 <tr>
                    <td>GROSS OPERATING MARGIN</td>
                   <?php foreach ($gross_operating_margins as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr> 
                 <tr>
                    <td>NET OPERATING MARGIN</td>
                   <?php foreach ($net_operating_margins as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr>                      
            </table>
            <br/>
           
        </br>
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options'=>"{
                    colors: ['#587EBD', '#BF4F4B','#9FBF54','#755994','#4CA6C0'],
                    chart: {
                        backgroundColor: {
                            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                            stops: [
                                [0, 'rgb(255, 255, 255)'],
                                [1, 'rgb(240, 240, 255)']
                            ]
                        },
                        width: 583,
                        height: 347,
                        borderWidth: 2,
                        plotBackgroundColor: 'rgba(255, 255, 255, .9)',
                        plotShadow: true,
                        plotBorderWidth: 1    
                    },       
                    'title': {
                        'text': 'INCOME STATEMENT RATIOS',
                        'x': -20 //center
                    },



                    'xAxis': {
                        'categories': ".$category."
                    },

                    'yAxis': {
                        'title': {
                            'text': '.'
                        },
                    },
                    'tooltip': {
                        'valueSuffix': 'C'
                    },
                    'legend': {
                        'layout': 'vertical',
                        'align': 'right',
                        'verticalAlign': 'middle',
                        'borderWidth': 0
                    },
                    'series': [{
                        'name': 'INTEREST CONVERAGE',
                        'data': ".json_encode($interes_coverages)."
                        }, {
                        'name': 'GROSS PROFIT MARGIN',
                        'data': ".json_encode($gross_profit_margins)."
                        }, {
                        'name': 'NET PROFIT MARGIN',
                        'data': ".  json_encode($net_profit_margins)."
                        }, {
                        'name': 'GROSS OPERATING MARGIN',
                        'data': ". json_encode($gross_operating_margins)."
                        }, {
                        'name': 'NET OPERATING MARGIN',
                        'data': ".  json_encode($net_operating_margins)."
                        }]
                    }"
            ));
            ?>
</br></br>
        </td>
    </tr>
  <tr>
        <td>
            <h4><span style="padding-left: 15px;" >5.RETURN ON INVESTMENT (ROI)</span></h4>
            <table border="1" width="489" height="70">
                <tr>
                    <td></td>
                   <?php foreach ($years as $year ): ?>
                    <td><?php echo $year['year'];?></td>
                    <?php endforeach;?>
                </tr>
                <tr>
                    <td>RETURN ON EQUITY (ROE)</td>
                   <?php foreach ($return_on_equities as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr>
                 <tr>
                    <td>RETURN ON ASSETS (ROA)</td>
                   <?php foreach ($return_on_assets as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr>  
                 <tr>
                    <td>RETURN ON CAPITAL EMPLOYED(ROCE)</td>
                   <?php foreach ($return_on_capital_employeds as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr>                     
                 <tr>
                    <td>EARNING PER SHARE</td>
                   <?php foreach ($earning_per_shares as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr>                      
            </table>
            <br/>
           
        </br>
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options'=>"{
                    colors: ['#587EBD', '#BF4F4B','#9FBF54','#755994'],
                    chart: {
                        backgroundColor: {
                            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                            stops: [
                                [0, 'rgb(255, 255, 255)'],
                                [1, 'rgb(240, 240, 255)']
                            ]
                        },
                        width: 583,
                        height: 347,
                        borderWidth: 2,
                        plotBackgroundColor: 'rgba(255, 255, 255, .9)',
                        plotShadow: true,
                        plotBorderWidth: 1    
                    },       
                    'title': {
                        'text': 'RETURN ON INVESTMENT (ROI)',
                        'x': -20 //center
                    },



                    'xAxis': {
                        'categories': ".$category."
                    },

                    'yAxis': {
                        'title': {
                            'text': '.'
                        },
                    },
                    'tooltip': {
                        'valueSuffix': 'C'
                    },
                    'legend': {
                        'layout': 'vertical',
                        'align': 'right',
                        'verticalAlign': 'middle',
                        'borderWidth': 0
                    },
                    'series': [{
                        'name': 'RETURN ON EQUITY (ROE)',
                        'data': ".json_encode($return_on_equities)."
                        }, {
                        'name': 'RETURN ON ASSETS (ROA)',
                        'data': ".json_encode($return_on_assets)."
                        }, {
                        'name': 'RETURN ON CAPITAL <br/>EMPLOYED (ROCE)',
                        'data': ".  json_encode($return_on_capital_employeds)."
                        }, {
                        'name': 'EARNING PER SHARE',
                        'data': ".  json_encode($earning_per_shares)."
                        }]
                    }"
            ));
            ?>
</br></br>
        </td>
    </tr>
   <tr>
        <td>
             <h4><span style="padding-left: 15px;" >6.ASSET UTILISATION RATIOS </span></h4>
            <table border="1" width="489" height="70">
                <tr>
                    <td></td>
                   <?php foreach ($years as $year ): ?>
                    <td><?php echo $year['year'];?></td>
                    <?php endforeach;?>
                </tr>
                <tr>
                    <td>TOTAL ASSET TURNOVER</td>
                   <?php foreach ($total_asset_tunovers as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr>
                 <tr>
                    <td>FIXED ASSET TURNOVER</td>
                     <?php foreach ($fix_asset_tunovers as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr>                     
            </table>
           
        </br>
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options'=>"{
                    colors: ['#587EBD', '#BF4F4B'],
                    chart: {
                        backgroundColor: {
                            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                            stops: [
                                [0, 'rgb(255, 255, 255)'],
                                [1, 'rgb(240, 240, 255)']
                            ]
                        },
                        width: 583,
                        height: 347,
                        borderWidth: 2,
                        plotBackgroundColor: 'rgba(255, 255, 255, .9)',
                        plotShadow: true,
                        plotBorderWidth: 1    
                    },       
                    'title': {
                        'text': 'ASSET UTILISATION RATIOS',
                        'x': -20 //center
                    },



                    'xAxis': {
                        'categories': ".$category."
                    },

                    'yAxis': {
                        'title': {
                            'text': '.'
                        },
                    },
                    'tooltip': {
                        'valueSuffix': 'C'
                    },
                    'legend': {
                        'layout': 'vertical',
                        'align': 'right',
                        'verticalAlign': 'middle',
                        'borderWidth': 0
                    },
                    'series': [{
                        'name': 'TOTAL ASSET TURNOVER',
                        'data': ".  json_encode($total_asset_tunovers)."
                        }, {
                        'name': 'FIXED ASSET TURNOVER',
                        'data': ".  json_encode($fix_asset_tunovers)."
                        }]
                    }"
            ));
            ?>
</br></br>
        </td>
    </tr>
  <tr>
        <td>
            <h4><span style="padding-left: 15px;" >7.LONG-TERM SOLVENCY RISK RATIOS </span></h4>
            <table border="1" width="489" height="70">
                <tr>
                    <td></td>
                   <?php foreach ($years as $year ): ?>
                    <td><?php echo $year['year'];?></td>
                    <?php endforeach;?>
                </tr>
                <tr>
                    <td>GEARING RATIO (DEBT/EQUITY)</td>
                     <?php foreach ($gering_ratio_debt_equitys as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr>
                 <tr>
                    <td>GEARING RATIO (DEBT/DEBT+EQUITY)</td>
                     <?php foreach ($gering_ratio_total_finances as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr>  
                 <tr>
                    <td>INTEREST COVER</td>
                     <?php foreach ($interes_covers as $item ): ?>
                    <td><?php echo number_format($item, 3, '.', ',');?></td>
                    <?php endforeach;?>
                 <tr>                      
            </table>
           
        </br>
            <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
                'options'=>"{
                    colors: ['#587EBD', '#BF4F4B','#9FBF54'],
                    chart: {
                        backgroundColor: {
                            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                            stops: [
                                [0, 'rgb(255, 255, 255)'],
                                [1, 'rgb(240, 240, 255)']
                            ]
                        },
                        width: 583,
                        height: 347,
                        borderWidth: 2,
                        plotBackgroundColor: 'rgba(255, 255, 255, .9)',
                        plotShadow: true,
                        plotBorderWidth: 1    
                    },       
                    'title': {
                        'text': 'LONG-TERM SOLVENCY RISK RATIOS',
                        'x': -20 //center
                    },



                    'xAxis': {
                        'categories': ".$category."
                    },

                    'yAxis': {
                        'title': {
                            'text': '.'
                        },
                    },
                    'tooltip': {
                        'valueSuffix': 'C'
                    },
                    'legend': {
                        'layout': 'vertical',
                        'align': 'right',
                        'verticalAlign': 'middle',
                        'borderWidth': 0
                    },
                    'series': [{
                        'name': 'GEARING <br/>RATIO (DEBT/EQUITY)',
                        'data': ".  json_encode($gering_ratio_debt_equitys)."
                        }, {
                        'name': 'GEARING <br/>RATIO (DEBT/DEBT+EQUITY)',
                        'data': ".  json_encode($gering_ratio_total_finances)."
                        }, {
                        'name': 'INTEREST COVER',
                        'data': ".  json_encode($interes_covers)."
                        }]
                    }"
            ));
            ?>
</br></br>
        </td>
    </tr>
</table>

