<?php

add_action('admin_notices', 'contact_form_7_modules_promo_message');

function contact_form_7_modules_promo_message() {
	global $pagenow;

	if(!current_user_can('install_plugins')) { return; }

	$message = (int)get_option('cf7_modules_hide_promo_message');

	if(isset($_REQUEST['hide']) && $_REQUEST['hide'] == 'cf7_modules_promo_message') {
		$message = 3;
		update_option('cf7_modules_hide_promo_message', $message);
	}

	if($pagenow == 'admin.php' && isset($_REQUEST['page']) && $_REQUEST['page'] == 'wpcf7' && ($message !== 3 || isset($_REQUEST['show']) && $_REQUEST['show'] == 'cf7_modules_promo_message')) {
		echo contact_form_7_modules_get_message();
	}
}

/**
 * Display cross-promo for Contact Form 7 Newsletter plugin
 * @since 2.0.1
 * @return mixed|string
 */
function contact_form_7_modules_get_message() {

	$message = <<<EOL
<div class="updated" style="font-size:1.2em">
	<a href="{{hide_link}}" class="button alignright" style="font-style:normal; margin:.75em 0 .75em .75em;">{{hide_text}}</a>
	<h2>{{want_to}}</h2>
	<a href="{{ctct_url}}"><img alt="Constant Contact" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAARkAAAApCAMAAAA2w608AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAwBQTFRFtsbaGEV8JlOM+89tUXanma7KJk98mq3FiKLDqLnOi6G5GUaA7Lhp+slcUXSgRGaN/ee2/NqOUnOZboyxhqDC/eCh/NR8fZax+9F12+LsGENyUnSd+Mtxt8TWJlOR8LhYQ2qe66AhNF6VQ2eR+spg7Lx3i6LAiqLEHURyg57AvcvdYICpNVyNi6PC8qod9a4b8agd/vTe7KMf5psjb4qpJlGFk6rI+LEa/u7M/eKp/eq+NF+Y/NyV+8xn97Aa/d+dboy0tsXYxdDc6Z4hqLjK5Jkk99us7bVZ/vDTbouuNF2R+cVT1Nzm1d7qUXWk+9Bx1Nzkt8TUYH+ljqG5t8TSYH6eK1B8+sZVNVuFYIGvdZK4YH6g/evD+ujHqLrRpbnRYIGsma7I4ZUlmqzC/evGcIyui6K++LUocYupJlCAnrPN/eStHEV1+Nec6qxN+taN+9aDssPY9sBVfZe5Q2iWGUeE/vLZ/e3JKFKF/ei6/N2bNVuJxtDdx9Db9M+QnK3BjqG3Q2mZF0iIF0eHF0eGF0eFGEN1F0aDF0aBGER5F0V/GEN2GER6F0eEGER4qLrT093pF0V+i6PExdHibo22xdHhF0eIF0aCF0aAUnGVGER3GEV7fZi9ma/MxdHg76YeQ2qggJu/9KwcG0V4GkZ+iqTEUnKWF0Z/09zoqLrSG0V6fZi8fZm9xdDexdHf55wii6K9G0Z709znfZi7GkZ8eZW7/d2Y/NeFe5i8+shZ+sdY7aMf8KcefZe3xdDf+9iMi6G8+bw2qLnQtsXaws/ggZatxNHh/u/Q/NWAqLvT6bBc+stj/NR+8MqS+OXIxtLitMTZw9Dh9+C6VnOU1Nvk8a0rwc7fsMHWb4mnUXWmGEiH+9ub9+TJ/O7Vr8HW/vXgj6fG/N6b4OfvuMTSjKPAxtHe+cBEOVuDOFyJcIyw78B2/ezF9tGPfZWv7agu8c+gVnKT5aJA5qdP561cmq/L+uvW+uzW/NiKUnWj/OOs67Jb+MJUF0iJF0iK///gFBQU3oCw6gAAAQB0Uk5T////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////AFP3ByUAAAqDSURBVHja7JoJdJTVFcc/w4QYtAFZGiRkGpOQImSKVALKQCUQRGAMBQwQERo2CwguLIqioiQggjLTWdrGZmKkhCakoRRbCrUsiooL3fe92t2W7gu25B/fvfd73zKZnIRU23PSvHMc37zv3ve/7/fuu28yg9Ha06wGaovWPvjGv175K4weHjaUHw5dd9WTz1wx5eqpS4f1kDGxBLb86YVrR+15nyaD1h4yCkv2ynlrhs/Dh20yw3rItKJ4xab9n1wzfPhDJz5gk0Hr/z0Z/OKSvZ8jMiplbDJv9JBpxUaTzNwT42wy/2hLBv+L4N6526Zjo3OaDJ61yUwjR8N9b4U6Nd/be1dG3hFNBD2e8o6mRWybSWblteM0mfdM+4aTDBD3eFuo1dXgv8YlWO4XzejbrYlIeZ2nxtPBtMjVZO4/c+K+5ctpjy5/XfbJMGOMttjtQtF0esddhkDYa2t60KkM67QMwmiJlicHbk2Dxh8oMoUr0u5XQGJG4+qBVz716c/f/CGbDIKOGFtaDFzYgYh3asdBKQLHpvqdmmF07B8Kh9EpGRUPwqEWTzBZYMCZe8xh+HMnLQb6TRjcz6ivr7/4YiEjT4mMK2FaWvwXBKZGLbCuMxser1Nzwy4DLs2WjsFEvZ3iFzRlUBcN1bUtNMCb889YORPCLffNyn/XF+djrE1moEVGg/EEVS2MBMvjF0SGPDuTM3CdGQ3GH1eaISPa4Qzi0HE2w2/urSo0nrYgcfeso/Ohk2v8a+8e3GuiIvPPy+ttMndpMjAkxggfY/OegDT7AtFD9ogMsrNmCceDBCeEnBUMIT6+3mB7mq2Jmqghh1BbIed7vQHlaOfWxj0T848OkomfN3DZF0wy4w0HGdNLkfGeVy3HOQ1dVKrVRFjBCIfDERmK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" width="281" height="41" style="margin:.75em 0 0;" /></a>
	<h4 style="margin:.75em 0; font-size:1.2em; font-weight:normal;">{{dont_have}} <a href="{{ctct_url}}">{{try_free}}</a> {{15_days}}</h4>
	<p>{{description}}</p>
	<p class="submit"><a href="{{admin_url}}" class="button button-large button-primary thickbox" style="display:inline-block; margin-bottom:1em; font-size:1.2em;" title="{{install_title}}">{{add_support}}</a><strong class="description"> - {{its_easy}}</strong></p>
	<div class="clear"></div>
</div>
EOL;

	$strings = array(
		'ctct_url' => 'https://katz.si/4i',
		'hide_link' => esc_url_raw( add_query_arg('hide', 'cf7_modules_promo_message') ),
		'hide_text' => esc_html__( 'Hide this message', 'cf7_modules' ),
		'want_to' => esc_html__( 'Want to integrate your form with a newsletter?', 'cf7_modules' ),
		'dont_have' => esc_html__( 'Don\'t have a Constant Contact account?', 'cf7_modules' ),
		'try_free' => esc_html__( 'Try Constant Contact for free', 'cf7_modules' ),
		'15_days' => esc_html__( 'for 15 days!', 'cf7_modules' ),
		'description' => esc_html__( 'The Contact Form 7 Constant Contact Module makes it super-simple to add your contacts to an email newsletter. Simply sign up for a free trial at Constant Contact, enter your details, and you\'re ready to rock.', 'cf7_modules' ),
		'add_support' => esc_html__( 'Add Newsletter Support', 'cf7_modules' ),
		'install_title' => esc_html__( 'Install Contact Form 7 - Constant Contact Module', 'cf7_modules' ),
		'its_easy' => esc_html__( 'It&rsquo;s easy!', 'cf7_modules' ),
		'admin_url' => esc_url_raw( admin_url( 'plugin-install.php?tab=plugin-information&amp;plugin=contact-form-7-newsletter&amp;TB_iframe=true&amp;width=600&amp;height=800' ) ),
	);

	foreach ( $strings as $key => $string ) {
		$message = str_replace( '{{' . $key . '}}', $string, $message );
	}

	return $message;
}

add_filter( 'wpcf7_cf7com_links', 'contact_form_7_modules_links' );

function contact_form_7_modules_links($links) {
	return str_replace('</div>', ' - <a href="http://katz.si/gf?con=link" target="_blank" title="Gravity Forms is the best WordPress contact form plugin." style="font-size:1.25em;">Try Gravity Forms</a></div>', $links);
}