<?php 

get_header();

/**
 * Note add this validation before the page loads inside a
 * proper php class.
 */
$types = ['chapter', '3dmodel', 'mindmap'];

if ( !isset($_GET) ) {
    echo "Non puoi accedere su questa pagina";
}

if ( !array_key_exists('type', $_GET) || !array_key_exists('src_id', $_GET) ) {
    echo "Impossibile leggere la risorsa richiesta";
}

$type = sanitize_text_field( $_GET['type'] );
$src_id = sanitize_text_field( $_GET['src_id'] );

if ( !in_array($type, $types) ) {
    echo "Non possiamo soddisfare la tua richiesta";
}

if ( !wp_is_uuid($src_id) ) {
    echo "Non possiamo soddisfare la tua richiesta";
}

/**
 * Define a root for REACT based on the viewer type.
 */
?>
<div class="viewer-full-width">
    <div class="viewer-inner w-1200 m-auto">
        <div class="viewer-header py-10 flex justify-center align-center">
            <div class="w-25">
                Torna ai capitoli
            </div>
            <h2 class="fs-24 fw-500 w-50 ta-center"><?php echo get_the_title( get_post_id_by_uuid($src_id) ); ?></h2>
            <div class="w-25 ta-right">
                <?php echo mp_count_chapter_paragraphs($src_id); ?>
            </div>
        </div>
        <?php
        switch($type) {
            case 'chapter':
                echo '<div id="chapter-viewer" class="flex flex-col gap-15 w-900 m-auto pt-40"></div>';
                break;
            case '3dmodel':
                echo '<div id="thrdmodel-viewer"></div>';
                break;
            case 'mindmap':
                echo '<div id="mindmap-viewer"></div>';
                break;
        } 
        ?>
    </div>
</div>

<?php get_footer(); ?>