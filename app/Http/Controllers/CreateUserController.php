<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\JsonResponse;


class CreateUserController extends Controller
{
    public function index() {
        return view('createUserForm');
    }
    public function addUser(CreateUserRequest $request) {
        $users = \Config::get('users');

        $collection = \collect($users['users']);

        $filtered = $collection->where('email', $request->input('email'));

        if(count($filtered->all()) > 0) {
            $data = ['errors' => ['email' => 'Пользователь уже существует']];
            $status = 422;
            \Log::info('Email: '.$request->input('email').' Пользователь уже существует');
        }
        else {
            $data = ['message' => 'Пользователь зарегестрирован'];
            $status = 200;
            \Log::info('Email: '.$request->input('email').' Пользователь зарегестрирован');
        }

        return response()->json($data, $status);
    }
}
