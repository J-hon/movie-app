<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;

class MovieController extends BaseController
{

    public function __construct(protected MovieService $movieService)
    {
    }

    public function index(): JsonResponse
    {
        $response = $this->movieService->get();
        return $this->responseJson(
            $response['status'],
            $response['code'],
            $response['message'],
            MovieResource::collection($response['data'])
        );
    }

}
