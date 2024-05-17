<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Usuarios;
use App\Http\Requests\UserValidation;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\AuthenticateValidation;
use Illuminate\Foundation\Auth\UserAdministrador;

class UsuariosController extends Controller
{
    public function realizarCadastro(UserValidation $request)
    {

        // Cadastro de usuário
        $user = Usuarios::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response($user, 201);
    }

    public function realizarLogin(AuthenticateValidation $request)
    {
        $credentials = $request->all();

        // Criação do TOKEN
        $token = JWTAuth::attempt($credentials);

        try {
            if(!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email ou password incorreto.',
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao efetuar o login.',
                'token' => $token
            ], 500);
        }

        $user = Usuarios::where('email', $request->email)->first();

        //Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'usuario' => $user,
            'token' => $token,
        ]);
    }


    public function listarUsuarios(Request $request)
    {
        $usuarios = Usuarios::paginate($request->limit);

        return response($usuarios, 200);
    }
}
