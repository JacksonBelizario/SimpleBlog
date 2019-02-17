<?php
/**
 * Created by PhpStorm.
 * User: Jackson
 * Date: 17/02/2019
 * Time: 17:26
 */

namespace App\Http\Controllers;


use App\Models\Users;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Create a new token
     *
     * @param Users $user
     * @return mixed
     */
    protected function jwt(Users $user)
    {
        $payload = [
            'iss' => "jwt", // Issuer of the token
            'id' => $user->id,
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60 * 60 * 8, // Expiration time
        ];

        return JWT::encode($payload, env('APP_KEY'));
    }

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     *
     * @param Users $users
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function auth(Users $users, Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /**
         * Obtém o usuário pelo email
         */
        $user = $users->where('email', $request->input('email'))->first();

        /**
         * Verifica os dados do usuário
         */
        if (!$user || $this->checkPassword($this->request->input('password'), $user->password)) {
            return response()->json([
                'error' => 'Email ou senha incorreto.',
            ], 400);
        }

        /**
         * Geração do Token
         */
        return response()->json([
            'token' => $this->jwt($user)
        ], 200);
    }

    /**
     * Verifica se a senha coincide com o hash
     *
     * @param $pass
     * @param $bd_pass
     * @return bool
     */
    private function checkPassword($pass, $bd_pass)
    {
        return bcrypt($pass) == $bd_pass;
    }
}
