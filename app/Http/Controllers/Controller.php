<?php

namespace App\Http\Controllers;

use App\Services\GithubService;
use App\Services\OpenaiService;
use App\Services\LLMService;

abstract class Controller
{
    protected $githubService;
    protected $openaiService;
    protected $llmService;

    public function __construct(
        GithubService $githubService, 
        OpenaiService $openaiService,
        LLMService $llmService) {

            $this->githubService = $githubService;
            $this->openaiService = $openaiService;
            $this->llmService = $llmService;
            
    }    
}
