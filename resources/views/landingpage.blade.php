<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HOME | YOU2MENTOR</title>
    <!-- Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Landing page template for creative dashboard">
    <meta name="keywords" content="Landing page template">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ url('public/') }}/theme/landingpage/assets/logos/favicon.ico" type="image/png"
        sizes="16x16">
    <!-- Bootstrap -->
    <link href="{{ url('public/') }}/theme/landingpage/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"
        media="all" />
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,700,600" rel="stylesheet" type="text/css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/landingpage/assets/css/animate.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/landingpage/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ url('public/') }}/theme/landingpage/assets/css/owl.theme.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/landingpage/assets/css/magnific-popup.css">
    <!-- Full Page Animation -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/landingpage/assets/css/animsition.min.css">
    <!-- Ionic Icons -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/landingpage/assets/css/ionicons.min.css">
    <!-- Main Style css -->
    <link href="{{ url('public/') }}/theme/landingpage/assets/css/style.css" rel="stylesheet" type="text/css"
        media="all" />
</head>

<body>
    <div class="wrapper animsition" data-animsition-in-class="fade-in" data-animsition-in-duration="1000"
        data-animsition-out-class="fade-out" data-animsition-out-duration="1000">
        <div class="container">

            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header page-scroll">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand page-scroll" href="#main"><img
                                src="{{url('public')}}/theme/admin/dist/img/logo/YOU2MENTOR.png"
                                alt="This Logo" height="50" width="170" /></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a class="page-scroll" href="#main">Home</a></li>
                            <li><a class="page-scroll" href="#aboutus">About Us</a></li>
                            <li><a class="page-scroll" href="#">Process Map</a></li>
                            <li><a class="page-scroll" href="#rssfeed">Global Gurus</a></li>
                            <li><a class="page-scroll" href="#">Training</a></li>
                            <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li> <a data-wow-delay="0.2s" href="{{ route('login') }}">Login</a></li>
                        </ul>
                    </div>
                </div>
            </nav><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->

        <div class="main" id="main">
            <!-- Main Section-->

            <div class="flex-features" id="main" style="padding-bottom: 0px">
                <img src="{{ url('public/') }}/theme/landingpage/assets/images/youto.PNG" alt="img" width="100%" height="auto" style="margin-top: 20px">
            </div>

            <div class="flex-features" id="aboutus" style="padding-top: 5px; padding-bottom: 0px">
                 <div style="background-image: url('{{ url('public/') }}/theme/landingpage/assets/images/you2mentor_covers-01.jpg'); background-repeat: no-repeat;
                 background-attachment: fixed;
                 background-size: 100% 100%;">
                    <div class="container" >
                        <div class="col-md-6 col-md-offset-0 nopadding">
                            <div class="services-content">
                                <h1 class="wow fadeInUp text-left" data-wow-delay="0s" style="color:white;">About Us</h1>
                                <p class="wow fadeInUp text-justify" data-wow-delay="0.2s">
                                    Hello and welcome to You2Mentor.
                                </p><br>
                                <p class="wow fadeInUp text-justify" data-wow-delay="0.2s">
                                    Currently or at some point in life,
                                    you would have likely had a mentor for career growth or personal development
                                     and would already be aware of how having a mentor supports growth
                                     and if you have ever had the opportunity to be a mentor,
                                     it is a rewarding experience to see the personal growth you help build.
                                </p><br>
                                <p class="wow fadeInUp text-justify" data-wow-delay="0.2s">
                                    At You2Mentor, our mission is to facilitate individual growth while building a global community
                                     that supports and build each other collectively. As Neale Walsch said life begins at the
                                     end of our comfort zone.
                                </p><br>
                                <p class="wow fadeInUp text-justify" data-wow-delay="0.2s">
                                    Benefits of being a mentor and having a mentor is numerous but having a
                                    tribe of mentors opens up our world to more ideas and opportunities.
                                </p><br>
                                <p class="wow fadeInUp text-justify" data-wow-delay="0.2s">
                                    We all have our dreams and aspirations whether it’s professionally or personally.
                                    So wouldn’t it be great to connect with others who have been on a similar journey and can
                                    help guide you on yours? Or at the very least get some insights into possibilities while also
                                    supporting and mentoring others in areas where you have expertise in?
                                </p><br>
                                <p class="wow fadeInUp text-justify" data-wow-delay="0.2s">
                                    Come join us in leading the way of navigating personal development through virtual mentoring.
                                </p><br>
                                <p class="wow fadeInUp text-justify" data-wow-delay="0.2s">
                                    It is free to chat and you can sign in through your LinkedIn credentials.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feature Image Big -->
            <!--<div class="feature_huge text-center">-->
            <!--    <div class="container nopadding">-->
            <!--        {{-- <div class="col-md-12">-->
            <!--            <img class="img-responsive wow fadeInUp" data-wow-delay="0.1s"-->
            <!--                src="{{ url('public/') }}/theme/landingpage/assets/images/big_feature.png" alt=""-->
            <!--                style="max-width:100%" />-->
            <!--        </div> --}}-->
            <!--        <div class="feature_list">-->
            <!--            <div class="col-sm-4 wow fadeInUp" data-wow-delay="0.2s">-->
            <!--                <img src="{{ url('public/') }}/theme/landingpage/assets/logos/feature_icon.png"-->
            <!--                    alt="Feature" />-->
            <!--                <h1>Tursted Product</h1>-->
            <!--                <p>-->
            <!--                    We increasingly grow our talent and skills in admin dashboard development.-->
            <!--                </p>-->
            <!--            </div>-->
            <!--            <div class="col-sm-4 wow fadeInUp" data-wow-delay="0.4s">-->
            <!--                <img src="{{ url('public/') }}/theme/landingpage/assets/logos/feature_icon_2.png"-->
            <!--                    alt="Feature" />-->
            <!--                <h1>Online Documentation</h1>-->
            <!--                <p>-->
            <!--                    Documentation helps you in every steps on your entire project.-->
            <!--                </p>-->
            <!--            </div>-->
            <!--            <div class="col-sm-4 wow fadeInUp" data-wow-delay="0.6s">-->
            <!--                <img src="{{ url('public/') }}/theme/landingpage/assets/logos/feature_icon_3.png"-->
            <!--                    alt="Feature" />-->
            <!--                <h1>Free Updates & Support</h1>-->
            <!--                <p>-->
            <!--                    Fast and accurate outline during support. Low turnaround time.-->
            <!--                </p>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

            <!-- Counter Section -->
            <div class="pricing-section no-color text-center" id="rssfeed" style="background: #c9ffb8 !important">
                <div class="container">
                    <div class="col-md-12 col-sm-12 nopadding">
                        <div class="pricing-intro">
                            <h1 class="wow fadeInUp" data-wow-delay="0s">Lern More</h1>
                        </div>

                        <!-- start sw-rss-feed code -->
                        <script type="text/javascript">
                            <!--
                            rssfeed_url = new Array();
                            rssfeed_url[0]="https://globalgurus.org/feed/";
                            rssfeed_frame_width="1100";
                            rssfeed_frame_height="475";
                            rssfeed_scroll="on";
                            rssfeed_scroll_step="6";
                            rssfeed_scroll_bar="off";
                            rssfeed_target="_blank";
                            rssfeed_font_size="12";
                            rssfeed_font_face="verdana";
                            rssfeed_border="on";
                            rssfeed_css_url="";
                            rssfeed_title="on";
                            rssfeed_title_name="";
                            rssfeed_title_bgcolor="#00BD56";
                            rssfeed_title_color="#fff";
                            rssfeed_title_bgimage="";
                            rssfeed_footer="on";
                            rssfeed_footer_name="RSS feed";
                            rssfeed_footer_bgcolor="#00BD56";
                            rssfeed_footer_color="#fff";
                            rssfeed_footer_bgimage="";
                            rssfeed_item_title_length="50";
                            rssfeed_item_title_color="#000";
                            rssfeed_item_bgcolor="#DDF796";
                            rssfeed_item_bgimage="";
                            rssfeed_item_border_bottom="on";
                            rssfeed_item_source_icon="off";
                            rssfeed_item_date="off";
                            rssfeed_item_description="on";
                            rssfeed_item_description_length="250";
                            rssfeed_item_description_color="#523906";
                            rssfeed_item_description_link_color="#333";
                            rssfeed_item_description_tag="off";
                            rssfeed_no_items="0";
                            rssfeed_cache = "17d7aa7f77cb7bb55bf852b36e4ac0a6";
                            //-->
                        </script>
                            <script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script>
                            <!-- The link below helps keep this service FREE, and helps other people find the SW widget. Please be cool and keep it! Thanks. -->
                            <div style="color:#ccc;font-size:10px; text-align:right; width:1200px;">powered by <a href="https://surfing-waves.com" rel="noopener" target="_blank" style="color:#ccc;">Surfing Waves</a></div>
                            <!-- end sw-rss-feed code -->

                    </div>
                </div>
            </div>
            <!-- Counter Section Ends -->


            {{-- <div class="features-section">
                <!-- Feature section with flex layout -->
                <div class="f-left">
                    <div class="left-content wow fadeInLeft" data-wow-delay="0s">
                        <h2 class="wow fadeInLeft" data-wow-delay="0.1s">We are available for custom work development
                        </h2>
                        <p class="wow fadeInLeft" data-wow-delay="0.2s">
                            We at This available for custom work development with High end specialized developer.
                        </p>
                        <button class="btn btn-primary btn-action btn-fill wow fadeInLeft" data-wow-delay="0.2s"><a
                                href="#">Click to send query</a></button>
                    </div>
                </div>
                <div class="f-right">
                </div>
            </div> --}}


            <!-- Pricing Section -->
            {{-- <div class="pricing-section no-color text-center" id="pricing">
                <div class="container">
                    <div class="col-md-12 col-sm-12 nopadding">
                        <div class="pricing-intro">
                            <h1 class="wow fadeInUp" data-wow-delay="0s">Pricing Table</h1>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                Loream ipsum dummy text loream ipsum dummy text loream ipsum dummy text <br
                                    class="hidden-xs"> loream ipsum dummy text.
                                Get the right plan that suits you.
                            </p>
                        </div>
                        <div class="col-sm-6 nopadding">
                            <div class="table-left wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon">
                                    <img src="{{ url('public/') }}/theme/landingpage/assets/logos/cart2.png"
                                        alt="Icon" />
                                </div>
                                <div class="pricing-details">
                                    <h2>Beginner Plan</h2>
                                    <span>$5.90</span>
                                    <p>
                                        Pay little enjoy the product <br class="hidden-xs"> for life time.
                                    </p>
                                    <ul>
                                        <li>First basic feature </li>
                                        <li>Second feature goes here</li>
                                        <li>Any other third feature</li>
                                        <li>And the last one goes here</li>
                                    </ul>
                                    <button class="btn btn-primary btn-action btn-fill">Get Plan</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 nopadding">
                            <div class="table-right wow fadeInUp" data-wow-delay="0.6s">
                                <div class="icon">
                                    <img src="{{ url('public/') }}/theme/landingpage/assets/logos/cart1.png"
                                        alt="Icon" />
                                </div>
                                <div class="pricing-details">
                                    <h2>Premium Plan</h2>
                                    <span>$19.99</span>
                                    <p>
                                        Pay only for what you use. Flexible <br class="hidden-xs"> payment
                                        options.
                                    </p>
                                    <ul>
                                        <li>First premium feature </li>
                                        <li>Second premium one goes here</li>
                                        <li>Third premium feature here</li>
                                        <li>Final premium feature</li>
                                    </ul>
                                    <button class="btn btn-primary btn-action btn-fill">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> --}}

            <!-- Client Section -->
            {{-- <div class="client-section">
                <div class="container text-center">
                    <div class="clients owl-carousel owl-theme">
                        <div class="single">
                            <img src="{{ url('public/') }}/theme/landingpage/assets/logos/logo1.png" alt="" />
                        </div>
                        <div class="single">
                            <img src="{{ url('public/') }}/theme/landingpage/assets/logos/logo2.png" alt="" />
                        </div>
                        <div class="single">
                            <img src="{{ url('public/') }}/theme/landingpage/assets/logos/logo3.png" alt="" />
                        </div>
                        <div class="single">
                            <img src="{{ url('public/') }}/theme/landingpage/assets/logos/logo4.png" alt="" />
                        </div>
                        <div class="single">
                            <img src="{{ url('public/') }}/theme/landingpage/assets/logos/logo6.png" alt="" />
                        </div>
                        <div class="single">
                            <img src="{{ url('public/') }}/theme/landingpage/assets/logos/logo7.png" alt="" />
                        </div>
                    </div>
                </div>
            </div> --}}
{{--
            <!-- Subscribe Form -->
            <div class="cta-sub text-center no-color">
                <div class="container">
                    <h1 class="wow fadeInUp" data-wow-delay="0s">New product notification subscription</h1>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">
                        We sent you daily mail about product updates / releases / version change logs<br
                            class="hidden-xs">Please write accurate email address below.
                    </p>
                    <div class="form wow fadeInUp" data-wow-delay="0.3s">
                        <form class="subscribe-form wow zoomIn"
                            action="{{ url('public/') }}/theme/landingpage/assets/php/subscribe.php" method="post"
                            accept-charset="UTF-8" enctype="application/x-www-form-urlencoded" autocomplete="off"
                            novalidate>
                            <input class="mail" type="email" name="email" placeholder="Email address"
                                autocomplete="off"><input class="submit-button" type="submit" value="Subscribe">
                        </form>
                        <div class="success-message"></div>
                        <div class="error-message"></div>
                    </div>
                </div>
            </div> --}}

            <!-- Footer Section -->
            <div class="footer bg-dark">
                <div class="container">
                    <div class="col-md-12 text-center">
                        <img height="50" width="170" src="{{url('public')}}/theme/admin/dist/img/logo/YOU2MENTOR.png"
                            alt="This Logo" />
                        <ul class="footer-menu">
                            {{-- <li><a href="#">Site</a></li> --}}
                            {{-- <li><a href="#">Support</a></li> --}}
                            {{-- <li><a href="#">Terms</a></li> --}}
                            {{-- <li><a href="{{ route('privacy') }}">Privacy Policy</a></li> --}}
                        </ul>
                        <div class="footer-text">
                            <p>
                                Copyright © 2021 This. All Rights Reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll To Top -->


            <a id="back-top" class="back-to-top page-scroll" href="#main">
                <i class="ion-ios-arrow-thin-up"></i>
            </a>

            <!-- Scroll To Top Ends-->


        </div><!-- Main Section -->
    </div><!-- Wrapper-->

    <!-- Jquery and Js Plugins -->
    <script type="text/javascript" src="{{ url('public/') }}/theme/landingpage/assets/js/jquery-2.1.1.js"></script>
    <script type="text/javascript" src="{{ url('public/') }}/theme/landingpage/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ url('public/') }}/theme/landingpage/assets/js/plugins.js"></script>
    <script type="text/javascript" src="{{ url('public/') }}/theme/landingpage/assets/js/menu.js"></script>
    <script type="text/javascript" src="{{ url('public/') }}/theme/landingpage/assets/js/custom.js"></script>
  <!-- Messenger Chat plugin Code -->
  <div id="fb-root"></div>

  <!-- Your Chat plugin code -->
  <div id="fb-customer-chat" class="fb-customerchat">
  </div>

  <script>
    //   function hide_msg(){
    //     document.getElementById('fb-customer-chat').style.display='';
    //   }

    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "378569236250397");
    chatbox.setAttribute("attribution", "biz_inbox");
  </script>

  <!-- Your SDK code -->
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        xfbml            : true,
        version          : 'v12.0'
      });
    };

    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
</body>

</html>
