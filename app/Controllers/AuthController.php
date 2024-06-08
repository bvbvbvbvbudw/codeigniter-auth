<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    protected $format = 'json';
    protected $modelName = 'App\Models\UserModel';

    public function registerPage()
    {
        return view('auth/register');
    }

    public function loginPage()
    {
        return view('auth/login');
    }

    public function register()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[20]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($rules)) {
            return $this->fail([
                'errors' => $this->validator->getErrors(),
                'csrfToken' => csrf_hash()
            ], 400);
        }

        $data = [
            'username' => $this->request->getVar('username'),
            'email'    => $this->request->getVar('email'),
//            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'password' => $this->request->getVar('password'),
        ];

        $this->model->save($data);

        $session = session();
        $ses_data = [
            'id' => $this->model->insertID(),
            'username' => $data['username'],
            'email' => $data['email'],
            'isLoggedIn' => TRUE
        ];
        $session->set($ses_data);

        return $this->respondCreated(['redirect' => '/', 'csrfToken' => csrf_hash()]);
    }

    public function login()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $model->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return $this->respondCreated(['redirect' => '/', 'csrfToken' => csrf_hash()]);
            } else {
                return $this->fail([
                    'msg' => 'Wrong Password',
                    'csrfToken' => csrf_hash()
                ], 400);
            }
        } else {
            return $this->fail([
                'msg' => 'Email not Found',
                'csrfToken' => csrf_hash()
            ], 400);
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
