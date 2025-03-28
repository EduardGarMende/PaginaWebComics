<?php
function conectaDB(){
    $servidor = "127.0.0.1";
    $port = "5432";
    $DBnom = "tdiw-f7";
    $usuari = "tdiw-f7";
    $clau = "NBJv5Af_";
    $connexio = pg_connect("host=$servidor port=$port dbname=$DBnom
        user=$usuari password=$clau");
    return($connexio);
}
?>