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

    public function getNombreCompleto($id){
        $res = $this->query("SELECT nombre, apellido1, apellido2 FROM usuarios_medicos WHERE userID = ?", [$id])[0];
        return $res['nombre'] . " " . $res['apellido1'] . " " . $res['apellido2']; 
    }

    public function getEmail($id){
        return $this->query("SELECT email FROM usuarios_medicos WHERE userID = ?", [$id])[0]['email'];
    }

    public function getHospital($id){
        return $this->query("SELECT h.nombre AS hospital FROM usuarios_medicos u JOIN hospitales h ON u.hospitalID = h.hospitalID WHERE u.userID = ?", [$id])[0]['hospital'];
    }

    public function getHospitales() {
        return $this->query("SELECT * FROM hospitales ORDER BY nombre ASC");
    }

    public function existeEmail($email){
        $res = $this->query("SELECT userID FROM usuarios_medicos WHERE email = ?", [$email]);
        return !empty($res);
    }

    public function existeUsername($username){
        $res = $this->query("SELECT userID FROM usuarios_medicos WHERE username = ?", [$username]);
        return !empty($res);
    }

    public function registrarUsuario($username, $nombre, $apellido1, $apellido2, $email, $password, $hospitalID){

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        return $this->query(
            "INSERT INTO usuarios_medicos 
            (username, nombre, apellido1, apellido2, email, password, hospitalID)
            VALUES (?, ?, ?, ?, ?, ?, ?)",
            [$username, $nombre, $apellido1, $apellido2, $email, $passwordHash, $hospitalID]
        );
    }

    public function usuarioExiste($email){
        $res = $this->query("SELECT userID FROM usuarios_medicos WHERE email = ?", [$email]);
        return !empty($res);
    }
}

?>