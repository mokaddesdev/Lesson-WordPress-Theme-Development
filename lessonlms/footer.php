<?php
/**
 * Footer Template
*
* @package lessonlms
*/

$footer_text        = get_theme_mod( 'footer_about_text', 'Need to help for your dream Career? trust us. With Lesson, study becomes a lot easier with us.' );
$footer_logo        = get_theme_mod( 'footer_logo', THEME_URI .'/assets/images/footer-logo.png');

$twitter_link       = get_theme_mod( 'footer_twitter_link' );
$facebook_link      = get_theme_mod( 'footer_facebook_link' );
$linkedin_link      = get_theme_mod( 'footer_linkedin_link' );
$instagram_link     = get_theme_mod( 'footer_instagram_link' );

$footer_menu1_title = get_theme_mod( 'footer_menu1_title','Company' );
$footer_menu2_title = get_theme_mod( 'footer_menu2_title','Services' );
$footer_address     = get_theme_mod( 'footer_address', 'Address' );
$footer_loca_title  = get_theme_mod( 'footer_location_title', 'Location:' );
$footer_loca_des    = get_theme_mod( 'footer_location_description', '27 Division St, New York, NY 10002, USA' );

$footer_email_title = get_theme_mod( 'footer_email_title', 'Email:' );
$footer_email       = get_theme_mod( 'footer_email', 'email@gmail.com' );
$footer_phone_title = get_theme_mod( 'footer_phone_title','Phone:' );
$footer_phone_des   = get_theme_mod( 'footer_phone_description', '+ 000 1234 567 890' );
$footer_map_link    = get_theme_mod( 'footer_map_link' );
?>

<footer>
    <div class="container">
        <div class="footer-wrapper">
            <!----- about company ----->
            <div class="about-company">
                <div class="f-logo">
                    <?php if ( ! empty( $footer_logo ) ) : ?>
                    <img src="<?php echo esc_url( $footer_logo ); ?>"
                        alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    <?php endif;?>
                </div>
                <!-- #region-->
                <?php if ( ! empty( $footer_text ) ) : ?>
                <p> <?php echo esc_html( $footer_text ); ?> </p>
                <?php endif; ?>

                <div class="social-links">

                    <!----- twitter ----->
                    <a href="<?php echo esc_url( $twitter_link ); ?>" aria-label="Twitter"></a>

                    <!----- facebook ----->
                   <a href="<?php echo esc_url( $facebook_link ); ?>" aria-label="Facebook"></a>

                    <!----- linkdine ----->
                    <a href="<?php echo esc_url( $linkedin_link ); ?>" aria-label="LinkedIn"></a>

                    <!----- instagram ----->
                    <a href="<?php echo esc_url( $instagram_link ); ?>" aria-label="Instagram"></a>

                </div>
            </div>

            <!----- company links ----->
            <div class="footer-nav company">
                <?php if ( ! empty( $footer_menu1_title ) ) : ?>
                <h3>
                    <?php echo esc_html( $footer_menu1_title ); ?>
                </h3>
                <?php endif; ?>
                <hr>
                <?php
                    wp_nav_menu( array(
                        "theme_location" => "footer_menu1",
                        'container'      => false,
                        'fallback_cb'    => false,
                        ) ); 
                ?>
            </div>

            <div class="footer-nav support">
                <?php if ( ! empty( $footer_menu2_title ) ) : ?>
                <h3>
                    <?php echo esc_html( $footer_menu2_title ); ?>
                </h3>
                <?php endif; ?>
                <hr>
                <?php
                    wp_nav_menu( array(
                        "theme_location"  => "footer_menu2",
                        'container'       => false,
                        'fallback_cb'     => false,
                        ) );
                ?>
            </div>
            <div class="footer-nav address">
                <?php if ( ! empty( $footer_address ) ) : ?>
                <h3>
                    <?php echo esc_html( $footer_address ); ?>
                </h3>
                <?php endif; ?>
                <hr>
                <!----- location ----->
                <div class="address-details location">
                    <a href="<?php echo esc_url( $footer_map_link ); ?>">
                        <span>
                            <?php if ( ! empty( $footer_loca_title) ) : ?>
                            <strong>
                                <?php echo esc_html( $footer_loca_title );?>
                            </strong>
                            <?php endif; ?>
                            <?php if( ! empty( $footer_loca_des ) ) : ?>
                            <?php echo esc_html( $footer_loca_des ); ?>
                            <?php endif; ?>
                        </span>
                    </a>
                </div>

                <!----- email ----->
                <div class="address-details email">
                    <a href="mailto:<?php echo esc_attr( $footer_email ); ?>">
                        <span>
                            <?php if ( ! empty( $footer_email_title ) ) : ?>
                            <strong>
                                <?php echo esc_html( $footer_email_title ); ?>
                            </strong>
                            <?php endif; ?>
                            <?php if ( ! empty( $footer_email ) ) : ?>
                            <?php echo esc_html( $footer_email ); ?>
                            <?php endif; ?>
                        </span>
                    </a>
                </div>

                <!----- contact number ----->
                <div class="address-details phone">
                    <a href="tel:<?php echo esc_attr( $footer_phone_des ); ?>">
                        <span>
                            <?php if ( ! empty( $footer_phone_title ) ) : ?>
                            <strong>
                                <?php echo esc_html( $footer_phone_title );?>
                            </strong>
                            <?php endif; ?>
                            <?php if ( ! empty( $footer_phone_des ) ) : ?>
                            <?php echo esc_html( $footer_phone_des ); ?>
                            <?php endif; ?>
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="copyright-area">
            <p>
                <?php echo esc_html__( 'Copyright', 'lessonlms' ); ?>
                &copy;
                <?php echo esc_html( wp_date( 'Y' ) ); ?>
                <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                <?php echo esc_html__( 'All rights reserved', 'lessonlms' ); ?>
            </p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>