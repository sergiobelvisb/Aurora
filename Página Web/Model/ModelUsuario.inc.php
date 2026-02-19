<?php

class ModelUsuario extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function listadoUsuarios(){
        return $this->query("SELECT * FROM usuarios_medicos");
    }

    public function comprobarUsuario($email, $password){
        $this->query("SELECT userID FROM usuarios_medicos WHERE email = ?", [$email]);
        if($this->query("SELECT userID FROM usuarios_medicos WHERE email = ?", [$email]) !== NULL){
            $password_hash = $this->query("SELECT password FROM usuarios_medicos WHERE email = ?", [$email])[0]['password'] ?? "";
            if(password_verify($password, $password_hash)){
                return true;
            } else {
                return false;
            }
        }
    }

    public function getID($email){
        $res = $this->query("SELECT userID FROM usuarios_medicos WHERE email = ?", [$email]);
        return $res[0]['userID'] ?? null;
    }

    public function getUsername($id){
        $res = $this->query("SELECT username FROM usuarios_medicos WHERE userID = ?", [$id]);
        return $res[0]['username'] ?? null;
    }

    public function setUsername($id, $antiguoNombre, $nombre){
        $modelo = new ModelUsuario();
        $res = $this->query("UPDATE user SET username = ? WHERE id = ?", [$nombre, $id]);
        if($modelo->getImage($id) !== "default.jpg"){
            rename("public/img/pfp/" . $antiguoNombre . ".jpg", "public/img/pfp/" . $nombre . ".jpg");
            $modelo->setImagen($id, $nombre . ".jpg");
        }

        if($res){
            return true;
        } else {
            return false;
        }
    }

    public function getACL($id){
        $res = $this->query("SELECT acl FROM usuarios_medicos WHERE userID = ?", [$id]);
        return $res[0]['acl'] ?? null;
    }

    public function getImage($id){
        $res = $this->query("SELECT fotodeperfil FROM user WHERE id = ?", [$id]);
        return '/public/img/pfp/' . $res[0]['fotodeperfil'];
    }

    public function setImagen($id, $name){
        $res = $this->query("UPDATE user SET fotodeperfil = ? WHERE id = ?", [$name, $id]);
        if($res){
            return true;
        } else {
            return false;
        }
    }
}

?>