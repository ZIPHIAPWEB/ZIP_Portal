<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

@include('new.partials.head')

<body>
    @include('new.partials.navbar')

    @yield('content')
    
    @include('new.partials.footer')
    @include('new.partials.scripts')
</body>

</html>