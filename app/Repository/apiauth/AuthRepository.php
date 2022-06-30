<?php

namespace App\Repository\apiauth;

use Illuminate\Http\Request;

interface AuthRepository
{

    public function saveUser(Request $request);
    public function checkLogin(Request $request);

}
