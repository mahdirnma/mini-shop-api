<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUsers()
    {
        return app(TryService::class)(function (){
            return User::where('is_active',1)->get();
        });
    }
    public function setUser($user){
        return app(TryService::class)(function () use ($user){
            return User::create($user);
        });

    }
}
