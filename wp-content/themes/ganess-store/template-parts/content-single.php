<div class="cell large-8 medium-8 grid-xyz for-search-bx">
    <?php 
    if( has_post_thumbnail( )): ?>
        <div class="headline">
            <?php the_post_thumbnail('ganess-store-banner-image'); ?>
            <div class="date">
                <span class="num"><?php echo esc_html(get_the_date( 'd' )); ?></span>
                <span class="month"><?php echo esc_html(get_the_date( 'M' )); ?></span>
                <span class="year"><?php echo esc_html(get_the_date( 'Y' )); ?></span>
            </div>
        </div>
    <?php endif; ?>

<div class="title">
    <h1><?php the_title(); ?></h1>
    <div class="list">
        <i class=" fa fa-user" aria-hidden="true"></i>
        <span><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php echo esc_html(get_the_author()); ?></a></span>
        <span class="seperate">|</span>
    </div>
    <div class="list">
        <i class="fa fa-calendar" aria-hidden="true"></i>
        <span><?php the_date(get_option('date_format')); ?></span>
        <span class="seperate">|</span>
    </div>
    <div class="list">
        <i class="fa fa-list-ul" aria-hidden="true"></i>
        <span><?php  the_category(", "); ?></span>
        <span class="seperate">|</span>
    </div>
    <div class="list">
    <a href="<?php echo esc_url(get_comments_link( $post->ID )); ?>">
        <i class="fa fa-comment"></i>&nbsp;
        <span><?php printf( esc_html( _n( '%d Comment', '%d Comments', get_comments_number(), 'ganess-store'  ) ), esc_html(number_format_i18n(get_comments_number()))); ?>
        </span>
    </a>
    </div>
</div>
<?php the_content(); ?>