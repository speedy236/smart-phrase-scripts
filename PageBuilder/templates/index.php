<?php
$pageString = '<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="cs"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="cs" class="no-js"> <![endif]-->
<html lang="cs">

<head>
    ' . constructHead($page, $getLang[$y]) . '
    <!-- #include file = "snippets/css_js.html" -->
    <?php include("snippets/css_js.html"); ?>

</head>

<body>

    <!-- Container -->
    <div id="container">

        <!-- Start Header -->
        <div class="hidden-header"></div>
        <header class="clearfix">

            <!-- Start Top Bar -->
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Start Contact Info -->
                            ' . constructDropDesktop($page, $getLang[$y]) . '
                            <!-- End Contact Info -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Bar -->

            <!-- Start Header ( Logo & Naviagtion ) -->
            <div class="navbar navbar-default navbar-top">
                <div class="container">
                    <div class="navbar-header">
                        <!-- Stat Toggle Nav Link For Mobiles -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <i class="icon-menu-1"></i>
                            </button>
                        <!-- End Toggle Nav Link For Mobiles -->
                        <?php
                            include("snippets/logo.html");
                            ?>
                            <!-- #include file = "snippets/logo.html" -->
                    </div>
                    <div class="navbar-collapse collapse">
                        '. constructDropMobile($page, $getLang[$y]) .'
                        <?php include("snippets/menu.html"); ?>
                        <!-- #include file = "snippets/menu.html" -->
                    </div>
                </div>
            </div>
            <!-- End Header ( Logo & Naviagtion ) -->
        </header>
        <!-- End Header -->



        <!-- Start Home Slider -->
        <div id="slider">

            <!-- START REVOLUTION SLIDER 3.1 rev5 fullwidth mode -->
            <div class="fullwidthbanner-container">
                <div class="fullwidthbanner">
                    <ul>
                        <!-- SLIDE 1         -->
                        <li data-transition="fade" data-slotamount="7" data-masterspeed="300">
                            <!-- MAIN IMAGE -->
                            <img src="../../images/travelers-phrasebook-wallpaper.jpg" data-fullwidthcentering="on" alt="Traveling slide" data-bgfit="cover"
                                data-bgposition="center center" data-bgrepeat="no-repeat">

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption uppercase big_font_size boldest_font_weight dark_font_color sft start" data-x="550" data-y="80" data-speed="300"
                                data-start="1600" data-easing="easeOutExpo"><span class="accent-color">ins1</span>
                            </div>

                            <!-- LAYER NR. 2A -->
                            <div class="tp-caption medium_font_size regular_font_weight dark_font_color sfl start" data-x="550" data-y="150" data-speed="300"
                                data-start="1900" data-easing="easeOutExpo">ins2
                            </div>

                            <!-- LAYER NR. 2B -->
                            <div class="tp-caption medium_font_size regular_font_weight dark_font_color sfl start" data-x="550" data-y="200" data-speed="300"
                                data-start="1900" data-easing="easeOutExpo">
                                <ul class="icons-list">
                                    <li><i style="font-size:1.5em" class="icon-language"></i> 22 ins3</li>
                                    <li><i style="font-size:1.5em" class="icon-chat-3"></i> 31 ins4</li>
                                    <li><i style="font-size:1.5em" class="icon-list-bullet"></i> 600 ins5</li>
                                </ul>
                            </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption sfl start" data-x="80" data-y="35" data-speed="1000" data-start="1000" data-easing="Power1.easeOut"><img src="../../lang/'. $getLang[$y] .'/images/ikona_smart_phrase.png" alt="SmartPhrase Icon">
                            </div>

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption sfr start" data-x="center" data-y="360" data-hoffset="200" data-speed="600" data-start="2000" data-easing="easeOutExpo"><a href="/vlastnosti-konverzace" class="btn-system btn-medium">Vlastnosti</a>
                            </div>
                        </li>

                        <!-- SLIDE 2  -->
                        <li data-transition="fade" data-slotamount="7" data-masterspeed="300">
                            <!-- MAIN IMAGE -->
                            <img src="../../images/travelers-phrasebook-banner.jpg" data-fullwidthcentering="on" alt="" data-bgfit="cover" data-bgposition="center center"
                                data-bgrepeat="no-repeat">

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption uppercase big_font_size boldest_font_weight dark_font_color sft start" data-x="center" data-y="140"
                                data-speed="300" data-start="1000" data-easing="easeOutExpo">22 ins3
                            </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption medium_font_size regular_font_weight dark_font_color sfb start" data-x="center" data-y="182" data-speed="300"
                                data-start="1300" data-easing="easeOutExpo">ins7
                            </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption medium_font_size regular_font_weight dark_font_color text-center sfb start" data-x="center" data-y="220"
                                data-speed="300" data-start="1600" data-easing="easeOutExpo">ins8
                            </div>

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption sfr start" data-x="center" data-y="292" data-hoffset="84" data-speed="600" data-start="2000" data-easing="easeOutExpo"><a href="/vlastnosti-konverzace" class="btn-system btn-medium">Vlastnosti</a>
                            </div>

                            <!-- LAYER NR. 5 -->
                            <div class="tp-caption sfl start" data-x="center" data-y="292" data-hoffset="-84" data-speed="600" data-start="2000" data-easing="easeOutExpo"><a href="/jak-vypada-konverzace" class="btn-system btn-medium btn-gray">Náhled</a>
                            </div>
                        </li>

                    </ul>
                    <div class="tp-bannertimer" style="visibility:hidden;"></div>
                </div>
            </div>

            <!-- THE SCRIPT INITIALISATION -->
            <!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
            <script type="text/javascript">
                var revapi;
                jQuery(document).ready(function () {
                    revapi = jQuery(".fullwidthbanner").revolution({
                        delay: 9000,
                        startwidth: 1140,
                        startheight: 450,
                        hideThumbs: 200,
                        thumbWidth: 100,
                        thumbHeight: 50,
                        thumbAmount: 3,
                        navigationType: "none",
                        navigationArrows: "solo",
                        navigationStyle: "round",
                        touchenabled: "on",
                        onHoverStop: "on",
                        navigationHAlign: "center",
                        navigationVAlign: "bottom",
                        navigationHOffset: 0,
                        navigationVOffset: 20,
                        soloArrowLeftHalign: "left",
                        soloArrowLeftValign: "center",
                        soloArrowLeftHOffset: 20,
                        soloArrowLeftVOffset: 0,
                        soloArrowRightHalign: "right",
                        soloArrowRightValign: "center",
                        soloArrowRightHOffset: 20,
                        soloArrowRightVOffset: 0,
                        shadow: 0,
                        fullWidth: "on",
                        fullScreen: "off",
                        lazyLoad: "on",
                        stopLoop: "off",
                        stopAfterLoops: -1,
                        stopAtSlide: -1,
                        shuffle: "off",
                        hideSliderAtLimit: 0,
                        hideCaptionAtLimit: 0,
                        hideAllCaptionAtLilmit: 0,
                        startWithSlide: 0,
                    });
                });
            </script>

        </div>
        <!-- End Home Slider -->

        <!-- Start Full Width Sections Content -->
        <div id="content" class="full-sections">

            <!-- Start Full Width Section 1 -->
            <div class="section" style="padding-top:60px; padding-bottom:30px; border-top:0; border-bottom:0;">
                <div class="container">
                    <div class="row">
                        <div class="text-center col-md-12">
