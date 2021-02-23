<?php
/**
 * The template for displaying the footer.
 *
 * 
 * @package WordPress
 * @subpackage wpcustom
*/
?>
		<div id="footer" class="expanded row no-print">
			<div class="large-12">
				<div class="row footertop" data-equalizer>
					<div class="small-6 medium-6 large-3 columns" data-equalizer-watch>
						<h4>Products</h4>
						<?php
						wp_nav_menu( 
								  array(
								  'menu' => 'Products',
								  'depth' => 2,
								  'container' => false,
								  'menu_class' => 'menu vertical',
								  'walker' => new wp_bootstrap_navwalker()
							 )
						);
						?>
						<!--<ul class="menu vertical">
							<li><a href="<?php bloginfo( 'home' ); ?>//passenger-tires">Passenger Tires</a></li>
							<li><a href="<?php bloginfo( 'home' ); ?>//truck-tires">Truck &amp; Bus Tires</a></li>
							<li><a href="<?php bloginfo( 'home' ); ?>/offroad-tires">Off-The-Road Tires</a></li>
						</ul>-->
					</div>
					<div class="small-6 medium-6 large-3 columns" data-equalizer-watch>
						<h4>About Triangle</h4>
						<?php
						wp_nav_menu( 
								  array(
								  'menu' => 'About Triangle',
								  'depth' => 2,
								  'container' => false,
								  'menu_class' => 'menu vertical',
								  'walker' => new wp_bootstrap_navwalker()
							 )
						);
						?>
						<!--<ul class="menu vertical">
							<li><a href="<?php bloginfo( 'home' ); ?>/about">The Company</a></li>
							<li><a href="<?php bloginfo( 'home' ); ?>/support-center">Support Center</a></li>
							<li><a href="<?php bloginfo( 'home' ); ?>/privacy-policy">Privacy Policy</a></li>
				  <li><a href="<?php bloginfo( 'home' ); ?>/news">News</a></li>
						</ul>-->
					</div>
					<div class="small-6 medium-6 large-3 columns" data-equalizer-watch>
						<h4>Contact Us</h4>
						<?php
						wp_nav_menu( 
								  array(
								  'menu' => 'Contact Us',
								  'depth' => 2,
								  'container' => false,
								  'menu_class' => 'menu vertical',
								  'walker' => new wp_bootstrap_navwalker()
							 )
						);
						?>
						<!--<ul class="menu vertical">
							<li><a href="<?php bloginfo( 'home' ); ?>/become-a-dealer">Become A Dealer</a></li>
							<li><a href="<?php bloginfo( 'home' ); ?>/contact">Contact Us</a></li>
							<li><a href="<?php bloginfo( 'home' ); ?>/tire-registration">Tire Registration</a></li>
							<li><a href="<?php bloginfo( 'home' ); ?>/join-our-mailing-list">Join Our Mailing List</a></li>
						</ul>-->
					</div>
					<div class="small-6 medium-6 large-3 columns" data-equalizer-watch>
						<h4>Support Center</h4>
						<?php
						wp_nav_menu( 
								  array(
								  'menu' => 'Support Center',
								  'depth' => 2,
								  'container' => false,
								  'menu_class' => 'menu vertical',
								  'walker' => new wp_bootstrap_navwalker()
							 )
						);
						?>
						<!--<ul class="menu vertical">
							<li><a href="<?php bloginfo( 'home' ); ?>/support-center">Brochures</a></li>
							<li><a href="<?php bloginfo( 'home' ); ?>/videos">Videos</a></li>
							<li><a href="<?php bloginfo( 'home' ); ?>/warranties">Warranties</a></li>
						</ul>-->
					</div>
				</div>
				<div class="row footerbottom">
					<div class="small-12 medium-12 large-6 columns">
						<p class="copyright">&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?></p>     
					</div>
					<div class="small-12 medium-12 large-6 columns footerlogo">
						<img src="<?php bloginfo( 'template_url' ); ?>/images/Triangle_logo_tag-WHT.png">
					</div>
				</div>
		  </div>
		</div>
		<section class="semantic-content reveal" id="modal-inputs" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true" data-reveal>
			<div class="modal-inner">
				<div class="modal-content">
					<a class="close-button" data-close aria-label="Close modal" type="button">
  						<span aria-hidden="true">&times;</span>
					</a>
					<form class="form-inline js-printitems" action="<?php bloginfo('url'); ?>/print-results/" method="get">
						<input type="hidden" name="action" value="print_form" />
						<h4>Fill out the form below to customize your printed page.</h4>
						<h6>Fields not required, if you do not wish to enter any information, just click the print button below</h6>
						<label>Business Name</label>
						<input class="form-control" type="text" name="business[name]" value="" onfocus="" />
						<label>Address</label>
						<input class="form-control" type="text" name="business[address]" value="" onfocus="" />
						<label>City</label>
						<input class="form-control" type="text" name="business[city]" value="" onfocus="" />
						<label>State</label>
						<input class="form-control" type="text" name="business[state]" value="" onfocus="" />
						<label>Zip</label>
						<input class="form-control" type="text" name="business[zip]" value="" onfocus="" />
						<label>Phone</label>
						<input class="form-control" type="text" name="business[phone]" value="" onfocus="" />
						<label>Website</label>
						<input class="form-control" type="text" name="business[email]" value="" onfocus="" />
						<?php
						global $ids;
						if( isset( $ids ) && !empty( $ids ) )
						{
							foreach( $ids as $i )
							{
								echo '<input type="hidden" name="selection[]" value="'. $i .'" />';
							}
						}
						?>
						<input type="submit" class="btn btn-default" value="Print" />
					</form>
				</div>
			</div>
		</section>
		<script src="<?php bloginfo( 'template_url' ); ?>/js/vendor/jquery.js"></script>
		<script src="<?php bloginfo( 'template_url' ); ?>/js/vendor/what-input.js"></script>
		<script src="<?php bloginfo( 'template_url' ); ?>/js/vendor/foundation.js"></script>
		<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.print.js"></script>
		<script src="<?php bloginfo( 'template_url' ); ?>/js/sss.js"></script>
		<script src="<?php bloginfo( 'template_url' ); ?>/js/app.js"></script>
		<?php wp_footer(); ?>
		<script>
			$(document).ready(function() {
			$(document).foundation();
			});
		</script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-102570520-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-102570520-1');
		</script>
	
<script type="text/javascript"> _linkedin_partner_id = "488065"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(){var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://dc.ads.linkedin.com/collect/?pid=488065&fmt=gif" /> </noscript>

	</body>
</html>
