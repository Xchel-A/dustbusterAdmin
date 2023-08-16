<?php

namespace App\Controllers;

use App\Models\UsuariosM;
use CodeIgniter\Controller;

class Usuarios extends Controller
{
    public function index()
    {
        $model = new UsuariosM();
         // Tu lógica de manejo del formulario de inicio de sesión aquí
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('correo');
            $password = $this->request->getPost('password');
            // Aquí puedes validar las credenciales, verificar en la base de datos, etc.
            // Luego redirige a la página deseada o muestra un mensaje de error.
            $data = json_decode($model->Auth($username,$password));
            echo "<pre>".print_r(($data),true)."<pre>";
            if(isset($data->status)){
                
                return redirect()->to(base_url('/login'))->with('error', 'Credenciales incorrectas.');
            }
           
            if ($username == $data->usuario->correo) {
                
                $isAdmin = false;
                foreach($data->usuario->authorities as $nivel){
                    if($nivel->authority== 'ROLE_ADMIN'){
                        $isAdmin=true;
                    }
                }
                if($isAdmin){
                    echo " es admin";
                    $session = session();
                    $sessionData = [
                        'token' => $data->token,
                        'user_id' => $data->usuario->userId,
                        'username' => $data->usuario->nombreCompleto,
                        'correo' => $data->usuario->correo,
                        'tipoUsuario' => $data->usuario->tipoUsuario,
                        'numeroTelefono' => $data->usuario->numeroTelefono,
                        'curp' => $data->usuario->curp,
                        'fotoPerfil' => $data->usuario->fotoPerfil,
                        'fechaRegistro' => $data->usuario->fechaRegistro,
                        'ultimaSesion' => $data->usuario->ultimaSesion,
                        'authorities' => $data->usuario->authorities,
                        'userIdOpenpay' => $data->usuario->userIdOpenpay,
                        'isActive' => true,
                        // Agrega cualquier otra información que necesites en la sesión
                    ];
                    $session->set($sessionData);
    
                    echo "<pre>".print_r(($session->get()),true)."<pre>";
                    return redirect()->to(base_url('/home'))->with('success', 'Inicio de sesion exitoso.');

                }else{
                    return redirect()->to(base_url('/login'))->with('error', 'La cuenta no existe.');
                }
            }
        }
        
        //return view('usuarios/index', $data); // Cambia 'usuarios/index' al nombre de tu vista
    }
    public function login()
    {
        
        return view('login'); // Cambia 'usuarios/index' al nombre de tu vista
    }
    public function home()
    {
        $session = session();
        if (null !== $session->get('isActive')) {
            $model = new UsuariosM();
            
            $reponseUsers = $model->getAll();
            
            $data = [
                "Usuarios" => json_decode($reponseUsers),

            ];
            //echo "<pre>".print_r($data,true)."<pre>";
            return view('home',$data);
            
        }
        return redirect()->to(base_url('/login'));
        // Aquí puedes cargar la vista y pasar datos a la tabla si lo deseas
        
    }
    public function detalle($id)
    {
        $session = session();
        if (null !== $session->get('isActive')) {
            $model = new UsuariosM();
            
            $data = [
                "Usuario" => $model->getById($id),

            ];
            //echo "<pre>".print_r($data,true)."<pre>";
            return view('detalleUser',$data);
            
        }
        return redirect()->to(base_url('/login'));
        // Aquí puedes cargar la vista y pasar datos a la tabla si lo deseas
        
    }


    public function aprobar()
    {
        $session = session();
        if (null !== $session->get('isActive')) {

            $model = new UsuariosM();
            $idUser = $this->request->getPost('idUser');
            $data =  $model->getById($idUser);
            $data['Usuario']->enabled = true;
            
            echo "<pre>".print_r($data['Usuario'],true)."<pre>";
            $response =  $model->aprobar($data['Usuario']);
            
            $response = json_decode($response);
            echo "<pre>".print_r($response,true)."<pre>";
            if(isset($response->status)){
                echo "fallo";
                return redirect()->to(base_url('/detalle/'.$data['Usuario']->userId))->with('error', 'Credenciales incorrectas.');
            }
            return redirect()->to(base_url('/home'))->with('success', 'Aprobacion exitosa.');

        }
        return redirect()->to(base_url('/login'));

    }










    public function logout()
    {
        $session = session();
        $session->destroy(); // Cierra la sesión actual
        return redirect()->to(base_url('/login'))->with('success', 'Sesión cerrada exitosamente.');
    }


    // Agrega más métodos para realizar otras acciones, como crear, editar, eliminar, etc.
}