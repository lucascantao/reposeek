<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepoController extends Controller
{

    public function form() {
        return view('pages.repo.index');
    }

    public function searchRepositories(Request $request) {

        $keywords_array = $this->llmService->filtrarPalavrasChaveMock($request->descricaoProjeto);

        // dd(implode($keywords_array['ERP']));

        $query_key = '';

        foreach ($keywords_array as $entry) {
            foreach ($entry as $key) {
                $query_key .= $key . ' OR ';
            }
        }
        $query_key .= 'DISCARD';
        $query_key = str_replace(' OR DISCARD', '', $query_key);
        $query_key = str_replace(' ', '%20', $query_key);

        $response_repositories = $this->githubService->searchRepo($query_key, 'description');

        // dd($response_repositories);

        return view('pages.repo.response', ['repositories' => $response_repositories]);

    }
}
