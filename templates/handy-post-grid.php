<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Handy_render_Post_Grid
{
    public static function handy_post_grid_widget_render($settings)
    {

        $post_type = in_array($settings['handy_post_query'], ['post', 'page']) ? $settings['handy_post_query'] : 'post';
        $post_per_page = !empty($settings['handy_post_grid_per_page']) ? intval($settings['handy_post_grid_per_page']) : 4;
        $columns_class = !empty($settings['handy_post_grid_columns']) ? $settings['handy_post_grid_columns'] : 'handy-col-4'; 

        // var_dump($post_type); die();
       $args = array(
            'post_type'      => $post_type,
            'posts_per_page' => $post_per_page,
            'post_status'    => 'publish',
        );

        // Use the helper function to fetch posts
        $query = Handy_helper_Class::handy_get_all_post( $args );

        if ( $query->have_posts() ) {
            echo '<div class="handy-post-grid ' . esc_attr( $columns_class ) . '">'; 

            while ( $query->have_posts() ) {
                $query->the_post();

                // Check if image display is enabled
                if ( ! empty( $settings['handy_show_image'] ) && $settings['handy_show_image'] === 'yes' ) {
                    // Get image size from control (fallback to 'medium')
                    $image_size = ! empty( $settings['image_size'] ) ? $settings['image_size'] : 'medium';
                    $image_url  = get_the_post_thumbnail_url( get_the_ID(), $image_size );

                    // Fallback placeholder
                    if (!$image_url) {
                        $image_url = 'https://via.placeholder.com/600x350?text=No+Image';
                    }
                }

                // Get and trim excerpt
                $excerpt         = get_the_excerpt();
                $excerpt_length  = ! empty( $settings['handy_excerpt_length'] ) ? $settings['handy_excerpt_length'] : 10;
                $excerpt         = wp_trim_words( $excerpt, $excerpt_length, $settings['handy_excerpt_expanison_indicator'] ?? '...' );
                ?>

                <div class="handy-post-card">

                    <?php if ( $post_type === 'post' ) : ?>
                        <?php if ( ! empty( $settings['handy_show_image'] ) && $settings['handy_show_image'] === 'yes' ) : ?>
                            <div class="handy-post-image" style="background-image: url('<?php echo esc_url( $image_url ); ?>');"></div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="handy-post-content">

                        <!-- Show Title -->
                        <?php if ( ! empty( $settings['handy_show_title'] ) && $settings['handy_show_title'] === 'yes' ) : ?>
                            <h2 class="handy-post-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo esc_html( ucwords( get_the_title() ) ); ?>
                                </a>
                            </h2>
                        <?php endif; ?>

                        <!-- Show Excerpt -->
                        <?php if ( ! empty( $settings['handy_show_excerpt'] ) && $settings['handy_show_excerpt'] === 'yes' ) : ?>
                            <div class="handy-post-excerpt"><?php echo esc_html( $excerpt ); ?></div>
                        <?php endif; ?>

                        <!-- Meta Section -->
                        <?php if ( ! empty( $settings['handy_show_meta'] ) && $settings['handy_show_meta'] === 'yes' ) : ?>
                            <div class="handy-post-meta <?php echo esc_attr( $settings['handy_meta_position'] ); ?>">
                                <?php if ( ! empty( $settings['handy_show_avatar'] ) && $settings['handy_show_avatar'] === 'yes' ) : ?>
                                    <div class="handy-post-avatar show-avatar">
                                        <?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( ! empty( $settings['handy_show_author'] ) && $settings['handy_show_author'] === 'yes' ) : ?>
                                    <span class="handy-post-author show-author"><?php the_author(); ?></span>
                                <?php endif; ?>

                                <span class="handy-post-date"><?php echo get_the_date(); ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Read More Button -->
                        <?php if ( ! empty( $settings['handy_show_read_more_button'] ) && $settings['handy_show_read_more_button'] === 'yes' ) : ?>
                            <a class="handy-read-more-btn" href="<?php the_permalink(); ?>">
                                <?php echo esc_html( $settings['handy_read_more_button_text'] ); ?>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>

                <?php
            }

            echo '</div>';
            wp_reset_postdata();
        }
        else {
            echo '<p class="handy-no-posts">No posts found.</p>';
        }
    }
}

?>