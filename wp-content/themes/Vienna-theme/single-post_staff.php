<?php get_header(); ?>

<div class="container pm-containerPadding80">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>                
            <?php endwhile; else: ?>
                <p><?php echo _e('No content was found.', 'viennatheme'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>