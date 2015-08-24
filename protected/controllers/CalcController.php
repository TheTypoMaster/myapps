<?php

class CalcController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	  public function actionKira()
        {
                $model=new Calc;

                if(isset($_POST['Calc']))
                {
                        $model->attributes=$_POST['Calc'];
                        $model->total=$model->field1 + $model->field2;
                        if($model->save())
                                $this->redirect(array('kira','id'=>$model->id));
                }

                $this->render('kira',array(
                        'model'=>$model,
                ));
        }
	
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}