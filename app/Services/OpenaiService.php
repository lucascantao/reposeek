<?php 

namespace App\Services;


class OpenaiService {

    public function sendMessage($message) {
        $ch = curl_init();

        $url = 'https://api.openai.com/v1/chat/completions';

        $data = [
            'model' => 'gpt-4o-mini',
            'messages' => [ 'role' => 'user', 'content' => $message ],
            'temperature' => 0.7
        ];

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . env('OPENAI_API_KEY')
        ]);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if($e = curl_error($ch)){
            return($e);
        } else {
            $decoded = json_decode($response, true);
            return $decoded;
            // $items = $decoded['items'];
            // return($items);
        }

        curl_close($ch);

    }
    
}

?>