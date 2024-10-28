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
            return $keywords;
        }

        curl_close($ch);
    }

    function filtrarPalavrasChaveMock($projectDescription) {
        $categories = [
            'Linguagem' => ['Qualquer'],
            'Funcionalidade' => ['CRUD', 'ERP', 'E-commerce', 'BI'],
            'Dominio' => ['WEB', 'Mobile', 'Desktop'],
            'Arquitetura' => ['Monolítico', 'Microsserviços'],
            'Interação' => ['API', 'GUI']
        ];

        $responseExample = "[ {categoria: 'Linguagem', classificacao: 'Qualquer'}, {categoria: 'Funcionalidade', classificacao: 'ERP'}, {categoria: 'Dominio', classificacao: 'Desktop'}, {categoria: 'Arquitetura', classificacao: 'Monolítico'}, {categoria: 'Interação', classificacao: 'GUI'} ]";

        return $this->extractKeyWords($categories, $responseExample);
    }

    function extractKeyWords($categories, $text) {

        $filters = [
            'Qualquer' => [],
        
            'CRUD' => [
                'create', 'read', 'update', 'delete', 'CRUD operations', 
                'RESTful', 'basic app', 'resource management'
            ],
        
            'ERP' => [
                'enterprise resource planning', 'ERP', 'business management', 
                'inventory', 'accounting', 'HR', 'supply chain'
            ],
        
            'E-commerce' => [
                'ecommerce', 'shopping', 'payment', 'checkout', 'cart', 
                'online store', 'product listing'
            ],
        
            'BI' => [
                'business intelligence', 'BI', 'data visualization', 
                'analytics', 'dashboard', 'reporting', 'ETL', 'data warehouse'
            ],
        
            'WEB' => [
                'web app', 'web application', 'browser', 'frontend', 
                'backend', 'website', 'SPA', 'single page application'
            ],
        
            'Mobile' => [
                'mobile app', 'iOS', 'Android', 'react native', 'flutter', 
                'apk', 'mobile development'
            ],
        
            'Desktop' => [
                'desktop application', 'electron', 'exe', 'software', 
                'standalone app', 'desktop app', 'cross-platform'
            ],
        
            'Monolítico' => [
                'monolithic', 'single codebase', 'single deployable', 
                'monolithic architecture', 'monolith'
            ],
        
            'Microsserviços' => [
                'microservices', 'service-oriented', 'distributed', 
                'RESTful', 'docker', 'containerization', 
                'microservice architecture'
            ],
        
            'API' => [
                'API', 'RESTful', 'GraphQL', 'endpoint', 
                'service integration', 'data exchange', 'JSON', 
                'API development'
            ],
        
            'GUI' => [
                'graphical user interface', 'user interface', 'UI', 
                'interface design', 'frontend', 'desktop GUI', 
                'visual elements', 'interaction'
            ]
        ];

        // $filters = [
        //     'Qualquer' => [],
        
        //     'CRUD' => [
        //         'CRUD', 'RESTful'
        //     ],
        
        //     'ERP' => [
        //         'ERP', 'business', 'inventory',
        //     ],
        
        //     'E-commerce' => [
        //         'ecommerce','store', 'product'
        //     ],
        
        //     'BI' => [
        //         'business intelligence', 'BI', 'data', 'analytics', 'dashboard'
        //     ],
        
        //     'WEB' => [
        //         'web app', 'web', 'browser', 'SPA'
        //     ],
        
        //     'Mobile' => [
        //         'mobile', 'iOS', 'Android', 'apk'
        //     ],
        
        //     'Desktop' => [
        //         'desktop', 'electron', 'software'
        //     ],
        
        //     'Monolítico' => [
        //         'monolithic', 'monolith'
        //     ],
        
        //     'Microsserviços' => [
        //         'microservices', 'distributed', 'RESTful', 'containerization'
        //     ],
        
        //     'API' => [
        //         'API', 'RESTful', 'GraphQL', 'endpoint', 'service integration', 'JSON'
        //     ],
        
        //     'GUI' => [
        //         'interface', 'UI', 'frontend', 'visual',
        //     ]
        // ];

        $keywords = [];

        $raystack = strtoupper($text);

        foreach($categories as $categorie) {
            foreach($categorie as $entry) {
                $needle = strtoupper($entry);
                if(str_contains($raystack, $needle)){
                    $filter_len = count($filters[$entry]);
                    
                    if($filter_len > 0) { //exceto pro primeiro
                        $random_filter = rand(0, $filter_len - 1);
                        $keywords[] =   [$filters[$entry][$random_filter]]; //pegar um filtro (palavra chave) aleatoria
                    } else {
                        $keywords[] =   []; //Esse else é só pra considera a existência da primeira categoria (linguagem)
                    }
                }
            }
        }

        // dd($keywords);

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