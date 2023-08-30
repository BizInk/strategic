<?php if( have_rows('hero_slides') ){ ?>

    <!-- Hero Banner slier section-start -->
    <section class="hero-banner-slider-section">
        <div class="hero-slider">
            <?php while( have_rows('hero_slides') ){
                the_row();

                $hero_slide_image = get_sub_field('hero_slide_image');
                $hero_slide_title = get_sub_field('hero_slide_title');
                $hero_slide_content = get_sub_field('hero_slide_content');
                $hero_slide_button = get_sub_field('hero_slide_button');

                if( !empty($hero_slide_image) ){ ?>

                    <div class="hero-slide-item overlay" style="background-image: url(<?= $hero_slide_image; ?>);">
                        <div class="container">
                            <div class="hero-slide-content">
                                <?php if( !empty($hero_slide_image) ){ ?>

                                    <h1><?= $hero_slide_title; ?></h1>
                                <?php }

                                echo $hero_slide_content;

                                if( !empty($hero_slide_button['url']) && !empty($hero_slide_button['title']) ){ ?>

                                    <div class="btn-action">
                                        <a href="<?= $hero_slide_button['url']; ?>" target="<?= $hero_slide_button['target']; ?>" class="btn navyblue-btn"><?= $hero_slide_button['title']; ?> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-right.svg" alt=""></a>
                                    </div>
                                <?php } ?> 
                            </div> 
                        </div>    
                    </div>
                <?php }
            } ?>
        </div>      
    </section>
    <!-- Hero Banner slier section End --> 
<?php } ?>