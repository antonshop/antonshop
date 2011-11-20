<?php
/**
 * payer_auth_frame page
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2005 CardinalCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 15519 2010-02-19 11:01:58Z drbyte $
 */
/**
 * Purpose:
 * Creates a frame display so the the customer can complete
 * payer authentication but still have the experience that they have
 * not left the online store.
 */

if (!isset($_SESSION['customer_id']) || (int)$_SESSION['customer_id'] < 1 || !isset($_SESSION['payment']) || $_SESSION['payment'] == '' || !isset($_SESSION['3Dsecure_acsURL']) || $_SESSION['3Dsecure_acsURL'] == '') {
  die(WARNING_SESSION_TIMEOUT);
}

$_SESSION['3Dsecure_term_url'] = zen_href_link(FILENAME_PAYER_AUTH_VERIFIER, '', 'SSL', true, false);
$_SESSION['3Dsecure_auth_url'] = zen_href_link(FILENAME_PAYER_AUTH_AUTH, '', 'SSL', true, false);
$flag_disable_left = TRUE;
$flag_disable_right = TRUE;

header("Cache-Control: max-age=1");  // stores for only 1 second, which prevents page from being re-displayed
