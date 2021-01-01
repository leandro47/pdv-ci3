<?php
defined('BASEPATH') or exit('URL inválida.');

class User_Model extends CI_Model
{

    public function getUser(string $userName, string $password)
    {
        $data = [
            'login' => $userName,
            'password' => $password
        ];
        $result = $this->db->from('user')
            ->where($data)
            ->get();
        return $result->row();
    }
    
    public function getPermission($idUsuario, $idModulo)
    {
        $data = [
            'id_modules' => $idModulo,
            'id_user' => $idUsuario
        ];

        $result = $this->db->from('permission')
            ->where($data)
            ->get();
        return $result->row();
    }
}
