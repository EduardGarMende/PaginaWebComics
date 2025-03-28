<?php

    function crearUsuari($db, $nom, $email, $password, $adreça, $poblacio, $codi_postal) {
        $sql = "INSERT INTO usuari (nom, email, password, adreça, poblacio, codi_postal) 
                VALUES ($1, $2, $3, $4, $5, $6)";
        
        $params = array($nom, $email, $password, $adreça, $poblacio, $codi_postal); 

        // Executem la consulta
        $result = pg_query_params($db, $sql, $params) or die("Error al crear l'usuari");
        
        // Retornem True si la consulta s'ha executat correctament
        return $result !== false;
    }

    function getUserByEmail($db, $email) {
        $sql = "SELECT id_usuari, nom, email, password, adreça, poblacio, codi_postal, img_perfil FROM usuari WHERE email = $1";
        $consulta = pg_query_params($db, $sql, array($email)) or die("Error al buscar l'usuari.");
        $usuario = pg_fetch_assoc($consulta);
        
        return $usuario;
    }
    

    function editarUsuari($db, $nom, $adreça, $poblacio, $codi_postal, $emailAntic, $img_perfil) {
        // Modifiquem la consulta SQL per incloure el camp img_perfil
        $sql = "UPDATE usuari 
                SET nom = $1, adreça = $2, poblacio = $3, codi_postal = $4, img_perfil = $5
                WHERE email = $6";
    
        // Paràmetres que s'afegeixen a la consulta SQL
        $params = array($nom, $adreça, $poblacio, $codi_postal, $img_perfil, $emailAntic);
        
        // Execute la consulta amb els paràmetres
        $result = pg_query_params($db, $sql, $params);
        
        if (!$result) {
            // Si la consulta falla, mostrem l'error de PostgreSQL
            echo "Error de PostgreSQL: " . pg_last_error($db) . "<br>";
        }
        
        // Retornem True si la consulta s'ha executat correctament
        return $result !== false;
    } 
?>