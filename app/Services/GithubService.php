<?php

namespace App\Services;


class GithubService {

    /**
     * Retorna o conteúdo de um arquivo dentro de um repositorio
     * 
     * @param string $path Caminho para o arquivo dentro do repositório
     */
    public function getFileContent($path) {
        $ch = curl_init();

        $url = 'https://api.github.com/repos';

        curl_setopt($ch, CURLOPT_URL, $url . $path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: Reposeek'
        ]);

        $resp = curl_exec($ch);

        if($e = curl_error($ch)){
            return($e);
        } else {
            $decoded = json_decode($resp, true);
            $content = $decoded['content'];
            $chunks = explode("\n", $content);
            $string = "";
            foreach($chunks as $chunk) {
                $string = $string . base64_decode($chunk);
            }

            $data = json_decode($string);
            return($data);
        }

        curl_close($ch);
    }


    /**
     * Retorna um lista de repositorios por tópicos
     * 
     * @param string $topic Topico do repositorio a ser pesquisado
     */
    public function searchTopic($topic) {
        $ch = curl_init();

        $url = 'https://api.github.com/search/topics?q=';

        curl_setopt($ch, CURLOPT_URL, $url . $topic);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: Reposeek'
        ]);

        $resp = curl_exec($ch);

        if($e = curl_error($ch)){
            return($e);
        } else {
            $decoded = json_decode($resp, true);
            $content = $decoded['content'];
            $chunks = explode("\n", $content);
            $string = "";
            foreach($chunks as $chunk) {
                $string = $string . base64_decode($chunk);
            }

            $data = json_decode($string);
            return($data);
        }

        curl_close($ch);
    }

    /**
     * Retorna uma lista de repositorios
     * 
     * @param string $keys Chave de busca do repositorio a ser pesquisado
     */
    public function searchRepo($keys) {

        $ch = curl_init();

        $url = 'https://api.github.com/search/repositories?q=';

        $NOT_BY_VALIDATORS = '+-org:Laravel-Backpack+-org:laravel+-org:Laravel-Lang+-org:NativePHP+-org:nodejs+-org:nextjsx+-org:nestjsx+-org:facebook+-org:vercel+-org:vuejs+-org:angular+-org:babel+-org:webpack+-org:electron+-org:emberjs+-org:apache+-org:gradle+-org:openjdk+-org:jboss+-org:spring-projects+-org:pallets+-org:django+-org:python+-org:pytorch+-org:numpy+-org:scipy+-org:pandas-dev+-org:ansible+-org:dotnet+-org:microsoft+-org:mono+-org:xamarin';

        $query = $keys . '%20in:name';

        // dd(strlen($url . $query));

        curl_setopt($ch, CURLOPT_URL, $url . $query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: Reposeek'
        ]);

        $resp = curl_exec($ch);

        dd($resp);

        if($e = curl_error($ch)){
            return($e);
        } else {
            $decoded = json_decode($resp, true);
            $items = $decoded['items'];
            $repositories = $this->filterUserRepositories($items);

            dd($repositories);

            return($repositories);
        }

        curl_close($ch);

    }

    function filterUserRepositories($items) {
        $repositories = [];

        foreach($items as $item) {
            if($item['owner']['type'] == 'User') {
                $repositories[] = $item;
            }
        }

        return($repositories);
    }


    /**
     * Retorna os detalhes de um repositorio
     * 
     * @param string $repo Nome do repositorio a ser pesquisado
     */
    public function getRepo($repo) {

    }



}

