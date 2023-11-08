<?php

namespace common\components;

use Google_Client;
use Google_Service_YouTube;

class YoutubeClient
{
    public function getClient()
    {
        $client = new Google_Client();
        $client->setDeveloperKey('AIzaSyCxVpQRfjZthfbjoR-M-elldAxQgbHmt3k');
        $client->addScope(Google_Service_YouTube::YOUTUBE_READONLY);
        return $client;
    }

    public function getVideos()
    {
        $client = $this->getClient();
        $youtube = new Google_Service_YouTube($client);

        $videos = [];
        $nextPageToken = '';

        while(true) {
            $params = [
                'maxResults' => 50,
                'pageToken' => $nextPageToken,
                'order' => 'date',
                'type' => 'video',
                'part' => 'id,snippet',
                'channelId' => 'UCMNip-sySkxpbuxvbyVdukQ'
            ];
            $searchResponse = $youtube->search->listSearch('id,snippet', $params);

            foreach ($searchResponse['items'] as $searchResult) {
                $videos[] = $searchResult;
            }

            $nextPageToken = $searchResponse['nextPageToken'];
            if(!$nextPageToken) {
                break;
            }
        }

        return $videos;
    }
}
