<?php 

defined( 'ABSPATH' ) || exit; 

get_header();

?>

<div class='overlay overlay-black'></div>
<div id="maintenance-container" class="container">
    <div class="container-wrap">
        <h1 class="fs-30">Moorph è ora in manutenzione</h1>
        <p>Per non perderti nulla al momento del lancio iscriviti ora alla newsletter per sapere quando saremo online!</p>

        <div id="loader-root"></div>

        <div class="newsletter-form">
            <form id="newsletter-form" method="POST" novalidate>
                <p class="field">
                    <label for="user">Nome e cognome</label>
                    <input id="user" type="text" name="user" placeholder="Inserisci qui il tuo nome e cognome..."/>
                </p>
                <p class="field">
                    <label for="email">Indirizzo email</label>
                    <input id="email" type="email" name="email" placeholder="Inserisci il tuo indirizzo email..."/>
                </p>

                <p class="field-r">
                    <input id="gdpr-acceptance-1" type="checkbox" name="gdpr-acceptance-1"/>
                    <label for="gdpr-acceptance-1">Accetto la <a href="<?= esc_url('/privacy-policy'); ?>">privacy policy</a> di questo sito (<?= get_option('siteurl') ?>)</label>
                </p>

                <button name="s-register" class="filled-btn" type="submit">Iscriviti ora!</button>
            </form>
        </div>
    </div>
</div>

<?php get_footer(); ?>

