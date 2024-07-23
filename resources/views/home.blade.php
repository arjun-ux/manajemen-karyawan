@extends('layouts.main')
@section('content')
<div class="home">
    <h1>Selamat Datang</h1>
    <h4>Di Ponpes Kanak-Kanak Darussalam Blokagung.</h4>
    <h5>Tegalsari-Banyuwangi</h5>
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
