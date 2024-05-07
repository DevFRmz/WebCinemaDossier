<?php

function getPeliculasPorGenero($conn, $genero) {
    $statement = $conn->prepare("SELECT * FROM pelicula WHERE genero = :genero");
    $statement->bindParam(":genero", $genero, PDO::PARAM_STR);
    $statement->execute();
    $peliculas = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $peliculas;
}

?>
