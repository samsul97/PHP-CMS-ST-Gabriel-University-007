<?php

namespace frontend\controllers;

use Yii;
use backend\models\VisitorLog;
use yii\web\Controller;

class VisitorLogController extends Controller
{
    public function actionTrackVisitor()
    {
        $request = Yii::$app->request;

        $ipAddress = $request->post('ip_address');
        $browser = $request->post('browser');
        $os = $request->post('os');
        $geoLocation = $request->post('geo_location');
        $language = $request->post('language');
        $referrer = $request->post('referrer');
        $visitUrl = $request->post('current_url');
        $visitTime = $request->post('visit_time');

        $visitorLog = new VisitorLog([
            'ip_address' => $ipAddress,
            'browser' => $browser,
            'os' => $os,
            'geo_location' => $geoLocation,
            'language' => $language,
            'referrer' => $referrer,
            'visit_url' => $visitUrl,
            'visit_time' => $visitTime,
        ]);
        
        if ($visitorLog->save()) {
            return 'Tracking data received successfully';
        } else {
            return 'Error: ' . json_encode($visitorLog->errors);
        }
    }
}