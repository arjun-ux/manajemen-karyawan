@extends('layouts.main')
@section('content')
<div class="container" style="padding-top: 60px">
    <div class="row justify-content-center m-0">
        <div class="col-md-8 text-center">
            <div class="maskot">
                SELAMAT DATANG
            </div>
        </div>
    </div>
    <div class="row justify-content-center m-0">
        <div class="col-md-12 text-center">
            <div class="ponpes">
                PONPES KANAK KANAK DARUSSALAM BLOKAGUNG
            </div>
        </div>
    </div>
</div>
@endsection
@push('scroll')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var scrollToTopBtn = document.getElementById("scrollToTopBtn");

            // Show/hide the scroll-to-top button based on scroll position
            window.addEventListener("scroll", function() {
                if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) {
                    scrollToTopBtn.style.display = "block";
                } else {
                    scrollToTopBtn.style.display = "none";
                }
            });

            // Scroll to the top when the button is clicked
            scrollToTopBtn.addEventListener("click", function() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            });
        });

    </script>
@endpush
