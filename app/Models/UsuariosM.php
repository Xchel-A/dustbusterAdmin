<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosM extends Model
{
   public function Auth($user,$pass) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://dustbusterapi.azurewebsites.net/api/auth/signin',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "correo": "'.$user.'",
        "password": "'.$pass.'"
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: ARRAffinity=410706e100c96c797541e4e0c869a1f0d82025a12b2a874d89d26bdc83e9ba5b; ARRAffinitySameSite=410706e100c96c797541e4e0c869a1f0d82025a12b2a874d89d26bdc83e9ba5b'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
    
   }


   public function getAll() {
  

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://dustbusterapi.azurewebsites.net/api/usuarios',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.session('token'),
        'Cookie: ARRAffinity=410706e100c96c797541e4e0c869a1f0d82025a12b2a874d89d26bdc83e9ba5b; ARRAffinitySameSite=410706e100c96c797541e4e0c869a1f0d82025a12b2a874d89d26bdc83e9ba5b'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

    
   }
   public function getById($id) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://dustbusterapi.azurewebsites.net/api/usuarios/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.session('token'),
            'Cookie: ARRAffinity=410706e100c96c797541e4e0c869a1f0d82025a12b2a874d89d26bdc83e9ba5b; ARRAffinitySameSite=410706e100c96c797541e4e0c869a1f0d82025a12b2a874d89d26bdc83e9ba5b'
        ),
        ));

        $responseUser = curl_exec($curl);

        curl_close($curl);

        

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://dustbusterapi.azurewebsites.net/api/documentos/por-usuario/1',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.session('token'),
            'Cookie: ARRAffinity=410706e100c96c797541e4e0c869a1f0d82025a12b2a874d89d26bdc83e9ba5b; ARRAffinitySameSite=410706e100c96c797541e4e0c869a1f0d82025a12b2a874d89d26bdc83e9ba5b'
        ),
        ));

        $responseDocumentos = curl_exec($curl);

        curl_close($curl);
        
        $data = [
            'Usuario'=>json_decode($responseUser),
            'Documentos'=>json_decode($responseDocumentos),
        ];

        return $data;
    }

    public function aprobar($usuario) {
       
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://dustbusterapi.azurewebsites.net/api/usuarios/'.$usuario->userId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS =>json_encode($usuario),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.session('token'),
            'Cookie: ARRAffinity=410706e100c96c797541e4e0c869a1f0d82025a12b2a874d89d26bdc83e9ba5b; ARRAffinitySameSite=410706e100c96c797541e4e0c869a1f0d82025a12b2a874d89d26bdc83e9ba5b'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

        
    }

}
