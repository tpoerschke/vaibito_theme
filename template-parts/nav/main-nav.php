<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
    <nav id="site-navigation" class="main-navigation navbar navbar-expand-lg navbar-light" aria-label="<?php esc_attr_e( 'Top Menu', 'twentynineteen' ); ?>">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggle">
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
        </div>
    </nav><!-- #site-navigation -->
<?php endif; ?>