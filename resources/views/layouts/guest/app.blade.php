<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Data Warga - Bina Desa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
{{-- start css --}}
@include('layouts.guest.css')
{{-- end css --}}

{{-- start header --}}
@include('layouts.guest.header')
{{-- end header --}}

{{-- start main content --}}
    @yield('content')
{{-- End main content --}}

    <!-- Footer Start -->
    @include('layouts.guest.footer')
    <!-- Footer End -->

{{-- start js --}}
@include('layouts.guest.js')
{{-- end js --}}


