<div class="clearfix"></div>
<div class="footer1">
	<div class="container">			
		<div class="clearfix divider_dashed1"></div>
		<?php
		if ( is_active_sidebar( 'footer-widget-area' ) )
		{ 
			dynamic_sidebar( 'footer-widget-area' );
		} else 
		{  ?>
		<div class="one_third animate" data-anim-type="fadeInUp">
			<div class="siteinfo">
				<h4 class="lmb"><?php _e('Site Info?',gr_td); ?></h4>
				<p><?php _e('Something We\'d like to say here?',gr_td); ?></p>
				<br />							
			</div>
		</div><!-- end site info -->	
		<div class="one_third animate" data-anim-type="fadeInUp">
			<div class="qlinks">		
				<h4 class="lmb"><?php _e('Other Info',gr_td); ?></h4>
				<ul>
					<li><a href="#"><?php _e('Home',gr_td); ?></a></li>
					<li><a href="#"><?php _e('Service',gr_td); ?></a></li>
					<li><a href="#"><?php _e('About-us',gr_td); ?></a></li>
					<li><a href="#"><?php _e('Contact -Us',gr_td); ?></a></li>
				</ul>			
			</div>
		</div><!-- end links -->
		
		<div class="one_third last animate" data-anim-type="fadeInUp">
			<div class="qlinks">		
				<h4 class="lmb"><?php _e('Third Column',gr_td); ?></h4>
				<ul>
					<li><a href="#"><?php _e('Awsome Slidershows',gr_td); ?></a></li>
				</ul>			
			</div>
		</div><!-- end links 	-->	
		
		<?php } ?>		
	</div>
</div><!-- end footer -->

<div class="clearfix"></div>
<div class="copyright_info">
		<div class="container">
			<ul class="footer-list">
				<li><a href="https://maps.google.com?daddr=130+whippany+Road+Whippany+NJ+07981" target="_blank"><i class="fa fa-map-marker"></i>130 Whippany Rd. Whippany, NJ</a></li>
				<li class="span-hide">&nbsp&nbsp|&nbsp&nbsp</li>
				<li><a href="mailto:info@reinharddentistry.com"><i class="fa fa-envelope"></i> info@reinharddentistry.com</a></li>
				<li class="span-hide">&nbsp&nbsp|&nbsp&nbsp</li>
				<li><i class="fa fa-phone"></i><a href="tel:+19738872436"> + 1 973 887 2436</a></li>
			</ul>
			<div class="clearfix divider_dashed10"></div>

				<p style="text-align:center;font-size: 12px;">Reinhard Dentistry &copy;<?php echo date("Y");?></p>
		</div>
	</div><!-- end copyright info -->
	<a href="#" class="scrollup"><?php _e('Scroll','weblizar');?></a><!-- end scroll to top of the page-->	
</div> <!-- end of header wrapper div -->
<?php wp_footer(); ?>	
	<?php if(isset($wl_theme_options['custom_css'])) { ?> 
	<style type="text/css"><?php echo esc_attr($wl_theme_options['custom_css']); ?></style>
	<?php } ?>
</body>
</html>