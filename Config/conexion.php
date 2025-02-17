<?php
#CREAMOS UNA SESION
session_start();

#CREAMOS UNA CLASE PARA LA CONEXION
class Conectar{
    protected $dbh;

    #METODO DE CONEXION CON PDO
    protected function Conexion(){
        #CONTROLAMOS LOS ESTADOS DE LA CONEXION
        try {
            $conectar = $this->dbh = new PDO("mysql:host=localhost;dbname=bd.helpdesk", "root", "");
            return $conectar;
        #SI LA CONEXION PRESENTA INCONVENIENTES CAPTURA EL ERROR Y LO MUESTRA EN CONSOLA
        } catch (Exception $e) {
            echo "Error BD: " . $e->getMessage() . '<br/>';
            die();
        }
    }

    #CONFIGURA EL CONJUNTO DE CARACTERES DE LA CONEXION UTF-8 ASEGURA LA CORRECTA CODIFICACION DE CARACTERES.
    public function set_names(){
        return $this->dbh->query("SET NAMES 'utf8'");
    }

    #METODO DE LA RUTA DEL PROYECTO
    public function ruta(){
        return "http://localhost:80/DM_HelpDesk/";
    }
}
