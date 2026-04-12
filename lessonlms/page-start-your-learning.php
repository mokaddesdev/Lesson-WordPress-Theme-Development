<?php
/**
 * Template Name: Start Your Learning Page
 * 
 * @package lessonlms
 */

get_header();
get_template_part( "template-parts/student-dashboard/student", "breadcrumb" );
get_template_part( "template-parts/start-learning/start-learning-section" );

get_footer();
?>