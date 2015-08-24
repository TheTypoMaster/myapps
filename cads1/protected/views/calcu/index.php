<?php
/* @var $this CalcuController */

$this->breadcrumbs=array(
	'Calcu',
);
?>


<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<table>
    <tr>
        <td>
            <input type="text" name='l[0]'/>
        </td>
        <td>
            <input type="text" name='r[0]'/>
        </td>
        <td>
            <input type="text" id='sum0' />
        </td>
    </tr>
    <tr>
        <td>
            <input type="text" name='l[1]'/>
        </td>
        <td>
            <input type="text" name='r[1]' />
        </td>
        <td>
            <input type="text" id='sum1' />
        </td>
    </tr>
    <tr>
        <th colspan='2'>
         Total Sum
        </th>
        <td>
            <input type="text" id='total'/>
        </td>
    </tr>
</table>

<?php $this->widget('application.extensions.EJqCalculator.EJqCalculator', array(
   'addFormula'=>array(
       '#sum0'=>'{{l[0]}} * {{r[0]}}',
       '#sum1'=>'{{l[1]}} * {{r[1]}}',
       '#total'=>'{{#sum0}} + {{#sum1}}'
   ),
 ));?>
