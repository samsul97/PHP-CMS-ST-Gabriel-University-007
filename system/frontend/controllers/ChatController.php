<?php

namespace frontend\controllers;

use Yii;
use backend\models\Chat;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * AboutUsController implements the CRUD actions for AboutUs model.
 */
class ChatController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    protected function findModel($id)
    {
        if (($model = Chat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }

    public function actionCreate()
    {
        $chat = new Chat();

        if (Yii::$app->request->post()) {
            $message = Yii::$app->request->post('message');

            $chat->user_id = Yii::$app->user->id;
            $chat->message = $message;
            $chat->save();

            return Yii::$app->redis->executeCommand('PUBLISH', [
                'channel' => 'chat',
                'message' => Json::encode([
                    'message' => $message,
                    'session' => Yii::$app->user->id,
                    'user_id'=> $chat->user_id
                ])
            ]);
        }
    }

    public function actionTruncate()
    {
        Yii::$app->db->createCommand()->truncateTable('chat')->execute();
        $this->redirect(Yii::$app->request->referrer);
    }
}
