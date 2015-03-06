<?php
 
/**
 * Template Name: Card Template
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive
 */

// Then add custom post content
add_action( 'genesis_entry_content', 'clb_publish_cards', 12 );

function clb_publish_cards() { 

    if( have_rows('cards') ): 

        echo '<hr /><br/>';

        $counter = 0;

        while( have_rows('cards') ): the_row(); 

        $counter++;

            // vars
            $image = get_sub_field('image');
            $title = get_sub_field('page_title');
            $link = get_sub_field('page_link');
//            $slug = $link->slug;
//            $link = 'http://projectpomegranate.tomatillohosting.com/resource-category/' . $link->slug;
//            $description = get_sub_field('description');

            if ( ($counter == 1) || ($counter == 3) || ($counter == 5) || ($counter == 7) ) {
                $div_class = 'one-half first';
            } else {
                $div_class = 'one-half';
            }

            echo '<div class="' . $div_class . '"><div class="card"><a href="' . $link . '">';

                    $size = 'large'; // (thumbnail, medium, large, full or custom size)
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size); 
                    }

                echo '</a>';

                echo '<h3 class="card-title"><a href="' . $link . '">' . $title . '</a></h3>';

//                echo '<div class="card-description">' . $description . '</div>';

//                echo '<div class="card-button"><a href="' . $link . '" class="button">View Now</a></h4></div>';

                if( ($counter == 2) || ($counter == 4) || ($counter == 6)) {
                    echo '<br clear="all">';
                }

                echo '</div></div>';

        endwhile;

    endif;

    $additional_page_text = get_field('additional_page_text');
    if( $additional_page_text ) : echo '<br clear="all"><div class="additional-page-text"><hr />' . $additional_page_text . '</div>'; endif;
 
}
  
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();