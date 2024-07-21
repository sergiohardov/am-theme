<?php

namespace AMTheme\API;

use Exception;
use Unsplash as UnsplashComposer;

class Unsplash
{
    function __construct()
    {
        UnsplashComposer\HttpClient::init([
            'applicationId' => AMTHEME_API_ACCESS_UNSPLASH,
            'secret'        => AMTHEME_API_SECRET_UNSPLASH,
            'callbackUrl'   => 'urn:ietf:wg:oauth:2.0:oob',
            'utmSource'     => 'Already Media Work'
        ]);
    }

    public function search_photos($keyword, $page = 1, $count = 5, $orientation = 'landscape')
    {
        $result = [];

        $transient_key = 'unsplash_' . md5(serialize([$keyword, $page, $count, $orientation]));
        $transient_data = get_transient($transient_key);

        if ($transient_data === false) {
            try {
                $request = UnsplashComposer\Search::photos($keyword, $page, $count, $orientation);
                $photos = $request->getResults();

                if ($photos) {
                    foreach ($photos as $photo) {
                        $result[] = [
                            'src' => $photo['urls']['full'],
                            'alt' => $photo['alt_description']
                        ];
                    }

                    set_transient($transient_key, $result, 5 * HOUR_IN_SECONDS);
                }
            } catch (Exception $e) {
                // Catch error
            }
        } else {
            $result = $transient_data;
        }

        return $result;
    }
}
