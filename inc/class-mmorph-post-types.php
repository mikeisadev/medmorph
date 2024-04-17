<?php
namespace MMorph\Inc\Theme;

defined( 'ABSPATH' ) || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class PostTypes {

    /**
     * Post types to register on this theme.
     */
    private array $postTypes = [
        'mmp_exams' => [
            'label'                 => 'Esami',
            'labels'                => [
                'name'                  => 'Esami',
                'singular_name'         => 'Esame',
                'menu_name'             => 'Esami',
                'all_items'             => 'Tutti gli esami',
                'add_new'               => 'Aggiungi un nuovo esame',
                'add_new_item'          => 'Aggiungi un nuovo esame',
                'edit_item'             => 'Modifica esame',
                'new_item'              => 'Nuovo esame',
                'view_item'             => 'Visualizza esame',
                'search_items'          => 'Cerca esame',
                'not_found'             => 'Nessun esame trovato',
                'not_found_in_trash'    => 'Nessun esame nel cestino'
            ],
            'description'           => 'In questa sezione potrai gestire tutti gli esami o aggiungerne di nuovi.',
            'menu_icon'             => 'dashicons-book-alt',
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'capability_type'       => 'post',
            'has_archive'           => false,
            'hierarchical'          => false,
            'menu_position'         => 20,
            'show_in_rest'          => false,
            'rewrite'               => ['slug' => 'esame'],
            'supports'              => ['title']
        ],
        'mmp_chapters' => [
            'label'                 => 'Capitoli',
            'labels'                => [
                'name'                  => 'Capitoli',
                'singular_name'         => 'Capitolo',
                'menu_name'             => 'Capitoli',
                'all_items'             => 'Tutti i capitoli',
                'add_new'               => 'Aggiungi un nuovo capitolo',
                'add_new_item'          => 'Aggiungi un nuovo capitolo',
                'edit_item'             => 'Modifica capitolo',
                'new_item'              => 'Nuovo capitolo',
                'view_item'             => 'Visualizza capitolo',
                'search_items'          => 'Cerca capitolo',
                'not_found'             => 'Nessun capitolo trovato',
                'not_found_in_trash'    => 'Nessun capitolo nel cestino'
            ],
            'description'           => 'In questa sezione potrai gestire tutti i capitoli o aggiungerne di nuovi.',
            'menu_icon'             => 'dashicons-media-document',
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'capability_type'       => 'post',
            'has_archive'           => false,
            'hierarchical'          => false,
            'menu_position'         => 20,
            'show_in_rest'          => true,
            'supports'              => ['title']
        ],
        'mmp_paragraphs' => [
            'label'                 => 'Paragrafi',
            'labels'                => [
                'name'                  => 'Paragrafi',
                'singular_name'         => 'Paragrafo',
                'menu_name'             => 'Paragrafi',
                'all_items'             => 'Tutti i paragrafi',
                'add_new'               => 'Aggiungi un nuovo paragrafo',
                'add_new_item'          => 'Aggiungi un nuovo paragrafo',
                'edit_item'             => 'Modifica paragrafo',
                'new_item'              => 'Nuovo paragrafo',
                'view_item'             => 'Visualizza paragrafo',
                'search_items'          => 'Cerca paragrafo',
                'not_found'             => 'Nessun paragrafo trovato',
                'not_found_in_trash'    => 'Nessun paragrafo nel cestino'
            ],
            'description'           => 'In questa sezione potrai gestire tutti i paragrafi o aggiungerne di nuovi.',
            'menu_icon'             => 'dashicons-format-aside',
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'capability_type'       => 'post',
            'has_archive'           => false,
            'hierarchical'          => false,
            'menu_position'         => 20,
            'show_in_rest'          => true,
            'supports'              => ['title', 'editor']
        ],
        'mmp_3dmodels' => [
            'label'                 => 'Modelli 3D',
            'labels'                => [
                'name'                  => 'Modelli 3D',
                'singular_name'         => 'Modello 3D',
                'menu_name'             => 'Modelli 3D',
                'all_items'             => 'Tutti i modelli',
                'add_new'               => 'Aggiungi un nuovo modello',
                'add_new_item'          => 'Aggiungi un nuovo modello',
                'edit_item'             => 'Modifica modello',
                'new_item'              => 'Nuovo modello',
                'view_item'             => 'Visualizza modello',
                'search_items'          => 'Cerca modello',
                'not_found'             => 'Nessun modello trovato',
                'not_found_in_trash'    => 'Nessun modello nel cestino'
            ],
            'description'           => 'In questa sezione potrai gestire tutti i modelli o aggiungerne di nuovi.',
            'menu_icon'             => 'dashicons-block-default',
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'capability_type'       => 'post',
            'has_archive'           => false,
            'hierarchical'          => false,
            'menu_position'         => 20,
            'show_in_rest'          => true,
            'supports'              => ['title']
        ],
        'mmp_mindmaps' => [
            'label'                 => 'Mappe concettuali',
            'labels'                => [
                'name'                  => 'Mappe concettuali',
                'singular_name'         => 'Mappa concettuale',
                'menu_name'             => 'Mappe concettuali',
                'all_items'             => 'Tutti i modelli',
                'add_new'               => 'Aggiungi una nuova mappa',
                'add_new_item'          => 'Aggiungi una nuova mappa',
                'edit_item'             => 'Modifica mappa',
                'new_item'              => 'Nuova mappa',
                'view_item'             => 'Visualizza mappa',
                'search_items'          => 'Cerca mappa',
                'not_found'             => 'Nessuna mappa trovata',
                'not_found_in_trash'    => 'Nessuna mappa nel cestino'
            ],
            'description'           => 'In questa sezione potrai gestire tutte le mappe o aggiungerne delle nuove.',
            'menu_icon'             => 'dashicons-networking',
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'capability_type'       => 'post',
            'has_archive'           => false,
            'hierarchical'          => false,
            'menu_position'         => 20,
            'show_in_rest'          => true,
            'supports'              => ['title']
        ]
    ];

    /**
     * Main instance.
     */
    private static $instance = null;

    /**
     * Get instance.
     */
    public static function getInstance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Private constructor.
     */
    private function __construct() {
        // Register post types.
        add_action('init', [$this, 'register_post_types']);

        // Add fields
        add_action( 'carbon_fields_register_fields', [ $this, 'exams_fields' ] );
        add_action( 'carbon_fields_register_fields', [ $this, 'chapters_fields' ] );
    }

    /**
     * Register all post types.
     */
    public function register_post_types() {
        foreach ($this->postTypes as $postKey => $args) {
            register_post_type( $postKey, $args );
        }
    }

    /**
     * Add fields for each post type.
     * 
     * mmp_exams
     */
    public function exams_fields() {
        Container::make( 'post_meta', 'Dettagli esame' )
        ->where( 'post_type', '=', 'mmp_exams' )
        ->add_fields([
            Field::make( 'image', 'exam_cover', 'Immagine di copertina' ),
            Field::make( 'textarea', 'exam_description', 'Breve descrizione' ),
            Field::make( 'checkbox', 'exam_has_3d_models', 'L\'esame mette a disposizione modelli 3D?' ),
            Field::make( 'checkbox', 'exam_has_conceptual_maps', 'L\'esame mette a disposizione mappe concettuali?' ),
            Field::make( 'association', 'exam_chapters', 'Capitoli' )
                ->set_types( array(
                    array(
                        'type'      => 'post',
                        'post_type' => 'mmp_chapters',
                    )
                ) )
        ]);
    }

    /**
     * mmp_chapters
     */
    public function chapters_fields() {
        Container::make( 'post_meta', 'Configurazione capitolo' )
        ->where( 'post_type', '=', 'mmp_chapters' )
        ->add_fields([
            Field::make( 'text', 'chapter_uuid', 'UUID unico (ignora questo dato)' )
                ->set_default_value( wp_generate_uuid4() )
                ->set_attribute('readOnly', true),
            Field::make( 'textarea', 'chapter_brief_desc', 'Breve descrizione introduttiva al capitolo' ),
            Field::make( 'association', 'chapter_paragraphs', 'Inserisci paragrafi' )
                ->set_types( array(
                    array(
                        'type'      => 'post',
                        'post_type' => 'mmp_paragraphs',
                    )
            ) ),
            Field::make( 'association', 'chapter_3d_models', 'Inserisci modelli 3D per questo capitolo' )
                ->set_types( array(
                    array(
                        'type'      => 'post',
                        'post_type' => 'mmp_3dmodels',
                    )
            ) ),
            Field::make( 'association', 'chapter_mind_maps', 'Inserisci delle mappe concettuali per questo capitolo' )
                ->set_types( array(
                    array(
                        'type'      => 'post',
                        'post_type' => 'mmp_mindmaps',
                    )
            ) )
        ]);
    }
    

}