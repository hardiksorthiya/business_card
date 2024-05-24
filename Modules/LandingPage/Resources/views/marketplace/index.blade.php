@php
    use App\Models\Utility;
    $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
    $allSettings = Utility::settings();
    $logo = Utility::get_file('uploads/landing_page_image');

    $sup_logo = Utility::get_file('uploads/logo');
    $setting = \App\Models\Utility::colorset();
    $SITE_RTL = Utility::getValByName('SITE_RTL');

    $metatitle = isset($allSettings['meta_title']) ? $allSettings['meta_title'] : '';
    $metsdesc = isset($allSettings['meta_desc']) ? $allSettings['meta_desc'] : '';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($allSettings['meta_image']) ? $allSettings['meta_image'] : '';
    $admin_payment_setting = \App\Models\Utility::getAdminPaymentSetting();
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';

    if (isset($setting['color_flag']) && $setting['color_flag'] == 'true') {
        $themeColor = 'custom-color';
    } else {
        $themeColor = $color;
    }
    $category_path = \App\Models\Utility::get_file('category');
    $banner = \App\Models\Utility::get_file('card_banner');
    $logo = \App\Models\Utility::get_file('card_logo');
@endphp
<!DOCTYPE html>
{{-- <html lang="en"> --}}
<html lang="en" dir="{{ $setting['SITE_RTL'] == 'on' ? 'rtl' : '' }}">

