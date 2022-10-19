<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Services\AuthenticationService;
use Illuminate\Http\JsonResponse;

class AuthenticationController extends BaseController
{

    public function __construct(protected AuthenticationService $authenticationService)
    {
    }

    public function signup(SignupRequest $request): JsonResponse
    {
        $response = $this->authenticationService->register($request->validated());
        return $this->responseJson(
            $response['status'],
            $response['code'],
            $response['message'],
            $response['data']
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $response = $this->authenticationService->login($request->validated());
        return $this->responseJson(
            $response['status'],
            $response['code'],
            $response['message'],
            $response['data']
        );
    }
}
