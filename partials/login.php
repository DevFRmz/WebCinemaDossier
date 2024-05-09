<div class="flip-card__front">
    <div class="title">Log in</div>
    <form class="flip-card__form" method="POST" action="sesion.php">
        <?php if ($error) : ?>
            <p><?= $error ?></p>
        <?php endif ?>
        <input class="flip-card__input" name="email" placeholder="Email" type="email">
        <input class="flip-card__input" name="password" placeholder="Password" type="password">
        <button class="flip-card__btn" name="login_submit">Let`s go!</button>
    </form>
</div>