<head>
    <style>
        :root {
            --color-customColor: <?=$color ?>;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/custom-color.css') }}">
    <title>{{ env('APP_NAME') }}</title>
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />

    <meta name="title" content="{{ $metatitle }}">
    <meta name="description" content="{{ $metsdesc }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:title" content="{{ $metatitle }}">
    <meta property="og:description" content="{{ $metsdesc }}">
    <meta property="og:image" content="{{ $meta_image . $meta_logo }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:title" content="{{ $metatitle }}">
    <meta property="twitter:description" content="{{ $metsdesc }}">
    <meta property="twitter:image" content="{{ $meta_image . $meta_logo }}">

    <!-- Favicon icon -->
    <link rel="icon" href="{{ $sup_logo . '/' . $allSettings['company_favicon'] }}" type="image/x-icon" />

    {{-- <link rel="icon" href="{{ $logo . '/favicon.png' }}" type="image/png"> --}}


    <!-- font css -->
    <link rel="stylesheet" href=" {{ Module::asset('LandingPage:Resources/assets/fonts/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href=" {{ Module::asset('LandingPage:Resources/assets/fonts/feather.css') }}" />
    <link rel="stylesheet" href="  {{ Module::asset('LandingPage:Resources/assets/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/fonts/material.css') }}" />



    <!-- vendor css -->
    <link rel="stylesheet" href="  {{ Module::asset('LandingPage:Resources/assets/css/style.css') }}" />
    <link rel="stylesheet" href=" {{ Module::asset('LandingPage:Resources/assets/css/customizer.css') }}" />
    <link rel="stylesheet" href=" {{ Module::asset('LandingPage:Resources/assets/css/landing-page.css') }}" />
    <link rel="stylesheet" href=" {{ Module::asset('LandingPage:Resources/assets/css/marketplace.css') }}" />
    <link rel="stylesheet" href=" {{ Module::asset('LandingPage:Resources/assets/css/custom.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">


    @if ($SITE_RTL == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    @endif

    @if ($setting['cust_darklayout'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
    @else
        <link rel="stylesheet" href="{{ Module::asset('LandingPage:Resources/assets/css/style.css') }}"
            id="main-style-link">
    @endif
    @if ($setting['cust_darklayout'] == 'on')

<body class="{{ $themeColor }} landing-dark">
@else

    <body class="{{ $themeColor }}">
        @endif
        </head>

        <body class="theme-2">
            <div class="site-content">
                <div class="dash-landing-wrapper">
                    <section class="bg-dark-green product-banner-section vcardgo-addon-banner">
                        <div class=" container  ">
                            <div class="row ">
                                <div class="col-md-6 col-12">
                                    <nav class="woocommerce-breadcrumb" aria-label="breadcrumbs">
                                        <a href="{{route('landingpage.backhome')}}">Home</a><span
                                            class="breadcrumb-separator"> <small> &gt; </small>
                                        </span>vCardGo Marketplace
                                    </nav>
                                    <div class="title-content-inner dash-banner-title">
                                        <div class="section-title ">
                                            <h1>
                                                Discover<span class="font-dash"> New Categories, </span>with <br>
                                                vCardGo -<span class="vcard-banner-content"> Browse Beyond Limits!
                                            </h1>
                                        </div>
                                        <form role="search" method="get" class="search-form" id="product_search"
                                            action="{{ route('business.search') }}">
                                            <div class="search_box search-box">
                                                <input type="hidden" name="post_type" value="product">
                                                <input type="search" class="search-field"
                                                    placeholder="Search for any Business..."
                                                    value="{{ isset($_GET['search-business']) ? $_GET['search-business'] : '' }}"
                                                    name="search-business">
                                                @if (isset($_GET['search-business']) && $_GET['search-business'] != '')
                                                    <a href="{{ route('marketplace.home') }}"><i
                                                            class="ti ti-refresh text-black"></i></a>
                                                @endif

                                                <button type="submit" class="btn search-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                        height="18" viewBox="0 0 18 18" fill="none">
                                                        <g clip-path="url(#clip0_1709_2846)">
                                                            <path
                                                                d="M17.8296 17.0207L13.1823 12.4477C14.3992 11.1255 15.147 9.37682 15.147 7.45261C15.1464 3.33639 11.756 0 7.57339 0C3.39078 0 0.000366211 3.33639 0.000366211 7.45261C0.000366211 11.5688 3.39078 14.9052 7.57339 14.9052C9.38057 14.9052 11.0381 14.2802 12.34 13.241L17.0054 17.832C17.2327 18.056 17.6017 18.056 17.829 17.832C18.0569 17.6081 18.0569 17.2447 17.8296 17.0207ZM7.57339 13.7586C4.03445 13.7586 1.16558 10.9353 1.16558 7.45261C1.16558 3.96991 4.03445 1.14663 7.57339 1.14663C11.1124 1.14663 13.9812 3.96991 13.9812 7.45261C13.9812 10.9353 11.1124 13.7586 7.57339 13.7586Z"
                                                                fill="white" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_1709_2846">
                                                                <rect width="18" height="18" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    <span>{{ __('Search') }}</span>
                                                </button>

                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="img-wrapper ">
                                        <img src="{{ asset('custom/img/banner-round.png') }}" alt="banner-image"
                                            loading="lazy" width="100%" height="100% ">
                                    </div>
                                </div>
                            </div>
                            <img src="https://workdo.io/wp-content/themes/storefront-child/assets/images/bookinggo-saas-addon/banner-bg-image.png"
                                alt="banner-bg-image" loading="lazy" class="vcard-banner-bg">
                        </div>
                    </section>
                    <section class="directory-category-section">
                        <div class="container">
                            <div class="section-title text-center">
                                <h2>{{ __('Top Categories') }}</h2>
                                <p>{{ __('Discover a diverse range of top categories on vCardgo.Find evenything you need in one convenient place.') }}
                                </p>
                            </div>
                            <div class="swiper category-slider">
                                <div class="swiper-wrapper">
                                    @foreach ($categoryData as $key => $category)
                                        <div class="swiper-slide">
                                            <div class="category-body-div">
                                                <div class="category-logo">
                                                    <div class="cat-img">
                                                        <div class="cat-img-div-main">
                                                            <div class="cat-img-div">
                                                                <?php
                                                                $imagePath = $category_path . '/' . $category->logo;
                                                                $headers = @get_headers($imagePath);
                                                                ?>
                                                                @if ($headers && strpos($headers[0], '200'))
                                                                    <img src="{{ !empty($category->logo) ? $category_path . '/' . $category->logo : asset('custom/img/placeholder-image21.jpg') }}"
                                                                        class="rounded-circle img_categorys_fix_size"
                                                                        width="100px" height="100px">
                                                                @else
                                                                    <img class="rounded"
                                                                        src="{{ asset('custom/category/category' . $key + 1 . '.png') }}"
                                                                        alt="" width="100px" height="100px">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="category-name">
                                                    <h6>{{ $category->name }}</h6>
                                                    <span>{{ $category->count . ' Business' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                {{-- .tab   - --}}
                                <div class="tab-btn-wrapper">
                                    <div class="swiper-button-prev">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="16"
                                            viewBox="0 0 64 16" fill="none">
                                            <path
                                                d="M0.383912 8.70711C-0.0066124 8.31658 -0.0066124 7.68342 0.383912 7.29289L6.74787 0.928932C7.1384 0.538408 7.77156 0.538408 8.16209 0.928932C8.55261 1.31946 8.55261 1.95262 8.16209 2.34315L2.50523 8L8.16209 13.6569C8.55261 14.0474 8.55261 14.6805 8.16209 15.0711C7.77156 15.4616 7.1384 15.4616 6.74787 15.0711L0.383912 8.70711ZM63.2734 9H1.09102V7H63.2734V9Z"
                                                fill="white"></path>
                                        </svg>
                                    </div>
                                    <div class="swiper-button-next">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="16"
                                            viewBox="0 0 64 16" fill="none">
                                            <path
                                                d="M63.7059 8.70711C64.0965 8.31658 64.0965 7.68342 63.7059 7.29289L57.342 0.928932C56.9514 0.538408 56.3183 0.538408 55.9278 0.928932C55.5372 1.31946 55.5372 1.95262 55.9278 2.34315L61.5846 8L55.9278 13.6569C55.5372 14.0474 55.5372 14.6805 55.9278 15.0711C56.3183 15.4616 56.9514 15.4616 57.342 15.0711L63.7059 8.70711ZM0.816406 9H62.9988V7H0.816406V9Z"
                                                fill="white"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="directory-discover-section">
                        <div class="container">
                            <div class="section-title text-center">
                                <h2>{{ __('Discover Business') }}</h2>
                                <p>{{ __('Dive into vCardGo`s extensive array of categories, covering everything from essential services to leisure activities. Explore and discover the perfect solutions for all your needs in one convenient platform.') }}
                                </p>
                            </div>
                            <div class="row business-main">
                                @foreach ($businessDetail as $key => $business)
                                    <div class="col-xl-3 col-lg-4  col-sm-6 col-12 d-flex">
                                        <div class="product-card d-flex">
                                            <div class="product-card-inner">
                                                <div class="feature-img">
                                                    <img src="{{ isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/img/placeholder-image1.jpg') }}"
                                                        alt="images" class=" imagepreview home-banner"
                                                        id="banner">
                                                </div>

                                                <div class="product-content">
                                                    <div class="product-content-top">
                                                        <div class="business-logo-two">
                                                            <img src="{{ isset($business->logo) && !empty($business->logo) ? $logo . '/' . $business->logo : asset('custom/img/placeholder-image1.jpg') }}"
                                                                alt="images" class="imagepreview" id="banner">
                                                        </div>

                                                        <a href="javascript:void(0);" tabindex="0">
                                                            <h5>{{ ucFirst($business->title) }}</h5>
                                                        </a>
                                                        <p>{{ !empty($business->description) ? ucFirst($business->description) : '--' }}
                                                        </p>
                                                    </div>
                                                    <div class="product-content-bottom">
                                                        <!-- Your rating content here -->

                                                        <div class="card-bottom d-flex align-items-center">
                                                            <a href="{{ route('bussiness.save', $business->slug) }}"
                                                                page-name="Listing Page" class=" btn-vcf btn">
                                                                <svg width="18" height="16"
                                                                    viewBox="0 0 18 16" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M17.25 13.5V10.75C17.25 10.5677 17.1776 10.3928 17.0486 10.2639C16.9197 10.1349 16.7448 10.0625 16.5625 10.0625C16.3802 10.0625 16.2053 10.1349 16.0764 10.2639C15.9474 10.3928 15.875 10.5677 15.875 10.75V13.5C15.875 13.6823 15.8026 13.8572 15.6736 13.9861C15.5447 14.1151 15.3698 14.1875 15.1875 14.1875H2.8125C2.63016 14.1875 2.4553 14.1151 2.32636 13.9861C2.19743 13.8572 2.125 13.6823 2.125 13.5V10.75C2.125 10.5677 2.05257 10.3928 1.92364 10.2639C1.7947 10.1349 1.61984 10.0625 1.4375 10.0625C1.25516 10.0625 1.0803 10.1349 0.951364 10.2639C0.822433 10.3928 0.75 10.5677 0.75 10.75V13.5C0.75 14.047 0.967299 14.5716 1.35409 14.9584C1.74089 15.3452 2.26549 15.5625 2.8125 15.5625H15.1875C15.7345 15.5625 16.2591 15.3452 16.6459 14.9584C17.0327 14.5716 17.25 14.047 17.25 13.5ZM12.8638 9.91125L9.42625 12.6613C9.30487 12.7572 9.1547 12.8093 9 12.8093C8.8453 12.8093 8.69513 12.7572 8.57375 12.6613L5.13625 9.91125C5.011 9.79302 4.93469 9.63209 4.92241 9.46029C4.91014 9.28849 4.9628 9.11834 5.06998 8.98351C5.17715 8.84867 5.33103 8.75898 5.50117 8.73218C5.67131 8.70537 5.84531 8.7434 5.98875 8.83875L8.3125 10.695V1.125C8.3125 0.942664 8.38493 0.767795 8.51386 0.638864C8.6428 0.509933 8.81766 0.4375 9 0.4375C9.18234 0.4375 9.35721 0.509933 9.48614 0.638864C9.61507 0.767795 9.6875 0.942664 9.6875 1.125V10.695L12.0112 8.83875C12.0805 8.7734 12.1625 8.72314 12.2522 8.69116C12.3419 8.65918 12.4372 8.64616 12.5322 8.65295C12.6271 8.65973 12.7196 8.68616 12.8038 8.73057C12.888 8.77497 12.9621 8.83638 13.0214 8.91091C13.0806 8.98543 13.1237 9.07145 13.148 9.16351C13.1722 9.25557 13.1771 9.35166 13.1623 9.4457C13.1475 9.53974 13.1133 9.62968 13.0619 9.70982C13.0105 9.78996 12.943 9.85855 12.8638 9.91125Z"
                                                                        fill="white" />
                                                                </svg>
                                                            </a>
                                                            <a href="{{ url('/' . $business->slug) }}"
                                                                page-name="Listing Page" target="_blank"
                                                                class=" btn-preview btn">
                                                                Open Business
                                                            </a>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            {{-- <footer class="site-footer bg-gray-100">
                <div class="container">
                    <div class="footer-row">
                        <div class="ftr-col cmp-detail">
                            <div class="footer-logo mb-3">
                                <a href="#">
                                    <img src="{{ $logo . '/' . $settings['site_logo'] }}" alt="logo"
                                        style="filter: drop-shadow(2px 3px 7px #011C4B);">
                                </a>
                            </div>
                            <p>
                                {!! $settings['site_description'] !!}
                            </p>

                        </div>
                        <div class="ftr-col">
                            <ul class="list-unstyled">

                                @if (is_array(json_decode($settings['menubar_page'])) || is_object(json_decode($settings['menubar_page'])))
                                    @foreach (json_decode($settings['menubar_page']) as $key => $value)
                                        @if ($value->page_url != null && $value->footer == 'on' && $value->header == 'off')
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url($value->page_url) }}"
                                                    target="_blank">{{ $value->menubar_page_name }}</a>
                                            </li>
                                        @endif
                                        @if ($value->footer == 'on' && $value->header == 'off' && $value->page_url == null)
                                            <li><a
                                                    href="{{ route('custom.page', $value->page_slug) }}">{!! $value->menubar_page_name !!}</a>
                                            </li>
                                        @endif
                                        @if ($value->page_url != null && $value->footer == 'on' && $value->header == 'on')
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url($value->page_url) }}"
                                                    target="_blank">{{ $value->menubar_page_name }}</a>
                                            </li>
                                        @endif
                                        @if ($value->footer == 'on' && $value->header == 'on' && $value->page_url == null)
                                            <li><a
                                                    href="{{ route('custom.page', $value->page_slug) }}">{!! $value->menubar_page_name !!}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="ftr-col">
                            <ul class="list-unstyled">
                                @if (is_array(json_decode($settings['menubar_page'])) || is_object(json_decode($settings['menubar_page'])))
                                    @foreach (json_decode($settings['menubar_page']) as $key => $value)
                                        @if ($value->page_url != null && $value->header == 'on' && $value->footer == 'off')
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url($value->page_url) }}"
                                                    target="_blank">{{ $value->menubar_page_name }}</a>
                                            </li>
                                        @endif
                                        @if ($value->header == 'on' && $value->footer == 'off' && $value->page_url == null)
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('custom.page', $value->page_slug) }}">{{ $value->menubar_page_name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif


                            </ul>
                        </div>
                        @if ($settings['joinus_status'] == 'on')
                            <div class="ftr-col ftr-subscribe">
                                <h2>{!! $settings['joinus_heading'] !!}</h2>
                                <p>{!! $settings['joinus_description'] !!}</p>
                                <form method="post" action="{{ route('join_us_store') }}">
                                    @csrf
                                    <div class="input-wrapper border border-dark">
                                        <input type="text" name="email"
                                            placeholder="Type your email address...">
                                        <button type="submit"
                                            class="btn btn-dark rounded-pill">{{ __('Join Us!') }}</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="border-top border-dark text-center p-2">
                    <p class="mb-0"> &copy;
                        {{ date('Y') }}
                        {{ App\Models\Utility::getValByName('footer_text') ? App\Models\Utility::getValByName('footer_text') : config('app.name', 'Salesy Saas') }}
                    </p>


                </div>
            </footer> --}}
            <!-- [ Footer ] end -->
            <!-- Required Js -->


            <script src="{{ Module::asset('LandingPage:Resources/assets/js/plugins/popper.min.js') }}"></script>
            <script src="{{ Module::asset('LandingPage:Resources/assets/js/plugins/bootstrap.min.js') }}"></script>
            <script src="{{ Module::asset('LandingPage:Resources/assets/js/plugins/feather.min.js') }}"></script>
            <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

            <script>
                // Start [ Menu hide/show on scroll ]
                let ost = 0;
                document.addEventListener("scroll", function() {
                    let cOst = document.documentElement.scrollTop;
                    if (cOst == 0) {
                        document.querySelector(".navbar").classList.add("top-nav-collapse");
                    } else if (cOst > ost) {
                        document.querySelector(".navbar").classList.add("top-nav-collapse");
                        document.querySelector(".navbar").classList.remove("default");
                    } else {
                        document.querySelector(".navbar").classList.add("default");
                        document
                            .querySelector(".navbar")
                            .classList.remove("top-nav-collapse");
                    }
                    ost = cOst;
                });
                // End [ Menu hide/show on scroll ]

                var scrollSpy = new bootstrap.ScrollSpy(document.body, {
                    target: "#navbar-example",
                });
                feather.replace();
                var swiper = new Swiper('.category-slider', {
                    // Optional parameters
                    spaceBetween: 20,
                    loop: true,
                    mousewheel: false,
                    keyboard: {
                        enabled: true
                    },
                    breakpoints: {
                        1440: {
                            slidesPerView: 9,
                        },
                        1199: {
                            slidesPerView: 7,
                        },
                        991: {
                            slidesPerView: 5,
                        },
                        768: {
                            slidesPerView: 4,
                        },
                        575: {
                            slidesPerView: 3,
                        },
                        0: {
                            slidesPerView: 1,
                        }
                    },

                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev"
                    },
                });
            </script>
            @if ($allSettings['enable_cookie'] == 'on')
                @include('layouts.cookie_consent')
            @endif

        </body>

</html>
