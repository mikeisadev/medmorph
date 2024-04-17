<?php get_header(); ?>

<div class="w-100 h-100 bg-1">

    <div class="absolute abs-center m-auto h-max-content w-max-content">
        <div class="mb-10 ta-center">
            <?= mmorph_get_template(name: 'logo'); ?>
        </div>
        <div class="bg-white p-20">

            <h4>Registrati ora</h4>
            
            <form method="POST">
                <p>
                    <label for="login">Nome utente</label>
                    <input id="login" type="text" name="login" placeholder="Nome utente..."/>
                </p>
                <p>
                    <label for="login">Indirizzo email</label>
                    <input id="login" type="text" name="login" placeholder="Nome utente..."/>
                </p>
                <p>
                    <label for="login">Password</label>
                    <input id="login" type="password" name="login" placeholder="Password..."/>
                </p>
                <p>
                    <label for="login">Conferma password</label>
                    <input id="login" type="rpassword" name="login" placeholder="Password..."/>
                </p>
                <button class="filled-btn">Accedi</button>
            </form>
        </div>
    </div>

</div>

<?php get_footer(); ?>