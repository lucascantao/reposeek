<?php 

namespace App\Services;


class LLMService {

    public function sendMessage($message) {
        $ch = curl_init();

        $url = 'https://api.groq.com/openai/v1/chat/completions';

        $data = [
            'messages' => [array( 'role' => 'user', 'content' => $message )],
            'model' => 'llama3-70b-8192',
            'temperature' => 0.7,
            'max_tokens' => 512
        ];

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . env('LLM_API_KEY')
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