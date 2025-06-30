<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\ApiResponseBuilder;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(public UserService $service){}

    public function index()
    {
        $result = $this->service->getUsers();
        return (new ApiResponseBuilder())->message('users get successfully')->data(UserResource::collection($result->data))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $result=$this->service->setUser($request->validated());
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->message('User created successfully')->data(new UserResource($result->data)):
            (new ApiResponseBuilder())->message('User not created successfully')->data($result->data);
        return $apiResponse->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $result=$this->service->getUser($user);
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->message('User showed successfully')->data(new UserResource($result->data)):
            (new ApiResponseBuilder())->message('User showed unsuccessfully')->data($result->data);
        return $apiResponse->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $result=$this->service->updateUser($request->validated(), $user);
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->message('User updated successfully')->data(new UserResource($user)):
            (new ApiResponseBuilder())->message('User updated unsuccessfully')->data($result->data);
        return $apiResponse->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $result=$this->service->deleteUser($user);
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->message('User deleted successfully'):
            (new ApiResponseBuilder())->message('User not created successfully');
        return $apiResponse->response();
    }
}