<!--                            <div class="milestone-block">
                                <div class="milestone-icon"><i class="icon-list-bullet"></i></div>
                                <div class="milestone-right">
                                    <div class="milestone-number">22</div>
                                    <div class="milestone-text">jazyků</div>
                                </div>
                            </div>
                            <div class="milestone-block">
                                <div class="milestone-icon"><i class="icon-chat-3"></i></div>
                                <div class="milestone-right">
                                    <div class="milestone-number">31</div>
                                    <div class="milestone-text">témat</div>
                                </div>
                            </div>
-->                         <div class="milestone-block">
                                <div class="milestone-icon"><i class="icon-comment-4"></i></div>
                                <div class="milestone-right">
                                    <div class="milestone-number">770</div>
                                    <div class="milestone-text">unikátních slov</div>
                                </div>
                            </div>
                            <div class="milestone-block">
                                <div class="milestone-icon"><i class="icon-note-beamed"></i></div>
                                <div class="milestone-right">
                                    <div class="milestone-number">30</div>
                                    <div class="milestone-text">minut nahrávek</div>
                                </div>
                            </div>
                            <div class="milestone-block">
                                <div class="milestone-icon"><i class="icon-download-1"></i></div>
                                <div class="milestone-right">
                                    <div class="milestone-number">1188583</div>
                                    <div class="milestone-text">stažení</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="hr5" style="margin-top:30px; margin-bottom:30px;"></div>

                    <div class="big-title text-center animated fadeInDown delay-01" data-animation="fadeInDown" data-animation-delay="01">
                        <h1>Jazykový průvodce do celého světa</h1>
                    </div>

                    <div class="row">
                        <div class="col-md-12 service-box service-icon-left-more">
                            <div class="service-content">
                                <p>
                                    <span class="accent-color"><i class="icon-chat-1"></i></span> ins12
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 service-box service-icon-left-more">
                            <div class="service-content">
                                <p>
                                    <span class="accent-color"><i class="icon-globe-1"></i></span> ins13
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6 service-box service-icon-left-more">
                            <div class="service-content">
                                <p>
                                    <span class="accent-color"><i class="icon-flag-2"></i></span> ins14
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center col-md-12 service-box service-icon-left-more">
                            <a href="/vlastnosti-konverzace" class="btn-system btn-large">Vlastnosti</a>
                        </div>
                    </div>

                    <?php include("snippets/offer.html"); ?>
                    <!-- #include file = "snippets/offer.html" -->

                    <?php include("snippets/badge.html"); ?>
                    <!-- #include file = "snippets/badge.html" -->
                </div>
            </div>


        </div>
        <!-- End Full Width Sections Content -->

        <?php include("snippets/footer.html"); ?>
        <!-- #include file = "snippets/footer.html" -->

    </div>
    <!-- End Container -->

    <!-- Go To Top Link -->
    <a href="#" class="back-to-top"><i class="icon-up-open-1"></i></a>

    <div id="loader">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>

</body>

</html>';

?>