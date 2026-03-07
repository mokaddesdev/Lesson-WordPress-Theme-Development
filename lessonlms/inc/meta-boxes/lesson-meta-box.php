<?php
/**
 * Lesson meta box
 *
 * @package lessonlms
 */

if ( ! function_exists( 'lessonlms_lesson_meta_box' ) ) {
    function lessonlms_lesson_meta_box( $post_type ) {
        $post_types = array( 'lessons' );
        if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'lesson_meta_box',
                'Lesson Meta Box',
                'lessonlms_lesson_meta_box_callback',
                $post_type,
                'normal',
                'high'
            );
        }
    }
}
add_action( 'add_meta_boxes', 'lessonlms_lesson_meta_box' );

if ( ! function_exists( 'lessonlms_lesson_meta_box_callback' ) ) {
    function lessonlms_lesson_meta_box_callback( $post ) {

        wp_nonce_field( 'lesson_meta_box', 'lesson_meta_box_nonce' );

        $user_id = get_current_user_id();

        // Fetch all enabled modules of the user
        $modules = get_posts( array(
            'post_type'      => 'course_modules',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'author'         => $user_id,
            'meta_query'     => array(
                array(
                    'key'     => 'module_status',
                    'value'   => 'enabled',
                    'compare' => '=',
                )
            ),
        ) );

        // Only get courses that have enabled modules
        $course_ids = array();
        if ( ! empty( $modules ) ) {
            foreach ( $modules as $module ) {
                if ( $module->post_parent ) {
                    $course_ids[] = $module->post_parent;
                }
            }
        }

        $course_ids = array_unique( $course_ids );

        // Fetch courses
        $courses = array();
        if ( ! empty( $course_ids ) ) {
            $courses = get_posts( array(
                'post_type'      => 'courses',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'post__in'       => $course_ids,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );
        }

        // Selected course/module
        $selected_course  = get_post_meta( $post->ID, '_selected_course', true );
        $selected_module  = get_post_meta( $post->ID, '_select_module', true );
        $video_duration   = get_post_meta( $post->ID, '_video_duration', true );
        $fee_lesson       = get_post_meta( $post->ID, '_free_lesson', true );
        $lesson_status    = get_post_meta( $post->ID, '_lesson_status', true );
        $video_url        = get_post_meta( $post->ID, '_video_url', true );

        // Fetch modules for the selected course
        $modules_for_course = array();
        if ( $selected_course ) {
            $modules_for_course = get_posts( array(
                'post_type'      => 'course_modules',
                'post_status'    => 'publish',
                'post_parent'    => $selected_course,
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'meta_query'     => array(
                    array(
                        'key'     => 'module_status',
                        'value'   => 'enabled',
                        'compare' => '=',
                    )
                ),
            ) );
        }
        ?>
<style>
.lesson-meta-box{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%;
    background-color: #f0f8ff;
    padding: 15px;
    border-radius: 10px;
    gap: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    font-family: 'Poppins', sans-serif;
}
.meta-box-left, .meta-box-right{
    padding: 15px;
    width: 50%;
}
.meta-box-left p, .meta-box-right p{
    margin-bottom: 20px;
}
.select, .input-data{
    width: 100%;
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
    transition: all 0.3s ease;
}
.select:hover, .input-data:hover{
    border-color: #00aaff;
    box-shadow: 0 0 5px rgba(0,170,255,0.2);
}

.label{
    font-size: 16px;
    font-weight: 600;
    color: #333;
    display: block;
    margin-bottom: 6px;
}

.required{
    color: red;
    margin-left: 5px;
    font-weight: bold;
}

/* Custom Checkbox Switch */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 26px;
  margin-left: 10px;
  vertical-align: middle;
}
.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
  border-radius: 34px;
}
.slider:before {
  position: absolute;
  content: "";
  height: 20px; width: 20px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}
input:checked + .slider {
  background-color: #00aaff;
}
input:checked + .slider:before {
  transform: translateX(24px);
}
input:focus + .slider {
  box-shadow: 0 0 1px #00aaff;
}
</style>

<div class="lesson-meta-box">
    <div class="meta-box-left">
        <!-- Course & Module & Video URL -->
        <p>
            <label class="label" for="select-course">
                <?php echo esc_html__( 'Select Course', 'lessonlms' ); ?>
                <span class="required">*</span>
            </label>
            <select class="select" name="_selected_course" id="select-course" required>
                <option value="">
                    --- 
                    <?php echo esc_html__( 'Select Course', 'lessonlms' ); ?> ---
                </option>
                <?php foreach( $courses as $course ) : ?>
                <option id="select-course-show-module" value="<?php echo esc_attr( $course->ID ); ?>" <?php selected( $selected_course, $course->ID ); ?>>
                    <?php echo esc_html( $course->post_title ); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label class="label" for="select-module">
                <?php echo esc_html__( 'Select Module', 'lessonlms' ); ?>
                <span class="required">*</span>
            </label>
            <select class="select" name="_select_module" id="select-module" required>
                <option value="">
                    ---
                    <?php echo esc_html__( 'Select Module', 'lessonlms' ); ?>
                    ---
                </option>
                <?php foreach( $modules_for_course as $module ) : ?>
                <option value="<?php echo esc_attr( $module->ID ); ?>" <?php echo selected( $selected_module, $module->ID ); ?>>
                    <?php echo esc_html( $module->post_title ); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label class="label" for="video-url">
                <?php echo esc_html__( 'Video URL', 'lessonlms' ); ?>
                <span class="required">*</span>
            </label>
            <input class="input-data" type="url" name="_video_url" id="video-url" placeholder="https://example.com/video.mp4" value="<?php echo esc_url( $video_url ); ?>" required>
        </p>
    </div>

    <div class="meta-box-right">
        <p>
            <label class="label" for="video_duration">
                <?php echo esc_html__( 'Video Duration', 'lessonlms' ); ?>
                <span class="required">*</span>
            </label>
            <input class="input-data" type="number" name="video_duration" id="video_duration" step="0.1" placeholder="Video duration" value="<?php echo esc_attr( $video_duration ); ?>" required>
        </p>

        <!-- Toggle Checkbox for Active Lesson -->
        <p>
            <label class="label" for="lesson-status">
                <?php echo esc_html__( 'Active Lesson', 'lessonlms' ); ?>
            </label>
            <label class="switch">
                <input type="checkbox" name="_lesson_status" id="lesson-status" value="1" <?php checked( $lesson_status, '1' ); ?>>
                <span class="slider"></span>
            </label>
        </p>

        <!-- Toggle Checkbox for Free Lesson -->
        <p>
            <label class="label" for="fee_lesson">
                <?php echo esc_html__( 'Free Lesson', 'lessonlms' ); ?>
            </label>
            <label class="switch">
                <input type="checkbox" name="_free_lesson" id="fee_lesson" value="1" <?php checked( $fee_lesson, '1' ); ?>>
                <span class="slider"></span>
            </label>
        </p>
    </div>
</div>
        <?php
    }
}

