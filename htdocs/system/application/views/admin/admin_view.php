<?php $this->load->view('admin/header') ?>

<h1><?=$action?></h1>
<div id='div_box'>
		<fieldset><legend>Hotspot Info</legend>
		<ul>
			<li><label>Company Name</label><?=$company_name?></li>
			<li><label>Company Address</label><?=$company_address_line1?></li>
			<li><label>&nbsp;</label><?=$company_address_line2?></li>
			<li><label>&nbsp;</label><?=$company_address_line3?></li>
			<li><label>Phone</label><?=$company_phone?></li>
			<li><label>Tax Code</label><?=$company_tax_code?></li>
		</ul>
		</fieldset>
		<fieldset><legend>System Info</legend>
		<ul>
			<li><label>Hostname</label><?=$hostname?></li>
			<li><label>Operating System</label><?=$os?></li>
		</ul>
		<ul>
			<li><label>MySQL ?</label><?=$mysql?></li>
			<li><label>Chillspot ?</label><?=$chilli?></li>
			<li><label>Chillspot COAPORT ?</label><?=$coaport?></li>
			<li><label>Radius 1812 ?</label><?=$radius1?></li>
			<li><label>Radius 1813 ?</label><?=$radius2?></li>
			<li><label>Radius 1814 ?</label><?=$radius3?></li>
		</ul>
		</fieldset>
		<fieldset>
			<legend>Support</legend>
			<div id="donation">
			<form method="post" action="https://www.paypal.com/cgi-bin/webscr">
			<input type="hidden" value="_s-xclick" name="cmd"/>
			<input type="image" border="0" alt="Make payments with PayPal - it's fast, free and secure!" name="submit" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif"/>
			<!-- <img width="1" height="1" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" alt="" /> -->
			<input type="hidden" value="-----BEGIN PKCS7-----MIIHPwYJKoZIhvcNAQcEoIIHMDCCBywCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYCW/a4klCsKdiNOc/wEIHqe5QUnUW6u5Cn8zbVxNB7YR0s0HxbPKztWpX9eYoDMFrwxX0KwHJKkyp3cSLW5IDvmGu8AZq1D3duDw/f08hPr5zZkvroaQkwGJItV1RLXmXVVeev+U4P5dXPLoMCLFjj/aDnim/YrDSvDNPYXvtcxkDELMAkGBSsOAwIaBQAwgbwGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIJwyhCV6d562AgZhKT+BXIWEG52W9jxPUEqLClwaz8B0E48NOZdEXcMhNFqHnKBGLxRHD3dJWyHXCD78OWRgj0zSJRQKrhUKTvI8inc8Ve29yjOWr5+GkuACpH+k1qOPCcMF+Ax34kL/y/NLwiMOmuOucxnGJttHc0pCiDhrfLx9BCxIBEY+4YwK2jan5tsDKPfhZbEuYZr8N4h8QeFJC89d4k6CCA4cwggODMIIC7KADAgECAgEAMA0GCSqGSIb3DQEBBQUAMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTAeFw0wNDAyMTMxMDEzMTVaFw0zNTAyMTMxMDEzMTVaMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEAwUdO3fxEzEtcnI7ZKZL412XvZPugoni7i7D7prCe0AtaHTc97CYgm7NsAtJyxNLixmhLV8pyIEaiHXWAh8fPKW+R017+EmXrr9EaquPmsVvTywAAE1PMNOKqo2kl4Gxiz9zZqIajOm1fZGWcGS0f5JQ2kBqNbvbg2/Za+GJ/qwUCAwEAAaOB7jCB6zAdBgNVHQ4EFgQUlp98u8ZvF71ZP1LXChvsENZklGswgbsGA1UdIwSBszCBsIAUlp98u8ZvF71ZP1LXChvsENZklGuhgZSkgZEwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tggEAMAwGA1UdEwQFMAMBAf8wDQYJKoZIhvcNAQEFBQADgYEAgV86VpqAWuXvX6Oro4qJ1tYVIT5DgWpE692Ag422H7yRIr/9j/iKG4Thia/Oflx4TdL+IFJBAyPK9v6zZNZtBgPBynXb048hsP16l2vi0k5Q2JKiPDsEfBhGI+HnxLXEaUWAcVfCsQFvd2A1sxRr67ip5y2wwBelUecP3AjJ+YcxggGaMIIBlgIBATCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwCQYFKw4DAhoFAKBdMBgGCSqGSIb3DQEJAzELBgkqhkiG9w0BBwEwHAYJKoZIhvcNAQkFMQ8XDTA4MDIyMzEwMTM1MVowIwYJKoZIhvcNAQkEMRYEFDlu0kBAiVE8jmo7Y51jwYFvbTg3MA0GCSqGSIb3DQEBAQUABIGAMdud9yRSzA6ZGeNgqNg23KRG1bZTZJ9m66dvOANPVvsXIeQsTMGPhjUPHAz6y5ZVcXINrYgGmFiexLeM7qeaX4rlgO2ci2GVU1/jY/G7fkgzFx3jqKF/X0iEezIRA9YwWzs9H1M94mg+qv+eZYAS1fABuQOyijmefOpdG7iP7YE=-----END PKCS7-----
			" name="encrypted"/>
			</form></div>
			<p>If You find this software helpful, please consider donating, to help this project to keep on rolling.<p>
			<p>We also provide professional support (configuration, customization, etc ). Please <strong><a href="http://easyhotspot.sourceforge.net/index.php/contact">contact us</a></strong> for more information.</p>
		</fieldset>
		<p>You are logged in as <?=$user?></p>
		</div>
<?= $content ?>

<? $this->load->view('footer'); ?>
