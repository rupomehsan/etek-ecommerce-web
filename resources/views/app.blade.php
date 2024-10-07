<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @inertiaHead
    @if (isset($page['props']['event']))
    <title inertia>
        {{ isset($page['props']['event']['title']) ? $page['props']['event']['title'] : 'ETEK Enterprise' }}
    </title>
    <meta name="twitter:card"
        content="{{ isset($page['props']['event']['card']) ? $page['props']['event']['card'] : 'summary' }}" />
    <meta name="twitter:site" content="@sitename" />
    <meta property="og:title"
        content="{{ isset($page['props']['event']['title']) ? 'My Website | ' . $page['props']['event']['title'] : 'My Website | Page' }}" />
    <meta property="og:description"
        content="{{ isset($page['props']['event']['description']) ? $page['props']['event']['description'] : '' }}" />
    <meta property="og:image"
        content="{{ isset($page['props']['event']['image']) ? $page['props']['event']['image'] : 'https://shefat.info/assets/website/assets/img/logo.png' }}" />
    @endif

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="etek">
    <meta name="keywords" content="etek enterprise">
    <meta name="author" content="etek">
    <link rel="shortcut icon" href="/frontend/images/etek_favicon.png" type="image/x-icon">

    <meta property="og:title" content="ETEK Enterprise" />
    <meta property="og:site_name" content="ETEK Enterprise" />
    <meta property="og:description"
        content="A perfect It solution for building your dream pc. Let&#039;s Make Your Best Pc with us." />
    <meta property="og:type" content="Ecommerce" />
    <meta property="og:url" content="https://etek.com.bd" />
    <meta property="og:image" content="https://etek.com.bd/frontend/images/etek_logo.png" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="400" />

    <meta name="twitter:title" content="ETEK Enterprise">
    <meta name="twitter:description"
        content="A perfect It solution for building your dream pc. Let&#039;s Make Your Best Pc with us.">
    <meta name="twitter:image" content="https://etek.com.bd/frontend/images/etek_logo.png">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla:ital@0;1&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/frontend/assets/css/website.css">
    <link rel="stylesheet" href="/frontend/assets/css/lightbox.css">
    <link rel="stylesheet" href="/frontend/assets/css/custom.css">
    <link rel="stylesheet" href="/frontend/assets/css/appstyle.css">

    <script>
        // if(window.innerWidth < 991){
        //     location.href = "https://m.etek.com.bd";
        // }
        window.load_image = function (url, cache = true, resize=false, height=400, width=400) {

            try {
                new URL(url);
                return url;
            } catch (error) {
                let full_url = `{{env('IMAGE_HOST')}}/${url}`;

                return full_url;

                if(cache){
                    full_url = `{{env('IMAGE_HOST')}}/cache/${url}`;
                }
                if(resize){
                    full_url = `{{env('IMAGE_HOST')}}/resize/cache/${url}?width=${width}&height=${height}`;
                }
                full_url.replaceAll('//', '/');
                return full_url;
            }

        }
    </script>

    <script src="/frontend/assets/js/jquery-3.3.1.min.js.download"></script>
    <script src="/frontend/assets/js/popper.min.js.download"></script>
    <script src="/frontend/assets/js/bootstrap.js.download"></script>
    <script src="/frontend/assets/js/lightbox.min.js"></script>
    <script defer src="/frontend/assets/js/script.js"></script>
    <script defer src="/frontend/assets/js/modal.js"></script>
    <script defer src="/plugins/sweet_alert.js"></script>

    @vite(['resources/js/frontend/app.js'])
</head>

<body>
    @inertia
</body>

</html>
