<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Projeto;

class RepoController extends Controller
{

    public function index() {
        return view('pages.repo.index');
    }

    public function show($id) {
        $projeto = Projeto::find($id);

        $response_repositories = $this->githubService->searchRepo($projeto->query, 'description');

        return view('pages.repo.response', ['repositories' => $response_repositories]);
    }

    public function delete($id) {
        $projeto = Projeto::find($id);

        $projeto->delete();

        return redirect(route('repo.index'));
    }

    public function searchRepositories(Request $request) {

        $keywords_array = $this->llmService->filtrarPalavrasChave($request->descricaoProjeto);

        // var_dump($keywords_array);

        $query_key = '';

        $nomeProjeto = '';

        foreach ($keywords_array as $entry) {
            foreach ($entry as $key) {
                if($nomeProjeto == '') {
                    $nomeProjeto = $key;
                }
                $query_key .= $key . ' OR ';
            }
        }
        $query_key .= 'DISCARD';
        $query_key = str_replace(' OR DISCARD', '', $query_key);
        $query_key = str_replace(' ', '%20', $query_key);

        // dd($query_key);

        try {
            if(Auth::user() != null) {
                Projeto::create([
                    'name' => $nomeProjeto, 
                    'description' => $request->descricaoProjeto, 
                    'query' => $query_key,
                    'user_id' => Auth::user()->id
                ]);
            }
        } catch (\Exception $e) {
            dd($e);
        }



        $response_repositories = $this->githubService->searchRepo($query_key, 'description');

        // dd($response_repositories);

        return view('pages.repo.response', ['repositories' => $response_repositories]);

    }
}
