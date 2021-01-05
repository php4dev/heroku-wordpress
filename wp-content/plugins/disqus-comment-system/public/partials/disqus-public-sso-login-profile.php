<?php
/**
 * Markup rendered as part of a user's own profile page which will check
 * a query param to determine if it was opened in a child window, as in
 * the case of clicking "Log in" to an SSO account via the Disqus embed,
 * and will close the window. We do this because the embed is waiting for
 * the window to close before reloading with the authenticated user.
 *
 * @link       https://disqus.com
 * @since      3.0
 *
 * @package    Disqus
 * @subpackage Disqus/public/partials
 */

?>

<script>
    var win = window;
    var isWindowed = win.opener && win.opener !== win.top;
    var isDsqRedirect = win.location.href.indexOf('opener=dsq-sso-login') > -1;
    if (isWindowed && isDsqRedirect)
        window.close();
</script>
