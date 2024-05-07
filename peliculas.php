<?php
require "./database.php";
require "./partials/header.php";
require "./modulos/getPeliculasPorGenero.php"; 

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Filtro: " . (isset($_GET['filtro']) ? $_GET['filtro'] : 'No definido');
echo "<br>Valor: " . (isset($_GET['valor']) ? $_GET['valor'] : 'No definido');
 if (isset($_GET['filtro']) && $_GET['filtro'] == 'genero' && isset($_GET['valor'])) {
    echo("entre");

    $genero = $_GET['valor']; // Capturar el valor del género desde la URL
    $peliculas = getPeliculasPorGenero($conn, $genero);
    } else {
        echo("Filtro invalido"); // Valor por defecto o manejo de error
    }

 ?>
        
    <main class="main-peliculas container">
        <h2 class="titulo-main-peliculas">Peliculas Populares Esta Semana</h2>

        <section class="peliculas swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="pelicula swiper-slide">
                    <img src="img/portadas/joker.jpg" alt="joker">
                </div>
                
                <div class="pelicula swiper-slide">
                    <img src="img/portadas/lobo-wallstreet.jpg" alt="lobo de wallstreet">
                </div>
                
                <div class="pelicula swiper-slide">
                    <img src="img/portadas/origen.jpg" alt="el origen">
                </div>
                
                <div class="pelicula swiper-slide">
                    <img src="img/portadas/spiderman-no-way-home.jpg" alt="spiderman no way home">
                </div>
                <div class="pelicula swiper-slide">
                    <img src="img/portadas/joker.jpg" alt="joker">
                </div>
                
                <div class="pelicula swiper-slide">
                    <img src="img/portadas/lobo-wallstreet.jpg" alt="lobo de wallstreet">
                </div>
                
                <div class="pelicula swiper-slide">
                    <img src="img/portadas/origen.jpg" alt="el origen">
                </div>
                
                <div class="pelicula swiper-slide">
                    <img src="img/portadas/spiderman-no-way-home.jpg" alt="spiderman no way home">
                </div>
            </div>
                <!-- Botones de Navegación -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </section>

        <div class="filters-menu">
            <h3>Filtrar Por </h3>
            <div class="filter">
                <button class="filter-button button">Todas</button>
            </div>

            <div class="filter">
                <button class="filter-button button">Género</button>
                <div class="filter-options">
                    <a href="?filtro=genero&valor=Accion">Acción</a>
                    <a href="?filtro=genero&valor=Drama">Drama</a>
                    <a href="?filtro=genero&valor=Comedia">Comedia</a>
                    <a href="?filtro=genero&valor=Terror">Terror</a>
                </div>
            </div>
            
            <div class="filter">
                <button class="filter-button button">Año</button>
                <div class="filter-options">
                    <a href="#">2020s</a>
                    <a href="#">2010s</a>
                    <a href="#">2000s</a>
                    <a href="#">1990s</a>
                    <a href="#">1980s</a>
                    <a href="#">1970s</a>
                </div>
            </div>

            <div class="filter">
                <button class="filter-button button">Mayor recaudacion</button>
                <div class="filter-options">
                    <a href="#">Primer Año</a>
                    <a href="#">Recaudacion Total</a>
                </div>
            </div>
            
            <div class="filter">
                <button class="filter-button button">Nacionalidad</button>
                <div class="filter-options">
                    <a href="#">Estadounidense</a>
                    <a href="#">Británica</a>
                    <a href="#">Francesa</a>
                    <a href="#">Italiana</a>
                    <a href="#">Japonesa</a>
                    <a href="#">Española</a>
                    <a href="#">Mexicana</a>
                    <a href="#">India</a>
                </div>
            </div>
            
            
        </div>

        <section class="peliculas-filtradas">
            <h2>Titulo del Flitro</h2>
            <div class="peliculas">
                <?php foreach ($peliculas as $pelicula): ?>
                    <div class="pelicula">
                        <a href="info-pelicula.php"><img src="./img/portadas/<?= $pelicula["ruta_imagen"] ?>" alt="<?= $pelicula["titulo_original"] ?>"></a>
                    </div>
                <?php endforeach ?>
            </div>
        </section>
    </main>

<?php require "./partials/footer.php" ?>
