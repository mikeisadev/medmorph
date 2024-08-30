<?php get_header(); ?>

<div class="section">
    <div class="section-inner w-1200 m-auto">
        <?php 
            while( have_posts() ) {
                the_post();
                $id = get_the_ID();

                $chapters = carbon_get_post_meta($id, 'exam_chapters');
                $countChapt = count($chapters);

                ?>
                <div class="section-header py-30">
                    <h2 class="fs-26 fw-500 mb-15"><?php the_title(); ?></h2>
                    <?php
                    echo '<p class="fs-15"><i class="bi bi-book"></i> ' . $countChapt . ($countChapt > 1 || $countChapt === 0 ? ' capitoli' : ' capitolo') . '</p>';
                    ?>
                </div>
                
                <div class="section-content">
                    <div id="exams-root"></div>
                </div>
                <?php
            }
        ?>
    </div>
</div>

<?php get_footer(); ?>