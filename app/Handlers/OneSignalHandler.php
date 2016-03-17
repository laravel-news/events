<?php


namespace App\Handlers;


use anlutro\cURL\cURL;
use App\Events\PushSentEvent;
use App\Models\Post;

class OneSignalHandler
{



    public  static function sendNotify(Post $post, $test=false)
    {


        $config = \Config::get('onesignal');

        //check if app id is defined
        if (!empty($config['app_id'])) {

            $data = array(
                'app_id' => $config['app_id'],
                'contents' =>
                    [
                        "en" => $post->short_text

                    ],
                'headings' =>
                    [
                        "en" => $post->title
                    ],
                'isAnyWeb' => true,
                'chrome_web_icon' => $config['icon_url'],
                'firefox_icon' => $config['icon_url'],
                'url' => $post->link

            );

            if ($test || $config['is_test'])
            {
                $data['include_player_ids'] = [$config['own_player_id']];
            } else {
                $data['included_segments'] =  ["All"];
            }

            //add future date if needed
            if (strtotime($post->publish_date) > time()) {
                $data['send_after'] = date(DATE_RFC2822, strtotime($post->publish_date));
                $data['delayed_option'] = 'timezone';
                $data['delivery_time_of_day'] = '10:00AM';
            }


            $curl = new cURL();
            $req =  $curl->newJsonRequest('post',$config['url'], $data)->setHeader('Authorization', 'Basic '.$config['api_key']);
            $result = $req->send();
            if ($result->statusCode <> 200) {
                \Log::error('Unable to push to Onesignal', ['error' => $result->body]);
                return false;
            }

            $result = json_decode($result->body);
            if ($result->id)
            {
                \Event::fire(new PushSentEvent($post));
                return $result->recipients;
            }


        }

    }
}