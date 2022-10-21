<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMovieToListRequest;
use App\Http\Requests\RemoveMovieFromListRequest;
use App\Http\Resources\MovieResource;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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

    public function fetch(): JsonResponse
    {
        $response = $this->movieService->getMovieList(Auth::id());
        return $this->responseJson(
            $response['status'],
            $response['code'],
            $response['message'],
            MovieResource::collection($response['data'])
        );
    }

    public function add(AddMovieToListRequest $request): JsonResponse
    {
        $response = $this->movieService->addToMovieList(Auth::id(), $request->validated());
        return $this->responseJson(
            $response['status'],
            $response['code'],
            $response['message'],
            MovieResource::collection($response['data'])
        );
    }

    public function remove(RemoveMovieFromListRequest $request): JsonResponse
    {
        $response = $this->movieService->removeFromMovieList(Auth::id(), $request->validated());
        return $this->responseJson(
            $response['status'],
            $response['code'],
            $response['message'],
            $response['data']
        );
    }

}
