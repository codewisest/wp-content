<?php
/**
 * The default template to display the content of the single post, page or attachment
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix post_item_single post_type_'.esc_attr(get_post_type())
        . ' post_format_'.esc_attr(str_replace('post-format-', '', get_post_format()))
        . ' itemscope'
    ); ?>
             itemscope itemtype="http://schema.org/<?php echo esc_attr(is_single() ? 'BlogPosting' : 'Article'); ?>">
        <?php
        // Structured data snippets
        if (green_planet_is_on(green_planet_get_theme_option('seo_snippets'))) {
            ?>
            <div class="structured_data_snippets">
                <meta itemprop="headline" content="<?php echo esc_attr(get_the_title()); ?>">
                <meta itemprop="datePublished" content="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
                <meta itemprop="dateModified" content="<?php echo esc_attr(get_the_modified_date('Y-m-d')); ?>">
                <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php echo esc_url(get_the_permalink()); ?>" content="<?php echo esc_attr(get_the_title()); ?>"/>
                <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                    <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                        <?php
                        $green_planet_logo_image = green_planet_get_retina_multiplier(2) > 1
                            ? green_planet_get_theme_option( 'logo_retina' )
                            : green_planet_get_theme_option( 'logo' );
                        if (!empty($green_planet_logo_image)) {
                            $green_planet_attr = green_planet_getimagesize($green_planet_logo_image);
                            ?>
                            <img itemprop="url" src="<?php echo esc_url($green_planet_logo_image); ?>">
                            <meta itemprop="width" content="<?php echo esc_attr($green_planet_attr[0]); ?>">
                            <meta itemprop="height" content="<?php echo esc_attr($green_planet_attr[1]); ?>">
                            <?php
                        }
                        ?>
                    </div>
                    <meta itemprop="name" content="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
                    <meta itemprop="telephone" content="">
                    <meta itemprop="address" content="">
                </div>
            </div>
            <?php
        }

        // Featured image
        if ( !green_planet_sc_layouts_showed('featured'))
            green_planet_show_post_featured();

        // Title and post meta
        if ( (!green_planet_sc_layouts_showed('title') || !green_planet_sc_layouts_showed('postmeta')) && !in_array(get_post_format(), array('link', 'aside', 'status', 'quote')) ) {
            ?>
            <div class="post_header entry-header">
                <?php
                // Post title
                if (!green_planet_sc_layouts_showed('title')) {
                    the_title( '<h4 class="post_title entry-title"'.(green_planet_is_on(green_planet_get_theme_option('seo_snippets')) ? ' itemprop="headline"' : '').'>', '</h4>' );
                }
                // Post meta
                if (!green_planet_sc_layouts_showed('postmeta')) {
                    green_planet_show_post_meta(array(
                            'categories' => true,
                            'date' => true,
                            'edit' => false,
                            'author' => true,
                            'seo' => false,
                            'share' => false,
                            'counters' => ''	//comments,likes,views - comma separated in any combination
                        )
                    );
                }
                ?>
            </div><!-- .post_header -->
            <?php
        }


        // Post content
        ?>
        <div class="post_content entry-content clearfix" itemprop="articleBody">
            <?php
            the_content( );

            wp_link_pages( array(
                'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'green-planet' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'green-planet' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ) );

            // Taxonomies and share
            if ( is_single() && !is_attachment() and false ) {
                ?>
                <div class="post_meta post_meta_single"><?php

                    // Post taxonomies
                    the_tags( '<span class="post_meta_item post_tags"><span class="post_meta_label">'.esc_html__('Tags:', 'green-planet').'</span> ', ', ', '</span>' );

                    // Share
                    green_planet_show_share_links(array(
                        'type' => 'block',
                        'caption' => '',
                        'before' => '<span class="post_meta_item post_share">',
                        'after' => '</span>'
                    ));
                    ?>
                </div>
                <?php
            }

            ?>
            <div class="tags"><span class="tags-entry">Tags:</span>
                <?php the_tags( '', ',', '' );  ?>
            </div>
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

            ?>
        </div><!-- .entry-content -->
        <div class="clearfix"></div>
    </article>

<?php
// Author bio.
if ( is_single() && !is_attachment() && get_the_author_meta( 'description' ) ) {
    get_template_part( 'templates/author-bio-content' );
}
?>