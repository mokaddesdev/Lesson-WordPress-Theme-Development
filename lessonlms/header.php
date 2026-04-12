<!DOCTYPE html>
<html <?php language_attributes(); ?> style="scroll-behavior: smooth;">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>
    </title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="preloader"></div>

<header>
    <div class="container">
        <div class="header-wrapper">

            <!-- Logo -->
            <div class="logo">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img src="<?php echo esc_url( THEME_URI . '/assets/images/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                        >
                    </a>
                <?php endif; ?>
            </div>

            <!-- Menu + Buttons -->
            <div class="menu-button-wrapper">

                <nav class="main-menu">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'header_menu',
                        'container'      => false,
                    ) );
                    ?>
                </nav>

                <!-- Cart + Profile -->
                <div class="shop-cart-profile">

                    <!-- Cart -->
                    <div class="shop-cart-btn">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </div>

                    <?php
                    $is_login = is_user_logged_in();
                    if ( $is_login ) :
                    ?>
                        <div class="profile-info">
                            <button class="profile-btn" aria-label="User Menu">
                                <i class="fa-regular fa-circle-user"></i>
                            </button>

                            <ul class="profile-cart">
                                <li>
                                    <a href="<?php echo esc_url( home_url( '/student-dashboard' ) ); ?>">
                                        <span class="dashboard-icon">
                                            <i class="fa-solid fa-gauge"></i>
                                        </span>
                                        <?php echo esc_html__( 'Dashboard', 'lessonlms' ); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">
                                        <span class="logout-icon">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        </span>
                                        <?php echo esc_html__( 'Logout', 'lessonlms' ); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    <?php else : ?>

                        <div class="button btn-black">
                            <a href="<?php echo esc_url( wp_registration_url() ); ?>">
                                <?php echo esc_html__( 'Sign Up', 'lessonlms' ); ?>
                            </a>
                        </div>

                    <?php endif; ?>

                </div>

                <!-- Mobile Menu Button -->
                <div class="menu-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>

            </div>

            <!-- Mobile Menu -->
            <div id="navPhone" class="menu-item-phone">

                <div class="logo-div">
                    <div class="logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img 
                                src="<?php echo esc_url( THEME_URI . '/assets/images/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                            >
                        </a>
                    </div>

                    <div class="x-icon menu-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18" stroke-linecap="round" />
                            <line x1="6" y1="6" x2="18" y2="18" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>

                <div class="menu-div">
                    <nav class="main-menu-phone">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'mobile_menu',
                            'container'      => false,
                        ) );
                        ?>
                    </nav>

                    <?php if ( ! $is_login ) : ?>
                        <div class="button btn-black">
                            <a href="<?php echo esc_url( wp_registration_url() ); ?>">
                                <?php echo esc_html__( 'Sign Up', 'lessonlms' ); ?>
                            </a>
                        </div>
                        <?php else : ?>
                             <div class="profile-info">
                            <button class="profile-btn" aria-label="User Menu">
                                <i class="fa-regular fa-circle-user"></i>
                            </button>

                            <ul class="profile-cart">
                                <li>
                                    <a href="<?php echo esc_url( home_url( '/student-dashboard' ) ); ?>">
                                        <span class="dashboard-icon">
                                            <i class="fa-solid fa-gauge"></i>
                                        </span>
                                        <?php echo esc_html__( 'Dashboard', 'lessonlms' ); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">
                                        <span class="logout-icon">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        </span>
                                        <?php echo esc_html__( 'Logout', 'lessonlms' ); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>

                </div>

            </div>

        </div>
    </div>
</header>

<!-- Scroll Top -->
<button class="scroll-top-btn" aria-label="Scroll to top">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
    </svg>
</button>