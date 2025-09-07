<?php 

global $dealsoffer_option;
if(!empty($dealsoffer_option['facebook']) || !empty($dealsoffer_option['twitter']) || !empty($dealsoffer_option['rss']) || !empty($dealsoffer_option['pinterest']) || !empty($dealsoffer_option['google']) || !empty($dealsoffer_option['instagram']) || !empty($dealsoffer_option['vimeo']) || !empty($dealsoffer_option['tumblr']) ||  !empty($dealsoffer_option['youtube'])){
?>

    <ul class="offcanvas_social">  
        <?php
        if(!empty($dealsoffer_option['facebook'])) { ?>
        <li> 
        <a href="<?php echo esc_url($dealsoffer_option['facebook'])?>" target="_blank"><span><i class="fa fa-facebook"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($dealsoffer_option['twitter'])) { ?>
        <li> 
        <a href="<?php echo esc_url($dealsoffer_option['twitter']);?> " target="_blank"><span><i class="fa fa-twitter"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($dealsoffer_option['rss'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($dealsoffer_option['rss']);?> " target="_blank"><span><i class="fa fa-rss"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($dealsoffer_option['pinterest'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($dealsoffer_option['pinterest']);?> " target="_blank"><span><i class="fa fa-pinterest-p"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($dealsoffer_option['linkedin'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($dealsoffer_option['linkedin']);?> " target="_blank"><span><i class="fa fa-linkedin"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($dealsoffer_option['google'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($dealsoffer_option['google']);?> " target="_blank"><span><i class="fa fa-google-plus-square"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($dealsoffer_option['instagram'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($dealsoffer_option['instagram']);?> " target="_blank"><span><i class="fa fa-instagram"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($dealsoffer_option['vimeo'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($dealsoffer_option['vimeo'])?> " target="_blank"><span><i class="fa fa-vimeo"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($dealsoffer_option['tumblr'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($dealsoffer_option['tumblr'])?> " target="_blank"><span><i class="fa fa-tumblr"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($dealsoffer_option['youtube'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($dealsoffer_option['youtube'])?> " target="_blank"><span><i class="fa fa-youtube"></i></span></a> 
        </li>
        <?php } ?>     
    </ul>
<?php }

