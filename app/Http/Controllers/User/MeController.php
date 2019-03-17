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
     *     summary="Retorna o usuário logado",
     *     operationId="GetAuthUser",
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
     *     operationId="UpdateAuthUser",
     *     tags={"users"},
     *     security={{"apiToken":{}}},
     *     @OA\Parameter(
     *         name="first_name",
     *         in="query",
     *         description="Primeiro nome",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="last_name",
     *         in="query",
     *         description="Ultimo nome",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="document_number",
     *         in="query",
     *         description="Documento CPF",
     *         required=false,
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
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'email',
        ]);

        User::find(Auth::user()->id)->update($request->all());

        return $this->success(User::find(Auth::user()->id));
    }

    /**
     * @OA\Put(
     *     path="/users/me/change",
     *     summary="Atualiza a senha do usuário",
     *     operationId="UpdateAuthUserPassword",
     *     tags={"users"},
     *     security={{"apiToken":{}}},
     *     @OA\Parameter(
     *         name="old_password",
     *         in="query",
     *         description="Senha antiga do usuário",
     *         required=true,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Nova senha do usuário",
     *         required=true,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password_confirmation",
     *         in="query",
     *         description="Confirmação da senha",
     *         required=true,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="...",
     *     ),
     *  )
     */
    public function change(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        if(! Hash::check($request->input('old_password'), Auth::user()->password)){
            return $this->unauthorized(['error' => 'Incorrect Password']);
        }
        $password = [
            'password' => Hash::make($request->input('password'))
        ];
        Auth::user()->update($password);

        return $this->success(['res' => 'Your password has been changed.']);
    }

    /**
     * @OA\Get(
     *     path="/users/me/lessons",
     *     summary="Retorna as aulas do usuário logado",
     *     operationId="GetAuthUserLessons",
     *     tags={"users","lessons"},
     *     security={{"apiToken":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="...",
     *     ),
     *  )
     */

    public function getFinishedLessons(){
        return $this->success(Auth::user()->lessons()->paginate(15));
    }
}