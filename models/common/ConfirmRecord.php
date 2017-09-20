<?php

namespace app\models\common;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;

class ConfirmRecord extends ActiveRecord
{
    public static function tableName()
    {
        return 'confirm';
    }

    public static function create ($param, $value, $redirect)
    {
        static::deleteAll(['param' => $param, 'value' => $value]);
        $confirmRecord = new ConfirmRecord();
        $confirmRecord->code = Yii::$app->security->generateRandomString(32);
        $confirmRecord->param = $param;
        $confirmRecord->value = $value;
        $confirmRecord->redirect = $redirect;
        $confirmRecord->insert_date = time();
        $confirmRecord->save();
        return $confirmRecord;
    }

    public static function check ($code)
    {
        $confirmRecord = static::findOne(['code' => $code]);
        if ($confirmRecord == null)
            return '/confirm/error';
        Yii::$app->session->set($confirmRecord->param, $confirmRecord->value);
        $redirect = $confirmRecord->redirect;
        $confirmRecord->delete();
        return $redirect;
    }

    public function getConfirmLink ()
    {
        return Url::to(['/confirm', 'code' => $this->code],true);
    }
}