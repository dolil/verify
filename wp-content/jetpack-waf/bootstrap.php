<?php
define( 'DISABLE_JETPACK_WAF', false );
if ( defined( 'DISABLE_JETPACK_WAF' ) && DISABLE_JETPACK_WAF ) return;
define( 'JETPACK_WAF_MODE', 'silent' );
define( 'JETPACK_WAF_SHARE_DATA', false );
define( 'JETPACK_WAF_SHARE_DEBUG_DATA', false );
define( 'JETPACK_WAF_DIR', 'G:\\xampp\\htdocs\\verify.dolil.com/wp-content/jetpack-waf' );
define( 'JETPACK_WAF_WPCONFIG', 'G:\\xampp\\htdocs\\verify.dolil.com/wp-content/../wp-config.php' );
define( 'JETPACK_WAF_ENTRYPOINT', 'rules/rules.php' );
require_once 'G:\\xampp\\htdocs\\verify.dolil.com\\wp-content\\plugins\\jetpack-protect/vendor/autoload.php';
Automattic\Jetpack\Waf\Waf_Runner::initialize();
