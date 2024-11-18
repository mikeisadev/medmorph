<?php
namespace Moorph\Inc\Theme;

defined( 'ABSPATH' ) || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class PostTypes {

    /**
     * Post types to register on this theme.
     */
    private array $postTypes = [
        'mp_exams' => [
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
        'mp_chapters' => [
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
        'mp_paragraphs' => [
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
        'mp_3dmodels' => [
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
        'mp_mindmaps' => [
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
        ],
        'mp_expimg' => [
            'label'                 => 'Immagini esplose',
            'labels'                => [
                'name'                  => 'Immagini esplose',
                'singular_name'         => 'Immagine esplosa',
                'menu_name'             => 'Immagini esplose',
                'all_items'             => 'Tutti i modelli',
                'add_new'               => 'Aggiungi una nuova immagine esplosa',
                'add_new_item'          => 'Aggiungi una nuova immagine esplosa',
                'edit_item'             => 'Modifica immagine esplosa',
                'new_item'              => 'Nuova immagine esplosa',
                'view_item'             => 'Visualizza immagine esplosa',
                'search_items'          => 'Cerca immagine esplosa',
                'not_found'             => 'Nessuna immagine esplosa trovata',
                'not_found_in_trash'    => 'Nessuna immagine esplosa nel cestino'
            ],
            'description'           => 'In questa sezione potrai gestire tutte le mappe o aggiungerne delle nuove.',
            'menu_icon'             => 'dashicons-images-alt2',
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
        'mp_usernotes' => [
            'label'                 => 'Note utenti',
            'labels'                => [
                'name'                  => 'Note utenti',
                'singular_name'         => 'Immagine esplosa',
                'menu_name'             => 'Note utenti',
                'all_items'             => 'Tutti i modelli',
                'add_new'               => 'Aggiungi una nuova immagine esplosa',
                'add_new_item'          => 'Aggiungi una nuova immagine esplosa',
                'edit_item'             => 'Modifica immagine esplosa',
                'new_item'              => 'Nuova immagine esplosa',
                'view_item'             => 'Visualizza immagine esplosa',
                'search_items'          => 'Cerca immagine esplosa',
                'not_found'             => 'Nessuna immagine esplosa trovata',
                'not_found_in_trash'    => 'Nessuna immagine esplosa nel cestino'
            ],
            'description'           => 'In questa sezione potrai gestire tutte le mappe o aggiungerne delle nuove.',
            'menu_icon'             => 'dashicons-text-page',
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
        'mp_newslettersubs' => [
            'label'                 => 'Iscritti newsletter',
            'labels'                => [
                'name'                  => 'Iscritti newsletter',
                'singular_name'         => 'Iscritto newsletter',
                'menu_name'             => 'Iscritti newsletter',
                'all_items'             => 'Tutti i modelli',
                'add_new'               => 'Aggiungi una nuova Iscritto newsletter',
                'add_new_item'          => 'Aggiungi una nuova Iscritto newsletter',
                'edit_item'             => 'Modifica Iscritto newsletter',
                'new_item'              => 'Nuova Iscritto newsletter',
                'view_item'             => 'Visualizza Iscritto newsletter',
                'search_items'          => 'Cerca Iscritto newsletter',
                'not_found'             => 'Nessuna Iscritto newsletter trovata',
                'not_found_in_trash'    => 'Nessuna Iscritto newsletter nel cestino'
            ],
            'description'           => 'In questa sezione potrai gestire tutti gli iscritti alla newsletter.',
            'menu_icon'             => 'dashicons-admin-users',
            'public'                => false,
            'publicly_queryable'    => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'capability_type'       => 'post',
            'has_archive'           => false,
            'hierarchical'          => false,
            'menu_position'         => 20,
            'show_in_rest'          => false,
            'supports'              => ['title']
        ],
        'mp_wiki' => [
            'label'                 => 'Termini enciclopedia',
            'labels'                => [
                'name'                  => 'Termini enciclopedia',
                'singular_name'         => 'Termine',
                'menu_name'             => 'Termini enciclopedia',
                'all_items'             => 'Tutti i termini',
                'add_new'               => 'Aggiungi un nuovo termine',
                'add_new_item'          => 'Aggiungi un nuovo termine',
                'edit_item'             => 'Modifica termine',
                'new_item'              => 'Nuovo termine',
                'view_item'             => 'Visualizza termine',
                'search_items'          => 'Cerca termine',
                'not_found'             => 'Nessun termine trovato',
                'not_found_in_trash'    => 'Nessun termine nel cestino'
            ],
            'description'           => 'In questa sezione potrai gestire tutti i termini dell\'enciclopedia Moorph.',
            'menu_icon'             => 'dashicons-book-alt',
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => true,
            'menu_position'         => 20,
            'show_in_rest'          => true,
            'rewrite'               => ['slug' => 'termine'],
            'supports'              => ['title', 'editor']
        ],
    ];

    /**
     * Custom taxonomies to register for custom post types.
     */
    private array $postTaxonomies = [
        'mp_wiki' => [
            'taxonomy_id'              => 'mp_wiki_category',
            'taxonomy_conf'            => [
                'label' => 'Categoria termine',
                'hierarchical' => false,
                'rewrite' => ['slug' => 'term-category'],
                'show_admin_column' => true,
                'show_in_rest' => true,
                'labels' => [
                    'singular_name' => 'Categoria',
                    'all_items' => 'Tutte le categorie',
                    'edit_item' => 'Modifica categoria',
                    'view_item' => 'Vedi categoria',
                    'update_item' => 'Aggiorna categoria',
                    'add_new_item' => 'Aggiungi nuova categoria',
                    'new_item_name' => 'Nome della nuova categoria',
                    'search_items' => 'Cerca categoria',
                    'popular_items' => 'Categorie popolari',
                    'separate_items_with_commas' => 'Separa categorie con virgola',
                    'choose_from_most_used' => 'Scegli dalle categorie più usate',
                    'not_found' => 'Nessuna categoria trovata',
                ]
            ]
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
        add_action('init', [$this, 'register_custom_taxonomy_post_type']);

        // Add fields
        add_action( 'carbon_fields_register_fields', [ $this, 'exams_fields' ] );
        add_action( 'carbon_fields_register_fields', [ $this, 'chapters_fields' ] );
        add_action( 'carbon_fields_register_fields', [ $this, 'newsletter_users' ] );
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
     * Register custom taxonomy of custom post types.
     */
    public function register_custom_taxonomy_post_type() {
        foreach ($this->postTaxonomies as $postKey => $args) {
            register_taxonomy( $args['taxonomy_id'], $postKey, $args['taxonomy_conf'] );
        }
    }

    /**
     * Add fields for each post type.
     * 
     * mmp_exams
     */
    public function exams_fields() {
        Container::make( 'post_meta', 'Dettagli esame' )
        ->where( 'post_type', '=', 'mp_exams' )
        ->add_fields([
            Field::make( 'image', 'exam_cover', 'Immagine di copertina' ),
            Field::make( 'textarea', 'exam_description', 'Breve descrizione' ),
            Field::make( 'checkbox', 'exam_has_3d_models', 'L\'esame mette a disposizione modelli 3D?' ),
            Field::make( 'checkbox', 'exam_has_conceptual_maps', 'L\'esame mette a disposizione mappe concettuali?' ),
            Field::make( 'association', 'exam_chapters', 'Capitoli' )
                ->set_types( array(
                    array(
                        'type'      => 'post',
                        'post_type' => 'mp_chapters',
                    )
                ) )
        ]);
    }

    /**
     * mmp_chapters
     */
    public function chapters_fields() {
        Container::make( 'post_meta', 'Configurazione capitolo' )
        ->where( 'post_type', '=', 'mp_chapters' )
        ->add_fields([
            Field::make( 'text', 'chapter_uuid', 'UUID unico (ignora questo dato)' )
                ->set_default_value( wp_generate_uuid4() )
                ->set_attribute('readOnly', true),
            Field::make( 'textarea', 'chapter_brief_desc', 'Breve descrizione introduttiva al capitolo' ),
            Field::make( 'association', 'chapter_paragraphs', 'Inserisci paragrafi' )
                ->set_types( array(
                    array(
                        'type'      => 'post',
                        'post_type' => 'mp_paragraphs',
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

    /**
     * Newsletter users
     */
    public function newsletter_users() {
        Container::make( 'post_meta', 'Informazioni iscritto' )
        ->where( 'post_type', '=', 'mp_newslettersubs' )
        ->add_fields([
            Field::make( 'text', 'sub_name', 'Nome e cognome iscritto' )
                ->set_attribute('readOnly', true),
            Field::make( 'text', 'sub_email', 'Email iscritto' )
                ->set_attribute('readOnly', true),
            Field::make( 'text', 'sub_origin', 'Origine iscrizione' )
                ->set_attribute('readOnly', true),
            Field::make( 'text', 'sub_date', 'Data iscrizione' )    
                ->set_attribute('readOnly', true)
        ]);
    }
    

}