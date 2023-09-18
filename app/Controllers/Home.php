<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    public $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    protected $helpers = ['form', 'url'];
    protected $validation;

    public function index(): string
    {
        return view('login');
    }

    public function iniciar()
    {
        $validationRules = [
            'email'         => 'required|valid_email',
            'password'      => 'required'
        ];
        if ($this->validate($validationRules)) {
            $request = service('request');
            $postData = $request->getPost();

            $UserModel = new UserModel();
            $formEmail = $postData['email'];
            $data = $UserModel->where('email', $formEmail)->first();
            if ($data) {
                $pass = $data['password'];
                $verify_pass = password_verify($postData['password'], $pass);
                if ($verify_pass) {
                    $ses_data = [
                        'user_id'       => $data['id'],
                        'user_name'     => $data['name'],
                        'user_email'    => $data['email'],
                        'logged_in'     => TRUE
                    ];
                    $this->session->set($ses_data);
                    $this->session->setFlashdata('message', 'Usuario registrado exitosamente');
                    $this->session->setFlashdata('alert-class', 'success');
                    return redirect()->to(site_url('admin/'));
                } else {
                    $this->session->setFlashdata('message', 'Usuario o contraseña incorrectos');
                    $this->session->setFlashdata('alert-class', 'error');
                    return redirect()->to(site_url('/'));
                }
            } else {
                $this->session->setFlashdata('message', 'Usuario o contraseña incorrectos');
                $this->session->setFlashdata('alert-class', 'error');
                return redirect()->to(site_url('/'));
            }
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function dashboard()
    {
        return view('admin/index');
    }
}