if ( ! function_exists( 'lessonlms_save_lesson_meta_box' ) ) {
    function lessonlms_save_lesson_meta_box( $post_id ) {

        if ( ! isset( $_POST['lesson_meta_box_nonce'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['lesson_meta_box_nonce'], 'lesson_meta_box' ) ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        if ( 'lessons' !== get_post_type( $post_id ) ) {
            return $post_id;

        }

         // Save Course
        if ( isset( $_POST['_selected_course'] ) ) {
            update_post_meta( $post_id, '_selected_course', intval( $_POST['_selected_course'] ) );
        }

        // Save Module
        if ( isset( $_POST['_select_module'] ) ) {
            update_post_meta( $post_id, '_select_module', intval( $_POST['_select_module'] ) );
        }

        // Save Video Duration
        if ( isset( $_POST['video_duration'] ) ) {
            update_post_meta( $post_id, '_video_duration', floatval( $_POST['video_duration'] ) );
        }

        // Save Lesson Status
        update_post_meta( $post_id, '_lesson_status', isset( $_POST['_lesson_status'] ) ? '1' : '0' );

        // Save Free Lesson
        update_post_meta( $post_id, '_free_lesson', isset( $_POST['_free_lesson'] ) ? '1' : '0' );

        // Save Video URL
        if ( isset( $_POST['_video_url'] ) ) {
            update_post_meta( $post_id, '_video_url', esc_url_raw( $_POST['_video_url'] ) );
        }
    }
}

add_action( 'save_post_lessons', 'lessonlms_save_lesson_meta_box' );

// Ajax handler to fetch modules by course
add_action( 'wp_ajax_lessonlms_get_modules', 'lessonlms_get_modules_by_course' );
add_action( 'wp_ajax_nopriv_lessonlms_get_modules', 'lessonlms_get_modules_by_course' );

function lessonlms_get_modules_by_course() {
    if ( ! isset($_POST['course_id']) ) wp_send_json_error();

    $course_id = intval( $_POST['course_id'] );
    $user_id = get_current_user_id();

    $modules = get_posts( array(
        'post_type'      => 'course_modules',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'post_parent'    => $course_id,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'author'         => $user_id,
        'meta_query'     => array(
            array(
                'key'     => 'module_status',
                'value'   => 'enabled',
                'compare' => '=',
            )
        ),
    ) );

    $module_options = '';
    foreach ( $modules as $module ) {
        $module_options .= '<option value="'. esc_attr( $module->ID ) .'">'. esc_html( $module->post_title ) .'</option>';
    }

    wp_send_json_success( $module_options );
}

?>

<script>
jQuery(document).ready(function($){
    $('#select-course').on('change', function(){
        var courseID = $(this).val();
        var moduleSelect = $('#select-module');

        if(courseID){
            moduleSelect.html('<option>Loading...</option>');

            $.ajax({
                url: '<?php echo admin_url("admin-ajax.php"); ?>',
                type: 'POST',
                data: {
                    action: 'lessonlms_get_modules',
                    course_id: courseID
                },
                success: function(response){
                    if(response.success){
                        moduleSelect.html('<option value="">--- Select Module ---</option>' + response.data);
                    } else {
                        moduleSelect.html('<option value="">No Modules Found</option>');
                    }
                },
                error: function(){
                    moduleSelect.html('<option value="">Error loading modules</option>');
                }
            });
        } else {
            moduleSelect.html('<option value="">--- Select Module ---</option>');
        }
    });
});
</script>