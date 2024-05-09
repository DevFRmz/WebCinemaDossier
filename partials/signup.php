<div class="flip-card__back">
    <div class="title">Sign up</div>
    <?php if ($error) : ?>
        <p><?= $error ?></p>
    <?php endif ?>
    <form class="flip-card__form" method="POST" action="sesion.php">
    <input class="flip-card__input" name="name" placeholder="Name" type="name">
    <input class="flip-card__input" name="email" placeholder="Email" type="email">
    <input class="flip-card__input" name="password" placeholder="Password" type="password">
    <button class="flip-card__btn" name="signup_submit">Confirm!</button>
    </form>
</div>