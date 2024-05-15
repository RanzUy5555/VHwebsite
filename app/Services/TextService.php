<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;


class TextService {

    public function send($recipient, $message)
    {   
        $ch = curl_init();
        $parameters = array(
            'apikey' => config('app.sms_key'),
            'number' => $recipient,
            'message' => $message,
            'sendername' => 'THESIS'
        );

        $original_url = $this->get_original_url(link: "bit.ly/3sg6zFy");

        curl_setopt( $ch, CURLOPT_URL, $original_url);
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );

        curl_close ($ch);

        return $output;

    }


    private function get_original_url($link)
    {
        $accessToken = config('app.access_token'); //
        $url = "https://api-ssl.bitly.com/v4/bitlinks/$link";

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$accessToken}",
        ])->get($url);

        if ($response->successful()) {
            $responseData = $response->json();
            if (isset($responseData['long_url'])) {
                return $responseData['long_url'];
            }
        }

        // Handle error or no long_url found
        return null;
    }
}