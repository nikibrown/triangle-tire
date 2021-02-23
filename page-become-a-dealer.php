<?php
/**
 * page-become-a-dealer.php
 *
 * @version 1.0
 * @date 6/10/17 9:16 PM
 * @package triangle
 */
get_header();
?>

	<div class="interiorbanner expanded row">
		<div class="large-12">
			<img src="<?php bloginfo( 'template_url' ); ?>/images/become-a-dealer-header.jpg" >
		</div>
	</div>
	<div class="row">
		<div class="medium-12 columns">
			<h1>Become a Dealer</h1>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns divider"><hr></div>
	</div>
	<div class="row">
		<div class="medium-8 large-9 columns">

			<p>We can’t wait to share our story with you, <span class="bolder"><i>and</i></span> to show you the difference a Triangle Tire relationship can make in your day-to-day operations.</p>
			<h3>Call Us</h3>
			<p>Angela Wyatt - <span class="bolder extraletterspacing">1.888.847.3745</span>&nbsp;or&nbsp;&nbsp;<span class="bolder extraletterspacing">1.615.610.5050</span></p>
			<hr class="basic">
			<h3>Email Us</h3>
			<form class="js-submit-dealer" method="post">

				<div class="js-notifications alert-box hidden"></div>
				<input type="hidden" name="action" value="contact_form" />

				<div class="row">
					<div class="medium-12 columns">
						<input type="text" placeholder="Business Name" name="business_name">
					</div>
					<div class="medium-12 columns">
						<input type="text" placeholder="Type of Business" name="business_type">
					</div>
					<div class="medium-12 columns">
						<input type="text" placeholder="Name" name="name">
					</div>
					<div class="medium-12 columns">
						<input type="text" placeholder="City" name="city">
					</div>
					<div class="medium-12 columns">
						<input type="text" placeholder="State" name="state">
					</div>
					<div class="medium-12 columns">
						<input type="text" placeholder="Zipcode" name="zipcode">
					</div>
					<div class="medium-12 columns">
						<input type="email" placeholder="Email" name="email">
					</div>
					<div class="medium-12 columns">
						<input type="text" placeholder="Phone" name="phone">
					</div>
					<div class="medium-12 columns">
						<fieldset>
							<legend>What Products are you interested in carrying?</legend>
							<input type="radio" name="product_interest" value="Red" id="pokemonRed" required><label for="pokemonRed">Passenger &amp; Light Truck</label>
							<input type="radio" name="product_interest" value="Blue" id="pokemonBlue"><label for="pokemonBlue">Truck &amp; Bus</label>
							<input type="radio" name="product_interest" value="Yellow" id="pokemonYellow"><label for="pokemonYellow">Off-the-Road</label>
						</fieldset>
					</div>
					<div class="medium-12 columns">
						<input type="submit" class="button" value="Submit">
					</div>
				</div>
			</form>
		</div>
		<div class="medium-4 large-3 columns">
			<div class="sidebar">
				<p><span class="bolder">Triangle Tire USA</span><br>
					117 Seaboard Lane<br>
					Suite F100<br>
					Franklin, TN 37067
			</div>
		</div>
	</div>

<?php
get_footer();
