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
use Illuminate\Support\Facades\Hash;

class MeController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/users/me",
     *     summary="Lista o usuário",
     *     operationId="GetUser",
     *     tags={"users"},
     *     security={{"apiToken":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="...",
     *     ),
     *  )
     */
    public function me(){
        return $this->success(Auth::user());
    }

    /**
     * @OA\Put(
     *     path="/users/me",
     *     summary="Atualiza o usuário",
     *     operationId="UpdateUser",
     *     tags={"users"},
     *     security={{"apiToken":{}}},
     *     @OA\Parameter(
     *         name="document_number",
     *         in="query",
     *         description="Documento CPF",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="first_name",
     *         in="query",
     *         description="Primeiro nome",
     *         required=true,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="last_name",
     *         in="query",
     *         description="Ultimo nome",
     *         required=true,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *
     *     @OA\Parameter(
     *         name="address_street",
     *         in="query",
     *         description="Rua onde o rapaz mora",
     *         required=false,
     *        @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="address_number",
     *         in="query",
     *         description="Numero da casa do rapaz",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="address_city",
     *         in="query",
     *         description="Cidade onde o rapaz mora",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="address_state",
     *         in="query",
     *         description="Rua onde o rapaz mora",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="E-mail do cidadão",
     *         required=true,
     *        @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="old_password",
     *         in="query",
     *         description="Senha atual do usuário",
     *         required=false,
     *        @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *    @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Nova senha do usuário",
     *         required=false,
     *        @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password_confirmation",
     *         in="query",
     *         description="Confirmação da nova senha do usuário",
     *         required=false,
     *        @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="...",
     *     ),
     *  )
     */
    public function update(Request $request){
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'old_password' => 'string',
            'password' => 'confirmed'
        ]);
        
        if($request->has('old_password'))
        {
            $user = User::find(Auth::user()->id);
            if(! Hash::check($request->input('old_password'), $user->password)){
                return response()->json(['error' => 'Incorrect Password'], 401);
            }

            $all = $request->all();
            $all['password'] = Hash::make($all['password']);
            $user->update($all);

            return $this->success($user);
        }

        User::find(Auth::user()->id)->update($request->except(['password', 'password_confirmation']));

        return $this->success(User::find(Auth::user()->id));
    }
}