<?php

namespace App\Http\Controllers\Api;

use App\Repository\apiauth\EloquentAuthRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserApiController extends Controller
{

    protected $eloquentAuth;

    public function __construct(EloquentAuthRepository $eloquentAuth)
    {
        $this->eloquentAuth=$eloquentAuth;
    }

    public function saveUser(Request $request)
    {
        $this->eloquentAuth->saveUser($request);
    }

    public function checkLogin(Request $request){
        $this->eloquentAuth->checkLogin($request);
    }

}
