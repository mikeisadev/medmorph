<?php get_header(); ?>

<div class="w-100 h-100 bg-1 py-20">

    <div class="m-auto h-w100 w-max-content">
        <div class="mb-10 ta-center">
            <?= mp_get_template(name: 'logo'); ?>
        </div>
        <div class="bg-white p-20">

            <h4 class="mb-5">Accedi al tuo account</h4>
            
            <form id="login-form" method="POST" novalidate>
                <p class="field">
                    <label for="login">Nome utente o indirizzo email</label>
                    <input id="login" type="text" name="login" placeholder="Nome utente o indirizzo email..."/>
                </p>
                <p class="field">
                    <label for="pwd">Password</label>
                    <input id="pwd" type="password" name="pwd" placeholder="Password..."/>
                </p>
                <button name="slogin" class="filled-btn submit" role="submit">Accedi</button>
            </form>
        </div>
    </div>

</div>

<?php get_footer(); ?>