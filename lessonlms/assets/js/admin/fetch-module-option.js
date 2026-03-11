jQuery(document).ready(function($) {
    $("#select-course").on('change', function() {
        const course_id = $(this).val();
        const nonce = $(this).data('nonce');
        // console.log("Course ID:", course_id);
        // console.log("Nonce:", nonce);

        $.ajax( {
            url: ajaxurl,
            method: 'POST',
            data: {
                action: 'lessonlms_fetch_modules',
                select_nonce: nonce,
                course_id: course_id
            },
            beforeSend: function() {
                $('.show-module').html(`<div class="loading-module">
                    <p>Loading</p>
                    <span></span>
                    </div>`);
            },
            success: function( res ) {
                $('.show-module').html( res.data.html );
            },
            error: function( error ) {
                console.log("AJAX error:", error);
            }
        } );
    } );
} );