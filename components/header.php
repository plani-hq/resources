<?php

// PREVENT DIRECT ACCESS
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    // The file is being accessed directly
    http_response_code(403);
    header("Location: /403/");
    exit;
}
// PREVENT DIRECT ACCESS

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/utils/paths.php";
include_once($path); 
$PATHS = new Paths();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <!-- Google Console Verification -->
        <meta name="google-site-verification" content="Ypc_O50xyYcRsv6t5OlfQYcCYE6oPsvqoFYubJ__8UY" />

        <!-- Default Settings -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- SEO -->
        <meta name="keywords" content="<?= $seo_keywords ?>" />
        <meta name="description" content="<?= $seo_description ?>" />
        <meta name="author" content="<?= $seo_author ?>" />

        <!-- Icons -->
        <link rel="icon" type="image/x-icon" href="/assets/icons/favicon.png">
        <link rel="manifest" href="/site.webmanifest">

        <!-- Styles -->
        <link href="/assets/lib/bootstrap.min.css" rel="stylesheet">
        <link href="/styles/css/header.css" rel="stylesheet">

        <!-- Hotjar -->
        <script defer>
        (function (h, o, t, j, a, r) {
            h.hj =
            h.hj ||
            function () {
                (h.hj.q = h.hj.q || []).push(arguments);
            };
            h._hjSettings = { hjid: 3560401, hjsv: 6 };
            a = o.getElementsByTagName("head")[0];
            r = o.createElement("script");
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, "https://static.hotjar.com/c/hotjar-", ".js?sv=");
        </script>

        <title><?= $site_title ?></title>
    </head>
    <body>