<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>

    <!--Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Smooch&display=swap" rel="stylesheet">

    <!-- Plugin -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets') }}/styles.css" rel="stylesheet" />
    
</head>

<body>

    <header>
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +6285241702298</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> didindong30@gmail.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> Perintis kemerdekaan 7</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
                    @auth
                        <li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
                    @endauth
                    @guest
                        <li><a href="#"><i class="fa fa-user-o"></i> Login/Resgister</a></li>
                    @endguest
                </ul>
            </div>
        </div>

        <div id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="header-logo">
                            <h3 class="title">Tokokuk</h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="header-search">
                            <form>
                                <input type="text" class="input" placeholder="Search here...">
                                <button type="button" class="search-btn">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="user_option_box">
                            <a href="" class="account-link">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                <span>
                                    Wishlist
                                </span>
                            </a>
                            <a href="" class="cart-link">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span>
                                    Cart
                                </span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link {{ request()->is('') ? 'active' : ''}}" aria-current="page"
                            href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('about') ? 'active' : ''}}"
                            href="">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Section-->
    @yield('content')



    <!--FOOTER-->
    <footer>
        <div class="footer">
            <section>
                <h3>About Us</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                <ul class="footer-links">
                    <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>
            </section>
            <section>
                <h3>Categories</h3>
                <a href="#">Home</a>
                <a href="#">About Us</a>
                <a href="#">Blog</a>
                <a href="#">Contact Us</a>
            </section>
            <section>
                <h3>Information</h3>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms & Conditions</a>
                <a href="#">Cookie Policy</a>
            </section>
            <section>
                <h3>Service</h3>
                <a href="emailto:support@websitename.com"><span><i
                            class="fa fa-envelope"></i></span><span>support@websitename.com</span></a>
                <a href="tel:xxxxxxxxx"><span><i class="fa fa-phone"></i></span><span>(+x)-xxx-xxxx-xxxxx</span></a>
            </section>
        </div>
    </footer>
    <div class="sub-footer">
        Copyright ©2022 All rights reserved | didinsibua
    </div>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js') }}/scripts.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
		    var slider = $("#slider");
		    var thumb = $("#thumb");
		    var slidesPerPage = 4; //globaly define number of elements per page
		    var syncedSecondary = true;
		    slider.owlCarousel({
		        items: 1,
		        slideSpeed: 2000,
		        nav: false,
		        autoplay: false, 
		        dots: false,
		        loop: true,
		        responsiveRefreshRate: 200
		    }).on('changed.owl.carousel', syncPosition);
		    thumb
		        .on('initialized.owl.carousel', function() {
		            thumb.find(".owl-item").eq(0).addClass("current");
		        })
		        .owlCarousel({
		            items: slidesPerPage,
		            dots: false,
		            nav: true,
		            item: 4,
		            smartSpeed: 200,
		            slideSpeed: 500,
		            slideBy: slidesPerPage, 
		        	navText: ['<svg width="18px" height="18px" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="25px" height="25px" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
		            responsiveRefreshRate: 100
		        }).on('changed.owl.carousel', syncPosition2);
		    function syncPosition(el) {
		        var count = el.item.count - 1;
		        var current = Math.round(el.item.index - (el.item.count / 2) - .5);
		        if (current < 0) {
		            current = count;
		        }
		        if (current > count) {
		            current = 0;
		        }
		        thumb
		            .find(".owl-item")
		            .removeClass("current")
		            .eq(current)
		            .addClass("current");
		        var onscreen = thumb.find('.owl-item.active').length - 1;
		        var start = thumb.find('.owl-item.active').first().index();
		        var end = thumb.find('.owl-item.active').last().index();
		        if (current > end) {
		            thumb.data('owl.carousel').to(current, 100, true);
		        }
		        if (current < start) {
		            thumb.data('owl.carousel').to(current - onscreen, 100, true);
		        }
		    }
		    function syncPosition2(el) {
		        if (syncedSecondary) {
		            var number = el.item.index;
		            slider.data('owl.carousel').to(number, 100, true);
		        }
		    }
		    thumb.on("click", ".owl-item", function(e) {
		        e.preventDefault();
		        var number = $(this).index();
		        slider.data('owl.carousel').to(number, 300, true);
		    });


            $(".qtyminus").on("click",function(){
                var now = $(".qty").val();
                if ($.isNumeric(now)){
                    if (parseInt(now) -1> 0)
                    { now--;}
                    $(".qty").val(now);
                }
            })            
            $(".qtyplus").on("click",function(){
                var now = $(".qty").val();
                if ($.isNumeric(now)){
                    $(".qty").val(parseInt(now)+1);
                }
            });
		});
    </script> --}}

    @stack('scripts')
</body>

</html>
