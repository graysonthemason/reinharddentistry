<?php $wl_theme_options = weblizar_get_options(); ?>
<?php get_header();
if ($wl_theme_options['_frontpage']=="on" && is_front_page())
{ ?>
<!-- Slider ======================================= -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
<!--        <li data-target="#myCarousel" data-slide-to="2"></li>        -->
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
				<p><a class="btn btn-lg btn-primary" target="_blank" href="<?php if($wl_theme_options['slide_btn_link'] !='') { echo esc_url($wl_theme_options['slide_btn_link']); }  ?>" role="button">Read More</a></p>
				</div>
			</div>
        </div>
		<div class="item ">
			<?php if($wl_theme_options['slide_image_1'] !='') { ?>
			<img src="<?php echo esc_url($wl_theme_options['slide_image_1']); ?>" class="img-responsive" alt="Second slide">
			<?php } ?>
			<div class="container">
				<div class="carousel-caption">
				<?php if($wl_theme_options['slide_title_1'] !='') { ?> <p><strong><?php echo  esc_attr($wl_theme_options['slide_title_1']); ?></strong></p>	<?php } ?>
				<?php if($wl_theme_options['slide_desc_1'] !='') { ?>
				<p><?php echo  esc_attr($wl_theme_options['slide_desc_1']); ?></p>
				<?php } ?>
				<p><a class="btn btn-lg btn-primary" target="_blank" href="<?php if($wl_theme_options['slide_btn_link_1'] !='') { echo esc_url($wl_theme_options['slide_btn_link_1']); }  ?>" role="button">Read More</a></p>
				</div>
			</div>
        </div>
        <div class="item ">

			<img src="http://www.reinharddentistry.com/wp-content/uploads/2015/10/top-dentist-banner.jpg" class="img-responsive" alt="Second slide">

			<div class="container">
			</div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
 </div><!-- /.carousel -->
<div class="zocdoc">
    <a style='display:block;' href='http://www.zocdoc.com/practice/reinhard-dentistry-46762' id='zocdoc_schedule'>
        Reinhard Dentistry
    </a>
    <a style='display:block; position:relative; left:36px;' href='http://www.zocdoc.com' title='Powered by ZocDoc Doctor Directory'>
        <img src='http://offsiteSchedule.zocdoc.com/images/remote/powered-by-light.png' height='15' width='92' alt='Powered by ZocDoc Doctor Directory' />
    </a>
    <script type='text/javascript' src='http://offsiteSchedule.zocdoc.com/remote/Schedule2.js.aspx?providerid=46762&prefix=zocdoc_&bookBtn=http://offsiteSchedule.zocdoc.com/images/remote/book-on-light-small.png&locationId='>
    </script>
</div>

<div class="feature_section1">
	<div class="container" style="width: 100%">
		<div class="front-page-about section-div">
			<h3 class="section-title">About</h3>
			<img alt="headshot" width="50%" height="auto" src="/wp-content/themes/guardian/images/headshot_tom-richard.jpg" style="float: left; margin-right: 15px;">
			<p>&nbsp &nbsp &nbsp Reinhard Dentistry has been treating patients continuously since 1918, providing care in Whippany, NJ since 1948. The relaxed atmosphere and the time the doctors take to explain procedural options are just a few of the attributes patients attest to. The practice is conveniently located close to Routes 287, 10 and 80, and the office prides itself on seeing patients at the time of their appointment. The staff will submit all insurance claims for its patients.</p>
			<p>&nbsp &nbsp &nbsp Dr. Thomas Reinhard received his DMD from the University of Pennsylvania School of Dental Medicine in 1981.  He is proud to welcome to the practice his son, Dr. Richard Reinhard , who received his DMD with distinction from Tufts University School of Dental Medicine in 2015.</p>
		</div>
		<div class="front-page-reviews section-div">
				<h3 class="section-title">Reviews</h3>
			<a class="review" href="https://plus.google.com/114301656603886368046/about?review=1" target="_blank">Already a patient? Click here to leave a review!</a>
		<?php echo (do_shortcode('[google-places-reviews  max_width="zx100%" hide_google_image="true" align="right" id="ChIJ1-WNqMynw4kRkxrqLfuOI9I"]'));?>
		</div>
		<a name="contact">
		</a>
		<div class="front-page-contact section-div"
			<A NAME="top"></A>
			<h3 class="section-title">Contact</h3>
			<?php echo (do_shortcode('[think_contact/]'));?>
		</div>
		<div class="front-page-directions section-div">
			<h3 class="section-title">Directions</h3>
			<?php echo (do_shortcode('[MKGD]'));?>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<?php get_footer(); ?>
<?php }
else
{
	if(get_page_template_slug( get_the_ID() )) {
		$temp_name= get_page_template_slug( get_the_ID() );
		$temp_name =str_replace('.php', '', $temp_name);
		get_template_part( $temp_name );
	} else	{
		get_template_part( 'page' );
	}
}	?>