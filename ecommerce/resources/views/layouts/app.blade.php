@extends('layouts.base')

@section ('body')
   <!-- navigation -->
   <!-- Site Wrapper-->
   <div class="site_wrapper">
        @yield('content')
   </div>
   <!-- navigation -->
   @yield('footer')
@stop

