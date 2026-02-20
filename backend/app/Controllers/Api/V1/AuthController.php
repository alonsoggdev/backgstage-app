<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class AuthController extends ResourceController
{
    protected $format = 'json';

    public function register()
    {
        $data = $this->request->getJSON(true);

        $userModel = new UserModel();

        $userId = $userModel->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ]);

        return $this->respondCreated([
            'message' => 'User created',
            'user_id' => $userId
        ]);
    }

    public function login()
    {
        $data = $this->request->getJSON(true);

        $userModel = new UserModel();
        $user = $userModel->where('email', $data['email'])->first();

        if (!$user || !password_verify($data['password'], $user['password'])) {
            return $this->failUnauthorized('Invalid credentials');
        }

        session()->set([
            'user_id' => $user['id'],
            'email' => $user['email'],
            'logged_in' => true
        ]);

        return $this->respond([
            'message' => 'Logged in'
        ]);
    }

    public function me()
    {
        if (!session()->get('logged_in')) {
            return $this->failUnauthorized();
        }

        return $this->respond([
            'user_id' => session()->get('user_id'),
            'email' => session()->get('email'),
        ]);
    }

    public function logout()
    {
        session()->destroy();

        return $this->respond([
            'message' => 'Logged out'
        ]);
    }
}