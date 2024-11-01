<?php
/*
Plugin Name: Unsereuni Online Demo Austria 
Version: 1.1
Plugin URI: http://wiki.unsereuni.at/wiki/index.php/Online-Demo
Description: BITTE NICHT VERGESSEN, EINEN EINTRAG IN DER LISTE DER TEILNEHMENDEN WEBSEITEN HINZUZUF&Uuml;GEN (PLEASE DONT FORGET TO ADD YOUR SITE TO THE DIRECTORY OF PARTICIPATING WEBSITES!!! <a href="http://unibrennt.at/wiki/index.php/Liste_der_teilnehmenden_Blogs_und_Websites" target="_blank">http://unibrennt.at/wiki/index.php/Liste_der_teilnehmenden_Blogs_und_Websites</a><br />F&uuml;gt den Pagepeel f&uuml;r die Online-Demo &quot;<a href="http://www.unsereuni.at" target="_blank">www.unsereuni.at</a>" in das Wordpress-Blog ein. Angepasst von <a href="http://www.ihrwebprofi.at/lifestream">Robert Harm</a> (basierend auf <a href="http://spannungsraum.uttx.net" target="_blank">spannungsraum</a> und Original VDS Page Peel
Author: Robert Harm
Author URI: http://www.ihrwebprofi.at/lifestream
*/

### Function: Page Peel CSS
add_action('wp_head', 'pagepeel_css');

function pagepeel_css() {
global $sonder;
  echo <<<EOH
<!-- AKVS head start v1.5 -->
<style type="text/css">
<!--
div#akct {
	position: absolute; top:0px; right: 0px; z-index: 2342; width:187px; height:84px;
	background-image: url(http://unibrennt.at/resources/img/Unsereuni-klein.gif);
	background-repeat: no-repeat;
	background-position: right top;
	border:none;
	padding:0;
	margin:0;
	text-align: right;
}

div#akct img {
	border:none;
	padding:0;
	margin:0;
	background: none;
}

div#akct a#akpeel img {
        width: 187px;
        height: 84px;
}

div#akct a, div#akct a:hover {
	text-decoration: none;
	border:none;
	padding:0;
	margin:0;
	display: block;
	background: none;
}

div#akct a#akpeel:hover {
	position: absolute; top:0px; right: 0px; z-index: 4223; width:500px; height:435px;
	display: block;
	background-image: url(http://unibrennt.at/resources/img/Unsereuni-gross.gif);
	background-repeat: no-repeat;
	background-position: right top;

EOH;
if (vds_get_special()) {
echo('background-image: url(http://unibrennt.at/resources/img/Unsereuni-gross.gif);');
} else {
echo('background-image: url(http://unibrennt.at/resources/img/Unsereuni-gross.gif);');
}
echo <<<EOH2
	background-repeat: no-repeat;
	background-position: right top;
}

div#akct a#akpreload {
EOH2;
if (vds_get_special()) {
echo('background-image: url(http://unibrennt.at/resources/img/Unsereuni-gross.gif);');
} else {
echo('background-image: url(http://unibrennt.at/resources/img/Unsereuni-gross.gif);');
}
echo <<<EOH3
	background-repeat: no-repeat;
	background-position: 234px 0px;
}
-->
</style>
<!--[if gte IE 5.5]>
<![if lt IE 7]>
<style type="text/css">
div#akct a#akpeel:hover {
		right: -1px;
}
</style>
<![endif]>
<![endif]-->
<!-- AKVS head end -->
EOH3;
}

add_action('wp_footer', 'pagepeel_body');
function pagepeel_body() {
	echo <<<EOB
<!-- AKVS body start v1.5 -->
<div id="akct"><a id="akpeel" href="http://www.unsereuni.at" target="_blank" title="#unsereuni-Onlinedemo - Zeig dich solidarisch unter http://www.unsereuni.at"><img src="http://unibrennt.at/resources/img/Unsereuni-blank.gif" width="20" height="20" alt="blank" /></a>
<a id="akpreload" href="http://unibrennt.at/wiki/index.php/Online-Demo" target="_blank" title="Willst du auch an der Online-Demo teilnehmen? Hier findest du alle relevanten Infos und Materialien: http://unibrennt.at/wiki/index.php/Online-Demo"><img src="http://unibrennt.at/resources/img/Unsereuni-info.gif" width="20" height="12" alt="info" /></a></div>
<!-- AKVS body end -->
EOB;
}

add_action('admin_menu', 'vds_ppeel_config_page');

function vds_ppeel_config_page() {
	global $wpdb;
	if ( function_exists('add_submenu_page') )
		add_submenu_page('plugins.php', 'Cern Online Demo Austria', 'Cern Online Demo Austria', 'manage_options', 'ak-vds-config', 'ak_vds_conf');
}

function vds_get_special() {
  $value = trim(get_option('use_special'));
  return $value == '1';
}


function ak_vds_conf() {
	
	$path = get_option('siteurl') . '/wp-content/plugins';
	
	if (isset($_POST['submit']) ) {
		update_option('use_special', $_POST['use_special']);
	}
	
	?>
	<div class="wrap">
		<h2>Unsereuni Online Demo Austria - Sonderhinweis</h2>
		<form action="" method="post" id="vds-conf" style="margin: auto; width: 400px; ">
			
			<table border="0">
				<tr>
					<td>
						Darf ein eventueller Sonderhinweis angezeigt werden? (in dieser Version des Plugins hat dies keine Auswirkung):
					</td>
					<td>
						<input type="radio" name="use_special" id="vds_special1" value="1" <?=(vds_get_special() == '1') ? 'checked' : ''?> /> <label for="vds_special1">ja</label><br/>
						<input type="radio" name="use_special" id="vds_special0" value="0" <?=(vds_get_special() != '1') ? 'checked' : ''?> /> <label for="vds_special0">nein</label><br/>
					</td>
				</tr>
				<tr>
					<td align="center">
						<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<?php
}
?>