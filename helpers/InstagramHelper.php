<?php

namespace app\helpers;

use Yii;
use GuzzleHttp\Client;

class InstagramHelper
{
    const INSTAGRAM_DOMAIN = 'https://www.instagram.com/';
    const SUFFIX = '?__a=1';

    private static $client;

    public static function getClient()
    {
        if (!self::$client) {
            self::$client = new Client();
        }
        return self::$client;
    }

    /**
     * @param string $username
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getUserPosts(string $username): array
    {
        $client = self::getClient();
        $url = self::INSTAGRAM_DOMAIN . $username . self::SUFFIX;
        try {
            $response = $client->get($url)->getBody()->getContents();
            $response = json_decode($response, true);
            $postsFullData = $response['graphql']['user']['edge_owner_to_timeline_media']['edges'] ?? [];
            $posts = static::preparedPostData($postsFullData);
        } catch (\Exception $e) {
            $posts = [];
        }
        return $posts;

    }


    /**
     * Returns array with prepared instagram post data
     * @param array $postsData
     * @return array
     */
    public static function preparedPostData(array $postsData): array
    {
        $posts = [];
        if (!empty($postsData)) {
            foreach ($postsData as $postData) {
                $postData = $postData['node'];
                $posts[] = [
                    'id' => $postData['id'] ?? null,
                    'owner' => $postData['owner']['username'] ?? null,
                    'time' => $postData['taken_at_timestamp'] ?? null,
                    'title' => $postData['edge_media_to_caption']['edges'][0]['node']['text'] ?? null,
                    'commentsCount' => $postData['edge_media_to_comment']['count'] ?? null,
                    'postUrl' => isset($postData['shortcode']) ? self::INSTAGRAM_DOMAIN . '/p/' . $postData['shortcode'] : null,
                    'imageUrl' => $postData['display_url'] ?? null,
                    'likes' => $postData['edge_liked_by']['count'] ?? null,
                ];
            }
        }

        return $posts;
    }


}
