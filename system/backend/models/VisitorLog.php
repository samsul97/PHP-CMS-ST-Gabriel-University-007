<?php

namespace backend\models;

use Yii;
use yii\helpers\Url;
use GeoIp2\Database\Reader;

/**
 * This is the model class for table "visitor_log".
 *
 * @property int $id
 * @property string|null $unique_visitor_identifier
 * @property string|null $os
 * @property string|null $browser
 * @property string|null $ip_address
 * @property string|null $geo_location
 * @property string|null $cookies
 * @property string|null $visit_time
 * @property string|null $language
 * @property string|null $referrer
 * @property string|null $visit_url
 * @property string|null $timestamp
 */
class VisitorLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visitor_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['geo_location'], 'string'],
            [['visit_time', 'timestamp'], 'safe'],
            [['os', 'browser', 'ip_address', 'cookies', 'language', 'referrer', 'visit_url'], 'string', 'max' => 255],
            // [['unique_visitor_identifier'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            // 'unique_visitor_identifier' => 'Unique Visitor Identifier',
            'os' => 'Os',
            'browser' => 'Browser',
            'ip_address' => 'Ip Address',
            'geo_location' => 'Geo Location',
            'cookies' => 'Cookies',
            'visit_time' => 'Visit Time',
            'language' => 'Language',
            'referrer' => 'Referrer',
            'visit_url' => 'Visit Url',
            'timestamp' => 'Timestamp',
        ];
    }

    public static function getVisitCountByIpAndUrl()
    {
        return self::find()
            ->select(['ip_address', 'visit_url', 'COUNT(*) as visit_count'])
            ->groupBy(['ip_address', 'visit_url'])
            ->orderBy(['ip_address' => SORT_ASC])
            ->asArray()
            ->all();
    }

    public static function getVisitCountByDate($ipAddress, $date)
    {
        return self::find()
            ->select(['ip_address', 'COUNT(*) as visit_count'])
            ->where(['ip_address' => $ipAddress])
            ->andWhere(['DATE(visit_time)' => $date])
            ->groupBy(['ip_address'])
            ->asArray()
            ->one();
    }

    public static function getGrafikTotalOs()
    {
        $result = self::find()
            ->select(['os', 'COUNT(*) as total'])
            ->groupBy(['os'])
            ->asArray()
            ->all();

        $formattedResult = [];

        foreach ($result as $row) {
            $formattedOs = ucfirst(strtolower($row['os']));
            $formattedResult[] = ['name' => $formattedOs, 'y' => (int)$row['total']];
        }

        return $formattedResult;
    }
    
    public static function getGrafikTotalBrowser()
    {
        $result = self::find()
            ->select(['browser', 'COUNT(*) as total'])
            ->groupBy(['browser'])
            ->asArray()
            ->all();

        $formattedResult = [];

        foreach ($result as $row) {
            $formattedBrowser = ucfirst(strtolower($row['browser']));
            $formattedResult[] = ['name' => $formattedBrowser, 'y' => (int)$row['total']];
        }

        return $formattedResult;
    }

    public static function getGrafikTotalGeoLocation()
    {
        $result = self::find()
            ->select(['geo_location', 'COUNT(*) as total'])
            ->groupBy(['geo_location'])
            ->asArray()
            ->all();

        $formattedResult = [];

        foreach ($result as $row) {
            $formattedGeoLocation = ucfirst(strtolower($row['geo_location']));
            $formattedResult[] = ['name' => $formattedGeoLocation, 'y' => (int)$row['total']];
        }

        return $formattedResult;
    }
    
    public static function getGrafikTotalLanguage()
    {
        $result = self::find()
            ->select(['language', 'COUNT(*) as total'])
            ->groupBy(['language'])
            ->asArray()
            ->all();

        $formattedResult = [];

        foreach ($result as $row) {
            $formattedLanguage = $row['language'];
            $formattedResult[] = ['name' => $formattedLanguage, 'y' => (int)$row['total']];
        }

        return $formattedResult;
    }

    public static function getCountByDate($date)
    {
        return static::find()
            ->select(['COUNT(DISTINCT ip_address) AS count'])
            ->where(['DATE(visit_time)' => $date])
            ->scalar();
    }

    public static function getCountByWeek()
    {
        return static::find()
            ->select(['COUNT(DISTINCT ip_address) AS count'])
            ->where(['WEEK(visit_time)' => new \yii\db\Expression('WEEK(NOW())')])
            ->scalar();
    }

    public static function getCountByMonth()
    {
        return static::find()
            ->select(['COUNT(DISTINCT ip_address) AS count'])
            ->where([
                'MONTH(visit_time)' => new \yii\db\Expression('MONTH(NOW())'),
                'YEAR(visit_time)' => new \yii\db\Expression('YEAR(NOW())'),
            ])
            ->scalar();
    }

    public static function getCountByLastMonth()
    {
        return static::find()
            ->select(['COUNT(DISTINCT ip_address) AS count'])
            ->where([
                'MONTH(visit_time)' => new \yii\db\Expression('MONTH(NOW() - INTERVAL 1 MONTH)'),
                'YEAR(visit_time)' => new \yii\db\Expression('YEAR(NOW() - INTERVAL 1 MONTH)'),
            ])
            ->scalar();
    }

    public static function getTotalCount()
    {
        return static::find()
            ->select(['COUNT(DISTINCT ip_address) AS count'])
            ->scalar();
    }

    public static function getVisitorInformation()
    {
        $ipAddress = Yii::$app->request->userIP;
        $userAgent = Yii::$app->request->userAgent;
        $browser = self::detectBrowser($userAgent);
        $os = self::detectOperatingSystem($userAgent);

        $path = Yii::getAlias('@webroot/system/GeoLite2-City.mmdb');

        try {
            $reader = new Reader($path);
            $location = $reader->city($ipAddress);
            $geoLocation = $location->country->name;
        } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
            $geoLocation = 'Unknown';
        } catch (\Exception $e) {
            Yii::error('Exception: ' . $e->getMessage(), 'visitorLog');
            $geoLocation = 'Unknown';
        }

        $language = Yii::$app->language;
        $referrer = Yii::$app->request->referrer;
        $currentUrl = Url::to('', true);
        $visitTime = date('Y-m-d H:i:s');

        return [
            'ipAddress' => $ipAddress,
            'browser' => $browser,
            'os' => $os,
            'geoLocation' => $geoLocation,
            'language' => $language,
            'referrer' => $referrer,
            'currentUrl' => $currentUrl,
            'visitTime' => $visitTime,
        ];
    }

    private static function detectBrowser($userAgent)
    {
        if (preg_match('/MSIE|Trident/i', $userAgent)) {
            $browser = 'Internet Explorer';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/Chrome/i', $userAgent)) {
            $browser = 'Chrome';
        } else {
            $browser = 'Unknown';
        }

        return $browser;
    }

    private static function detectOperatingSystem($userAgent)
    {
        if (preg_match('/Windows/i', $userAgent)) {
            $os = 'Windows';
        } elseif (preg_match('/Mac OS X/i', $userAgent)) {
            $os = 'Mac OS X';
        } elseif (preg_match('/Android/i', $userAgent)) {
            $os = 'Android';
        } elseif (preg_match('/iPhone/i', $userAgent)) {
            $os = 'iPhone';
        } else {
            $os = 'Unknown';
        }

        return $os;
    }
}
