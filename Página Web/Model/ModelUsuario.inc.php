<?php

class ModelUsuario extends Model {
    public function __construct() {
        parent::__construct();
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

    public function getACL($id){
        $res = $this->query("SELECT acl FROM usuarios_medicos WHERE userID = ?", [$id]);
        return $res[0]['acl'] ?? null;
    }

    public function getImage($id){
        $res = $this->query("SELECT fotodeperfil FROM usuarios_medicos WHERE userID = ?", [$id]);
        return '/public/img/pfp/' . $res[0]['fotodeperfil'];
    }

    public function cambiarFoto($id, $foto){
        $http = new HTTPComponent();
        $nuevoNombre = $this->getUsername($id) . ".png";
        $ruta = $_SERVER['DOCUMENT_ROOT'] . "/dashboard/TFG/public/img/pfp/" . $nuevoNombre;

        if(move_uploaded_file($foto['tmp_name'], $ruta)){
            $res = $this->query("UPDATE usuarios_medicos SET fotodeperfil = ? WHERE userID = ?", [$nuevoNombre, $id]);
            $http->getResponse()->getSession()->set('foto', '/public/img/pfp/' . $nuevoNombre);
            return $res ? true : false;
        }
        return false;
    }

    public function cambiarNombre($id, $nombre){
        $http = new HTTPComponent();
        $res = $this->query("UPDATE usuarios_medicos SET nombre = ? WHERE userID = ?", [$nombre, $id]);
        $http->getResponse()->getSession()->set('nombreCompleto', $nombre);
        return $res ? true : false;
    }

    public function cambiarEmail($id, $email){
        $res = $this->query("UPDATE usuarios_medicos SET email = ? WHERE userID = ?", [$email, $id]);
        return $res ? true : false;
    }

    public function cambiarHospital($id, $hospitalID){
        $res = $this->query("UPDATE usuarios_medicos SET hospitalID = ? WHERE userID = ?", [$hospitalID, $id]);
        return $res ? true : false;
    }

    public function cambiarPassword($id, $current, $new){
        $user = $this->query("SELECT password FROM usuarios_medicos WHERE userID = ?", [$id])[0]['password'] ?? null;

        if(!$user || !password_verify($current, $user)){
            return false;
        }

        $newHash = password_hash($new, PASSWORD_DEFAULT);
        $res = $this->query("UPDATE usuarios_medicos SET password = ? WHERE userID = ?", [$newHash, $id]);
        return $res ? true : false;
    }

    public function getNombreCompleto($id){
        $res = $this->query("SELECT nombre FROM usuarios_medicos WHERE userID = ?", [$id])[0];
        return $res['nombre'] ?? null; 
    }

    public function getEmail($id){
        return $this->query("SELECT email FROM usuarios_medicos WHERE userID = ?", [$id])[0]['email'] ?? null;
    }

    public function getHospital($id){
        return $this->query("SELECT h.nombre AS hospital FROM usuarios_medicos u JOIN hospitales h ON u.hospitalID = h.hospitalID WHERE u.userID = ?", [$id])[0]['hospital'] ?? null;
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
    
    public function registrarUsuario($username, $nombre, $email, $password, $hospitalID){
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        return $this->query( "INSERT INTO usuarios_medicos (username, nombre, email, password, hospitalID) VALUES (?, ?, ?, ?, ?)", [$username, $nombre, $email, $passwordHash, $hospitalID]);
    }
    
    public function usuarioExiste($email){
        $res = $this->query("SELECT userID FROM usuarios_medicos WHERE email = ?", [$email]);
        return !empty($res);
    }

    public function getPacientesByMedico($medicoID) {
        return $this->query("SELECT pacienteID, nombre, edad, DNI, telefono, fecha_de_nacimiento FROM pacientes WHERE medicoID = ?", [$medicoID]);
    }

    /*public function registrarPaciente($nombre, $edad, $dni, $tel, $fecha, $medicoID){
        return $this->
    }*/
}

?>