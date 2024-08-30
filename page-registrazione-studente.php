<?php get_header(); ?>

<div class="w-100 h-100 bg-1 py-20">

    <div class="m-auto h-w100 w-max-content">
        <div class="mb-10 ta-center">
            <?= mp_get_template(name: 'logo'); ?>
        </div>
        <div class="bg-white p-20">

            <h4 class="ta-center mb-20">Registrati come studente</h4>
            
            <form id="student-register-form" method="POST" novalidate>
                <p class="field">
                    <label for="login">Nome utente</label>
                    <input id="login" type="text" name="login" placeholder="Nome utente..."/>
                </p>
                <p class="field">
                    <label for="email">Indirizzo email</label>
                    <input id="email" type="email" name="email" placeholder="Inserisci il tuo indirizzo email..."/>
                </p>
                <p class="field">
                    <label for="pwd">Password</label>
                    <input id="pwd" type="password" name="pwd" placeholder="La tua password..."/>
                </p>
                <p class="field">
                    <label for="rpwd">Conferma password</label>
                    <input id="rpwd" type="password" name="rpwd" placeholder="Ripeti la tua password..."/>
                </p>

                <p class="field-r">
                    <input id="gdpr-acceptance-1" type="checkbox" name="gdpr-acceptance-1"/>
                    <label for="gdpr-acceptance-1">Accetto la <a href="">privacy policy</a> di questo sito (<?= get_option('siteurl') ?>)</label>
                </p>

                <button name="s-register" class="filled-btn">Registrati ora</button>
            </form>
        </div>
    </div>

</div>

<?php get_footer(); ?>