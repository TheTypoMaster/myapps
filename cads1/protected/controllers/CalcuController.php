<?php

class CalcuController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

		protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='input-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}