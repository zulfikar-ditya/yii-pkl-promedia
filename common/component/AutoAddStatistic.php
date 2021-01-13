<?php

namespace common\component;


use Yii;
use frontend\models\Statistic;
use yii\base\Component;
use yii\base\InvalidConfigException;

class AutoAddStatistic extends Component
{
    // Define A Event
    const EventSeeIndexAndViewPage = 'after-load';

    public static function autoStats()
    {
        $newStats = new Statistic();
        $newStats->datetime = date('Y-m-d H:m:s');
        $newStats->user_ip = Yii::$app->request->userIP;
        $newStats->user_host = Yii::$app->request->userHost;
        $newStats->path_info = Yii::$app->request->pathInfo;
        $newStats->query_string = Yii::$app->request->queryString;
        $newStats->save();
    }
}

?>