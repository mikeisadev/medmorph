<?php get_header(); ?>

<div class="section above-the-fold m-auto index-1 flex flex-col align-center">
    <div class="section-inner w-1200 m-auto">
        <div class="section-wrap flex gap-20 m-auto">
            <div class="content-view w-100 flex flex-col gap-40 justify-center">
                <div class="section-content flex flex-col gap-10 pt-40">
                    <h1 class="fw-500 fs-38">Studia per il tuo prossimo esame di medicina con semplicità.</h1>
                    <p>Iscrivendoti su MedMorph avrai accesso a tantissimi esami della facoltà di medicina. Per ogni esame avrai tutti gli appunti necessari per supportare il tuo percorso di studi.</p>
                </div>
                <div class="section-cta">
                    <div class="section-actions">
                        <button class="filled-btn p-10">Scopri di più</button>
                        <button class="outline-btn p-10">Vedi esami disponibili</button>
                    </div>
                    <p style="font-size:14px;margin: 10px 0 0 0;">Lavora con noi e diventa autore</p>
                </div>
            </div>
                <div id="abf-3d-viewer" class="3d-view w-100">
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="section-inner w-1200 m-auto py-40">
        <div class="section-wrap">
            <h2 class="fw-500 fs-30 ta-center mb-20">Esami disponibili</h2>

            <div class="section-content grid grid-3-col grid-gap-20">
                <?php
                $q = new WP_Query([
                    'post_type'         => 'mp_exams',
                    'posts_per_page'    => -1,
                    'post_status'       => 'publish'
                ]);

                if ($q->have_posts()) {
                    while($q->have_posts()) {
                        $q->the_post();
                        $id = get_the_ID();
                        $chapters = count( carbon_get_post_meta($id, 'exam_chapters') );

                        ?>
                        <div id="exam-<?= esc_attr($id); ?>" class="single-box single-exam ta-center">
                            <div class="single-exam-wrap">
                                <h4 class="fs-22 fw-500 mb-30"><?php the_title(); ?></h4>
                                <p class="mb-15 fs-15"><?php echo carbon_get_post_meta($id, 'exam_description'); ?></p>

                                <div class="exam-meta flex justify-center fs-12 mb-30 flex-wrap">
                                    <?php 
                                        echo '<p><i class="bi bi-book"></i> ' . $chapters . ($chapters > 1 || $chapters === 0 ? ' capitoli' : ' capitolo') . '</p>';
                                        echo carbon_get_post_meta($id, 'exam_has_3d_models') ? '<p><i class="bi bi-badge-3d"></i> Modelli 3D</p>' : '';
                                        echo carbon_get_post_meta($id, 'exam_has_conceptual_maps') ? '<p><i class="bi bi-diagram-3"></i> Mappe concettuali</p>' : '';
                                    ?>
                                </div>

                                <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="filled-btn w-max-content m-auto" role="button" data-action="start-exam">Vedi esame</a>
                            </div>
                        </div>
                        <?php
                    }

                    wp_reset_postdata();
                } else {
                    echo '<p>Nessun esame disponibile!</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="section-inner w-1200 m-auto py-40">
        <div class="section-wrap">
            <h2 class="fw-500 fs-30 ta-center mb-20">Lavora per Moorph</h2>

            <p>Collabora con Moorph e inzia a scrivere i contenuti per noi (ci lavoriamo)</p>

            <button class="outline-btn p-10">Vedi esami disponibili</button>

            <p>
                Vai su una nuova pagina e c'è il procedimento che mi ha detto Domenico (attenersi a quel modello)
            </p>
        </div>
    </div>
</div>

<?php get_footer(); ?>