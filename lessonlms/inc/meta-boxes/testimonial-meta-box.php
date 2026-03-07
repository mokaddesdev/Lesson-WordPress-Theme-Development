<?php
/**
 * Testimonial meta box
 * 
 * @package lessonlms
 */

if ( ! function_exists( 'lessonlms_testimonial_add_meta_box' ) ) {
    function lessonlms_testimonial_add_meta_box( $post_type )
    { 
        $post_types = array( 'testimonials' );
        if( in_array( $post_type, $post_types ) ) {
             add_meta_box(
            'testimonial_details',
            'Testimonial Details',
            'lessonlms_testimonial_meta_box_callback',
            $post_type,
            'normal',
            'high'
        );
        }
    }
}
add_action( 'add_meta_boxes', 'lessonlms_testimonial_add_meta_box' );
    
if ( ! function_exists( 'lessonlms_testimonial_meta_box_callback' ) ) {
    function lessonlms_testimonial_meta_box_callback( $post )
    {
        wp_nonce_field( 'testimonial_meta_box', 'testimonial_meta_box_nonce' );

        $student_desig = get_post_meta( $post->ID, '_student_designation', true );
        ?>
        <div class="">
            <label for="student_designation">
                 <?php echo esc_html__( 'Student Designation', 'lessonlms' ); ?>
                </label>
            <input type="text" name="_student_designation" id="student_designation" value="<?php echo esc_attr( $student_desig ); ?>">
        </div>
        <?php
    }
}

if ( ! function_exists( 'lessonlms_testimonial_save_meta_data' ) ) {
     function lessonlms_testimonial_save_meta_data( $post_id )
    {
        if ( ! isset( $_POST['testimonial_meta_box_nonce'] ) ) {
            return $post_id;
        }

        $nonce = $_POST['testimonial_meta_box_nonce'];
        if ( ! wp_verify_nonce( $nonce, 'testimonial_meta_box') ) {
            return $post_id;
        }

        if ( defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }

        if ( 'testimonials' !== get_post_type( $post_id ) ) {
            return $post_id;

        }

        if ( isset( $_POST['_student_designation'] ) ) {
            $std_design = sanitize_text_field( $_POST['_student_designation'] );
            update_post_meta( $post_id, '_student_designation', $std_design );
        }
    }
    add_action('save_post_testimonials', 'lessonlms_testimonial_save_meta_data');
}