<?php 

namespace App\Services;


class LLMService {

    public function filtrarPalavrasChave($projectDescription) {
        $ch = curl_init();

        $url = 'https://api.groq.com/openai/v1/chat/completions';
        
        $categories = [
            'Linguagem' => ['Qualquer'],
            'Funcionalidade' => ['CRUD', 'ERP', 'E-commerce', 'BI'],
            'Dominio' => ['WEB', 'Mobile', 'Desktop'],
            'Arquitetura' => ['Monolítico', 'Microsserviços'],
            'Interação' => ['API', 'GUI']
        ];

        $header = "[Descrição do sistema]\n\n" . $projectDescription . "\n\n[Fim da descrição]\n\n";

        $bottom = "De acordo com a descrição do software acima, como o software seria classificado dentro de cada uma das 5 categorias a seguir?\n\n

            1 - Linguagem: Qualquer 
            2 - Funcionalidade: CRUD, ERP, E-commerce, BI 
            3 - Dominio: Web, Mobile Desktop 
            4 - Arquitetura: Monolítico, Microsserviços 
            5 - Interação: API, GUI \n\n
            
            Para cada categoria, responda no formato json [{categoria: 'nome da categoria', classificacao: 'classificação da categoria'}, {...}]. Sem justificativa\n\n";

        $message = $header . $bottom;

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
            $content = $decoded['choices'][0]['message']['content'];
            $keywords = $this->extractKeyWords($categories, $content);
            return $content;
        }

        curl_close($ch);

        // $responseExample = "[ {categoria: 'Linguagem', classificacao: 'Qualquer'}, {categoria: 'Funcionalidade', classificacao: 'ERP'}, {categoria: 'Dominio', classificacao: 'Desktop'}, {categoria: 'Arquitetura', classificacao: 'Monolítico'}, {categoria: 'Interação', classificacao: 'GUI'} ]";

        // return $this->extractKeyWords($categories, $responseExample);

    }

    function extractKeyWords($categories, $text) {
        $keywords = [];
        $raystack = strtoupper($text);
        foreach($categories as $cat) {
            foreach($cat as $entry) {
                $needle = strtoupper($entry);
                if(str_contains($raystack, $needle)){
                    $keywords[] = $needle;
                }
            }
        }

        dd($keywords);

        return $keywords;
    }

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
            return $decoded['choices'][0]['message']['content'];
            // $items = $decoded['items'];
            // return($items);
        }

        curl_close($ch);

    }
    
}

?>