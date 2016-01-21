<?php $wl_theme_options = weblizar_get_options(); ?>
<?php get_header(); ?>
<!-- Slider ======================================= -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>        
        <li data-target="#myCarousel" data-slide-to="2"></li>        
      </ol>
      <div class="carousel-inner">		
        <div class="item active">
			<?php if($wl_theme_options['slide_image'] !='') { ?> 
			<img src="<?php echo esc_url($wl_theme_options['slide_image']); ?>" class="img-responsive" alt="First slide">	
			<?php } ?>
			<div class="container">
				<div class="carousel-caption">	
				<?php if($wl_theme_options['slide_title'] !='') { ?> <p><strong><?php echo  esc_attr($wl_theme_options['slide_title']); ?></strong></p>	<?php } ?>
				<?php if($wl_theme_options['slide_desc'] !='') { ?>
				<p><?php echo  esc_attr($wl_theme_options['slide_desc']); ?></p>
				<?php } ?>
				<?php if($wl_theme_options['slide_btn_text'] !='') { ?>
				<p><a class="btn btn-lg btn-primary" target="_blank" href="<?php if($wl_theme_options['slide_btn_link'] !='') { echo esc_url($wl_theme_options['slide_btn_link']); }  ?>" role="button"><?php echo esc_attr($wl_theme_options['slide_btn_text']); ?></a></p>
				<?php } ?>
				</div>
			</div>
        </div>
		 <div class="item">			
		  <?php if($wl_theme_options['slide_image_1'] !='') { ?><img src="<?php echo  esc_url($wl_theme_options['slide_image_1']); ?>" class="img-responsive" alt="Second slide"><?php } ?>
			<div class="container">
				<div class="carousel-caption">	
					<?php if($wl_theme_options['slide_title_1'] !='') { ?> <p><strong><?php echo  esc_attr($wl_theme_options['slide_title_1']); ?></strong></p>	<?php } ?>
					<?php if($wl_theme_options['slide_desc_1'] !='') { ?> <p><?php echo  esc_attr($wl_theme_options['slide_desc_1']); ?></p><?php } ?>
					<?php if($wl_theme_options['slide_btn_text_1'] !='') { ?>
					<p><a class="btn btn-lg btn-primary" target="_blank" href="<?php if($wl_theme_options['slide_btn_link_1'] !='') { echo esc_url($wl_theme_options['slide_btn_link_1']); }  ?>" role="button"><?php echo esc_attr($wl_theme_options['slide_btn_text_1']); ?></a></p>
					<?php } ?>
				</div>
			</div>
        </div>	
		<div class="item">			
			<?php if($wl_theme_options['slide_image_2'] !='') { ?><img src="<?php echo  esc_url($wl_theme_options['slide_image_2']); ?>" class="img-responsive" alt="Third slide"><?php } ?>
			<div class="container">
				<div class="carousel-caption">	
					<?php if($wl_theme_options['slide_title_2'] !='') { ?> <p><strong><?php echo  esc_attr($wl_theme_options['slide_title_2']); ?></strong></p><?php } ?>
					<?php if($wl_theme_options['slide_desc_2'] !='') { ?><p><?php echo esc_attr($wl_theme_options['slide_desc_2']); ?></p><?php } ?>
					<?php if($wl_theme_options['slide_btn_text_2'] !='') { ?>
					<p><a class="btn btn-lg btn-primary" target="_blank" href="<?php if($wl_theme_options['slide_btn_link_2'] !='') { echo esc_url($wl_theme_options['slide_btn_link_2']); }  ?>" role="button"><?php echo esc_attr($wl_theme_options['slide_btn_text_2']); ?></a></p>
					<?php } ?>
				</div>
			</div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
 </div><!-- /.carousel 
