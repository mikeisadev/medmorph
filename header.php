<?php defined( 'ABSPATH' ) || exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="header" class="w-100 index-5 <?php echo is_home() ? 'absolute' : ''; ?>">
        <div class="header-wrap w-1200 m-auto">
            <?= mp_get_template(name: 'logo'); ?>
            <div class="h-cont nav-menu justify-center">
                <?= wp_nav_menu(['menu' => 'Header']); ?>
            </div>
            <div class="h-cont header-endpoints">
                <div class="header-endpoints-wrap flex" style="gap:8px;">
                <?php 
                if (!is_user_logged_in()) { ?>
                    <div class="outline-btn dropdown-btn" data-dropdown-menu="user-endpoints">
                        <p>Account</p>
                        <i class="bi bi-person-circle"></i>
                    </div>
                <?php } else { 
                    $user = get_current_user();
                    ?>
                    <div class="outline-btn dropdown-btn rounded-full ratio-1" data-dropdown-menu="user-nots">
                        <i class="bi bi-bell"></i>
                    </div>
                    <div class="outline-btn dropdown-btn rounded-full ratio-1" data-dropdown-menu="user-apps">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </div>
                    <div class="outline-btn dropdown-btn" data-dropdown-menu="user-endpoints">
                        <p>Ciao, <?php print($user) ?></p>
                        <i class="bi bi-person-circle"></i>
                    </div>
                <?php } ?>
                </div>
            </div>
            <?php 
            if (!is_user_logged_in()) { ?>
                <div class="dropdown-menu header-user-dropdown hide" data-dropdown-menu="user-endpoints">
                    <?php 
                        foreach (wp_get_nav_menu_items('menù-di-accesso') as $item) { ?>
                            <a class="dropdown-el" href="<?= esc_attr( $item->url ) ?>">
                                <?= esc_html( $item->title ); ?>
                            </a>
                    <?php } ?>
            </div>
            <?php } else { ?>
                <div class="dropdown-menu header-user-dropdown hide" data-dropdown-menu="user-endpoints">
                    <a class="dropdown-el" href="">Bacheca</a>
                    <a class="dropdown-el" href="">Il mio account</a>
                    <a class="dropdown-el" href="">Esami</a>
                    <a class="dropdown-el" style="color:red;" href="<?= esc_url( wp_logout_url( get_site_url() ) )  ?>">Esci</a>
                </div>

                <div class="dropdown-menu header-user-dropdown hide" data-dropdown-menu="user-apps">
                    <a class="dropdown-el" href="">Esami</a>
                    <a class="dropdown-el" href="">Modelli 3D</a>
                    <a class="dropdown-el" href="">Mappe</a>
                    <a class="dropdown-el" href="">Note</a>
                </div>

                <div class="dropdown-menu header-user-dropdown hide" data-dropdown-menu="user-nots">
                    <p>Nessuna notifica al momento</p>
                </div>
            <?php } ?> 
        </div>
    </header>