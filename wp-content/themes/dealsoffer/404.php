<?php
wp_head();
global $dealsoffer_option;?>
<div class="page-error">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="container">
                <section class="error-404 not-found">
                    <div class="page-content">
                        <?php if (!empty($dealsoffer_option['404_bg']['url'])) {?>
                            <img class="error-image"  src="<?php echo esc_url($dealsoffer_option['404_bg']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                        <?php }
                        else{ ?>
                            <h2>
                            <span>
                                <?php
                                    if (!empty($dealsoffer_option['title_404'])) {
                                        echo esc_html($dealsoffer_option['title_404']);
                                    } else {  
                                        echo esc_html__('404', 'dealsoffer');
                                    }
                                ?>
                            </span>                           
                        </h2>                 
                       <?php } 
                        ?>

                        <h2 class="opps-nothing">
                            
                            <?php
                                if (!empty($dealsoffer_option['text_404'])) {
                                    echo esc_html($dealsoffer_option['text_404']);
                                } else {
                                    echo esc_html__('Oops! Nothing Was Found', 'dealsoffer');
                                }
                            ?>
                        </h2>            
                        <p class="error-msg">
                            <?php echo esc_html__("Sorry, we couldn't find the page you where looking for. We suggest that you return to homepage.", 'dealsoffer'); ?>
                        </p>
                        <a class="tp-error-button cmn--btn" href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                                if (!empty($dealsoffer_option['back_home'])) {
                                    // echo esc_html($dealsoffer_option['back_home']);
                                    echo '<span> '. esc_html($dealsoffer_option['back_home']) .' </span>';
                                } else {
                                    esc_html_e('Or back to homepage', 'dealsoffer');
                                }
                            ?>
                        </a>
                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
</div> <!-- .page-error -->
<?php
wp_footer();
