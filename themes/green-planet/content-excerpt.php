<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

$green_planet_post_format = get_post_format();
$green_planet_post_format = empty($green_planet_post_format) ? 'standard' : str_replace('post-format-', '', $green_planet_post_format);
$green_planet_full_content = green_planet_get_theme_option('blog_content') != 'excerpt' || in_array($green_planet_post_format, array('link', 'aside', 'status', 'quote'));
$green_planet_animation = green_planet_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>"
    <?php post_class( 'clearfix post_item post_layout_excerpt custom post_format_' .esc_attr($green_planet_post_format) ); ?>
    <?php echo (!green_planet_is_off($green_planet_animation) ? ' data-animation="'.esc_attr(green_planet_get_animation_classes($green_planet_animation)).'"' : ''); ?>
><?php

    // Featured image
    green_planet_show_post_featured(array( 'thumb_size' => green_planet_get_thumb_size( strpos(green_planet_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

    // Title and post meta
    if (get_the_title() != '') {
        ?>
        <div class="post_header entry-header">
            <?php


            do_action('green_planet_action_before_post_meta');


                // Post meta
                green_planet_show_post_meta(array(
                        'categories' => true,
                        'date' => true,
                        'edit' => false,
                        'author' => true,
                        'seo' => false,
                        'share' => false,
                        'counters' => ''    //comments,likes,views - comma separated in any combination
                    )
                );


            do_action('green_planet_action_before_post_title');
            // Post title

            the_title(sprintf('<h4 class="post_title entry-title clearfix"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h4>');


            ?>
        </div><!-- .post_header --><?php
    }
    // Post content
    ?><div class="post_content entry-content clearfix"><?php
        if ($green_planet_full_content) {
            // Post content area
            ?><div class="post_content_inner"><?php
            the_content( '' );
            ?></div><?php
            // Inner pages
            wp_link_pages( array(
                'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'green-planet' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'green-planet' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ) );

        } else {

            $green_planet_show_learn_more = !in_array($green_planet_post_format, array('link', 'aside', 'status', 'quote'));

            // Post content area
            ?><div class="post_content_inner"><?php
            if (has_excerpt()) {
                the_excerpt();
            } else if (strpos(get_the_content('!--more'), '!--more')!==false) {
                the_content( '' );
            } else if (in_array($green_planet_post_format, array('link', 'aside', 'status', 'quote'))) {
                the_content();
            } else if (substr(get_the_content(), 0, 1)!='[') {
                the_excerpt();
            }
            ?></div>

                <?php if( get_the_tags() ) { ?>
                    <div class="tags"><span class="tags-entry">Tags:</span>
                        <?php

                        the_tags( '', ',', '' );  ?>
                    </div>
                <?php } ?>
                <?php
                // Post meta
                green_planet_show_post_meta(array(
                        'categories' => false,
                        'date' => false,
                        'edit' => false,
                        'author' => false,
                        'seo' => false,
                        'share' => false,
                        'counters' => 'comments,likes'	//comments,likes,views - comma separated in any combination
                    )
                );

        }
        ?></div><?php


        ?><div class="clearfix"></div><!-- .entry-content -->
</article>