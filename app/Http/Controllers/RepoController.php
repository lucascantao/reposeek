<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepoController extends Controller
{

    public function form() {
        return view('pages.repo.form');
    }

    public function searchRepositories(Request $request) {

        // dd($this->githubService->searchRepo($request->descricaoProjeto));

        // dd($this->openaiService->sendMessage($request->descricaoProjeto));

        dd($this->llmService->sendMessage($request->descricaoProjeto));

        dd($request->all());

    }
}
