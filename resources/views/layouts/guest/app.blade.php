<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga - Layanan Desa</title>
    @include('layouts.guest.css')

</head>

<body>
    {{-- start header --}}
    @include('layouts.guest.header')
    {{-- end header --}}

    {{-- start content --}}
    @yield('content')
    {{-- end content --}}

    {{-- start footer --}}
    @include('layouts.guest.footer')
    {{-- end footer --}}

    {{-- start js --}}
    @include('layouts.guest.js')
    {{-- end js --}}

    <!-- add your custom CSS -->
<style>
body {
 font-family: sans-serif;
}

/* Add WA floating button CSS */
.floating {
 position: fixed;
 width: 60px;
 height: 60px;
 bottom: 40px;
 right: 40px;
 background-color: #25d366;
 color: #fff;
 border-radius: 50px;
 text-align: center;
 font-size: 30px;
 box-shadow: 2px 2px 3px #999;
 z-index: 100;
}
.fab-icon {
 margin-top: 16px;
}
</style>
<a href="https://wa.me/6281209874568?text=Hi%20Layanan Surat" class="floating" target="_blank">
<i class="fab fa-whatsapp fab-icon"></i>
</a>
</body>


