<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class UserController extends Controller
{
    public $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    protected $helpers = ['form', 'url'];
    protected $validation;

    public function register()
    {
        return view('register');
    }

    public function store()
    {
        $validationRules = [
            'name'          => 'required|min_length[2]|max_length[50]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]'
        ];

        if ($this->validate($validationRules)) {
            $request = service('request');
            $postData = $request->getPost();

            $UserModel = new UserModel();
            $data = [
                'name'     => $postData['name'],
                'email'    => $postData['email'],
                'password' => password_hash($postData['password'], PASSWORD_DEFAULT)
            ];

            if ($UserModel->insert($data)) {
                $this->session->setFlashdata('message', 'Usuario registrado exitosamente');
                $this->session->setFlashdata('alert-class', 'success');
                $integranteId = $UserModel->getInsertID();
                return redirect()->to(site_url('admin/index/' . $integranteId));
            } else {
                $this->session->setFlashdata('message', 'El integrante no se ha guardado');
                $this->session->setFlashdata('alert-class', 'danger');
                return redirect()->to(site_url('register'));
            }
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }
}
