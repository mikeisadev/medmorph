<?php defined( 'ABSPATH' ) || exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="header" class="w-1200 m-auto index-5 <?php echo is_home() ? 'absolute' : ''; ?>">
        <?= mmorph_get_template(name: 'logo'); ?>
        <div class="h-cont nav-menu justify-center">
            <?= wp_nav_menu(['menu' => 'Header']); ?>
        </div>
        <div class="h-cont header-endpoints">
            <div class="header-endpoints-wrap">
                <div class="outline-btn dropdown-btn" data-dropdown-menu="user-endpoints">
                    <p>Account</p>
                    <i class="bi bi-person-circle"></i>
                </div>
            </div>
        </div>
        <div class="dropdown-menu header-user-dropdown hide" data-dropdown-menu="user-endpoints">
            <div class="dropdown-el"><a href="<?= esc_attr( get_site_url() . '/login' ); ?>">Accedi</a></div>
            <div class="dropdown-el"><a href="<?= esc_attr( get_site_url() . '/register' ); ?>">Registrati</a></div>
        </div>
    </header>