<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('frontend/js/jquery-3.2.1.min.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<!-- Rev slider js -->
<script src="{{ asset('frontend/vendors/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}">
</script>
<script src="{{ asset('frontend/vendors/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<!-- Extra plugin css -->
<script src="{{ asset('frontend/vendors/counterup/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/bootstrap-selector/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/image-dropdown/jquery.dd.min.js') }}"></script>
<!-- <script src="{{ asset('frontend/js/smoothscroll.js') }}"></script> -->
<script src="{{ asset('frontend/vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/magnify-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/vendors/vertical-slider/js/jQuery.verticalCarousel.js') }}"></script>
<script src="{{ asset('frontend/js/theme.js') }}"></script>
<script src="{{ asset('frontend/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('frontend/js/my.js') }}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>







{{-- add mess  --}}
<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "100376986012240");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v13.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
@yield('js')
