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
        $query_key = str_replace(' ', '%20', $query_key);

        // dd($query_key);

        $response = $this->githubService->searchRepo($query_key);

        return view('pages.repo.response', ['response' => '']);

    }
}
