<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
    <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'twentynineteen' ); ?>">
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'menu-1',
                'container'      => false,
                'items_wrap'     => '<ul id="%1$s" class="nav flex-column nav-pills %2$s">%3$s</ul>',
                'link_before'    => '',
                'link_after'     => '',
                'depth'          => 1,
            )
        );
        ?>
    </nav><!-- #site-navigation -->
<?php endif; ?>