        </div><!-- .content -->
    </div><!-- .container -->
</div><!-- .main-container -->

<?php
global $dealsoffer_option;
?>
<footer>
    <?php
 get_template_part( 'inc/footer/footer','top' ); 
?>
</footer>
</div><!-- #page -->
<?php 
if(!empty($dealsoffer_option['show_top_bottom'])){
?>
 <!-- start top-to-bottom  -->
<div id="top-to-bottom">
    <i class="tp-angles-up"></i>
</div>   
<?php } ?>
 <?php wp_footer(); ?>
  </body>
</html>
