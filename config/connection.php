<?php

/* The DBConexion class is used to create a connection to a MySQL database using mysqli in PHP. */
class DBConexion { 
    // Create the data conexion.
    public static function connection() {
        // We create an instance of msqli with the params :'server','user','password','database', port;
        $connection = new mysqli("localhost", "root", "", "gestor_mvc"); 
        // Call the instance and do a query to set default enconding
        if ( $connection->errno ) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {
            $connection->query("SET NAMES 'utf8'");
            return $connection;
        }

    }
}