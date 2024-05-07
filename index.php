<?php
require "./database.php";

$peliculas = $conn->query("SELECT * FROM pelicula");
?>


<?php require "./partials/header.php" ?>


    <section class="container">
        <div class="hero"></div>

        <div class="hero-text">
            <h1>Explora el Mundopeliculasdel Cine</h1>
            <p>Descubre la magia detrás de cada película, conoce a las estrellas que las hacen brillar y sigue los eventos más glamurosos del cine.
                <br/>No te pierdas ningún detalle de las próximas galas y premios.</p>
        </div>
    </section>

    <main class="container">
        <h2 class="titulo-main">Peliculas Ganadoras</h2>
        <div class="peliculas">
            <div class="pelicula">
                <img src="img/portadas/joker.jpg" alt="joker">
            </div>

            <div class="pelicula">
                <img src="img/portadas/lobo-wallstreet.jpg" alt="lobo de wallstreet">
            </div>

            <div class="pelicula">
                <img src="img/portadas/origen.jpg" alt="el origen">
            </div>

            <div class="pelicula">
                <img src="img/portadas/spiderman-no-way-home.jpg" alt="spiderman no way home">
            </div>
        </div>
    </main>

<?php require "./partials/footer.php" ?>