<div class="clearfix"></div>-->
<div class="container">
<div class="section1" id="about">
		<div class="container">
		<div class="one_fourth" style="background:none;"></div>
		<div class="one_half">
		<h1><?php if($wl_theme_options['home_service_title'] !='') { 	echo esc_attr($wl_theme_options['home_service_title']); } 
			if($wl_theme_options['home_service_description'] !='') {  ?>
			<h1><b><?php echo esc_attr($wl_theme_options['home_service_description']); ?></b></h1>
			<?php } ?>
		</h1>
		</div>
		<div class="one_fourth" style="background:none;"></div>
		</div>
		<div class="clearfix margin_top7"></div>		
		<div class="one_fourth">		
			<div class="circle animate" data-anim-type="zoomIn" data-anim-delay="400"><?php if($wl_theme_options['service_1_icons'] !='') { echo "<i class='".esc_attr($wl_theme_options['service_1_icons']). "'></i>";  }?></div>			
			<?php if($wl_theme_options['service_1_title'] !='') { ?><a href="<?php echo $wl_theme_options['service_1_link'];  ?>"><strong><?php echo esc_attr($wl_theme_options['service_1_title']);  ?></strong></a><?php } ?>
			<?php if($wl_theme_options['service_1_text'] !='') { echo "<p>".apply_filters('', $wl_theme_options['service_1_text'], true). "</p>"; } ?>
		</div>		
		<div class="one_fourth">		
			<div class="circle animate" data-anim-type="zoomIn" data-anim-delay="600"><?php if($wl_theme_options['service_2_icons'] !='') { echo "<i class='".esc_attr($wl_theme_options['service_2_icons']). "'></i>"; } ?></div>			
			<?php if($wl_theme_options['service_2_title'] !='') { ?><a href="<?php echo $wl_theme_options['service_2_link'];  ?>"><strong><?php echo esc_attr($wl_theme_options['service_2_title']);  ?></strong></a><?php } ?>
			<?php if($wl_theme_options['service_2_text'] !='') { echo "<p>".apply_filters('', $wl_theme_options['service_2_text'], true). "</p>";  }?>
		</div>		
		<div class="one_fourth">			
			<div class="circle animate" data-anim-type="zoomIn" data-anim-delay="800"><?php if($wl_theme_options['service_3_icons'] !='') { echo "<i class='".esc_attr($wl_theme_options['service_3_icons']). "'></i>"; } ?></div>			
			<?php if($wl_theme_options['service_3_title'] !='') { ?><a href="<?php echo $wl_theme_options['service_3_link'];  ?>"><strong><?php echo esc_attr($wl_theme_options['service_3_title']);  ?></strong></a><?php } ?>
			<?php if($wl_theme_options['service_3_text'] !='') { echo "<p>".apply_filters('', $wl_theme_options['service_3_text'], true). "</p>"; } ?>	
		</div>		
		<div class="one_fourth last ">		
			<div class="circle animate" data-anim-type="zoomIn" data-anim-delay="1000"><?php if($wl_theme_options['service_4_icons'] !='') { echo "<i class='".esc_attr($wl_theme_options['service_4_icons']). "'></i>"; } ?></div>			
			<?php if($wl_theme_options['service_4_title'] !='') { ?><a href="<?php echo $wl_theme_options['service_4_link'];  ?>"><strong><?php echo esc_attr($wl_theme_options['service_4_title']);  ?></strong></a><?php } ?>
			<?php if($wl_theme_options['service_4_text'] !='') { echo "<p>".apply_filters('', $wl_theme_options['service_4_text'], true). "</p>"; } ?>	
		</div>				
	
</div></div><!-- end of service section1 -->


<div class="clearfix"></div>

<div class="section1">	

<div class="container">	
	<div class="one_fourth"></div>
	<div class="one_half">
		<?php $wl_theme_options=weblizar_get_options();
		if($wl_theme_options['blog_title'] !='') { echo "<h1>".esc_attr($wl_theme_options['blog_title']). "</h1><br>"; } ?>
	</div>
	<div class="one_fourth"></div>
</div>	
<div class="container">	
	
	<?php if ( have_posts()) {
		$i=1;
		$args = array( 'post_type' => 'post','posts_per_page'=>3, 'post__not_in' => get_option( 'sticky_posts' ));		
		$post_type_data = new WP_Query( $args );
		while($post_type_data->have_posts()):
		$post_type_data->the_post(); 	 ?>		
		<div class="one_third animate" data-anim-type="fadeInUp" <?php if($i==3) { echo "id='nth_child_service'"; } ?>>    
			<h4 ><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>        
			<?php if(has_post_thumbnail()): 						
				$class=array('class'=>'enigma_img_responsive'); 
				the_post_thumbnail('home_post_thumb', $class); 
			endif; ?>      
			<p><?php echo substr(get_the_content(), 0, 150); ?></p><br /> 
			<a href="<?php the_permalink(); ?>" class="lfour"><i class="fa fa-chevron-circle-right"></i>&nbsp; <?php _e('Read More', 'teckzy'); ?></a>        
		</div>
		<?php  $i++; endwhile; 
			} else { ?>		
		<div class="one_third animate" data-anim-type="fadeInUp">    
			<h4 ><?php _e('The point of using psum is that has more normal letters ', 'teckzy'); ?></h4>        
			<img src="http://placehold.it/361x180" alt="" class="img_left1" />        
			<p><?php _e('Lorem Ipsum as their default model the and a search for lorem ipsum will uncover many web sites the stilin infancy versions have evolved over the years.', 'teckzy'); ?></p>
			<br />
			<a href="#" class="lfour"><i class="fa fa-chevron-circle-right"></i>&nbsp; <?php _e('Read More', 'teckzy'); ?></a>        
		</div>
		
		<div class="one_third animate" data-anim-type="fadeInUp">    
			<h4 class="white"><?php _e('Will cover many web sites still in their infancy websites', 'teckzy'); ?></h4>        
			<img src="http://placehold.it/361x180" alt="" class="img_left1" />        
			<p><?php _e('Lorem Ipsum as their default model the and a search for lorem ipsum will uncover many web sites the stilin infancy versions have evolved over the years.', 'teckzy'); ?></p>
			<br />
			<a href="#" class="lfour"><i class="fa fa-chevron-circle-right"></i>&nbsp; <?php _e('Read More', 'teckzy'); ?></a>
		</div>
		
		<div class="one_third last animate" data-anim-type="fadeInUp">		
			<h4 class="white"><?php _e('The point of using psum is that has more normal letters', 'teckzy'); ?></h4>			
			<img src="http://placehold.it/361x180" alt="" class="img_left1" />			
			<p><?php _e('Lorem Ipsum as their default model the and a search for lorem ipsum will uncover many web sites the stilin infancy versions have evolved over the years.', 'teckzy'); ?></p>
			<br />
			<a href="#" class="lfour"><i class="fa fa-chevron-circle-right"></i>&nbsp; <?php _e('Read More', 'teckzy'); ?></a>			
		</div>
		<?php } ?>
	</div>
</div><!-- end blog section5 -->
<div class="clearfix"></div>
<?php get_footer(); ?>