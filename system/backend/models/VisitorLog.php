<?php

namespace backend\models;

use Yii;

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
}
