<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Services\GithubService;

class ApiRepoController extends Controller
{

    // protected $githubService;

    // public function __construct(GithubService $githubService){
    //     $this->githubService = $githubService;
    // }    

    public function getFileContent($path) {
        return $this->githubService->getFileContent(path: $path);
    }

    public function searchRepositories($keys) {
        return $this->githubService->searchRepo(keys: $keys);
    }
}
