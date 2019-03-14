<?php
/**
 * Created by PhpStorm.
 * User: idani
 * Date: 05/01/2019
 * Time: 16:33
 */

namespace App\Http\Controllers\User;


use App\Entities\Auth\User;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MeController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function me(){
        return $this->success(Auth::user());
    }

    public function update(Request $request){

        $user = User::where('id',Auth::user()->id)->update($request->all());
        return $this->success(Auth::user());
    }
}