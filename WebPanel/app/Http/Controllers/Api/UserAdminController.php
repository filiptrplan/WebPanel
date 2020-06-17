<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function index(){
        $users = User::paginate(config('config.pagination_length'));
        return UserResource::collection($users);
    }
}
