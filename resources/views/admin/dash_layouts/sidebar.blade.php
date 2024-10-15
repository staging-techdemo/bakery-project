<div class="side-bar" id="sideBar">
    <a href="javascript:void(0)" class="sideBar__close" onclick="closeSideBar()">×</a>
    <div class="side-bar-logo">

        <a href="{{ route('admin.dashboard') }}"><img
                src="{{ asset($logo->img_path ?? 'admin/images/placeholder-logo.png') }}" alt="logo"
                class="img-fluid"></a>

    </div>
    <div class="side-bar-links">
        <ul class="navigation-list">

            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home" aria-hidden="true"></i> Dashboard
                </a>
            </li>
            <li><a href="{{ route('admin.users_listing') }}">
                    <i class="fa fa-users" aria-hidden="true"></i> Users Management
                </a>
            </li>
            {{-- <li><a href="{{ route('admin.services_listing') }}">
                    <i class="fa fa-cog" aria-hidden="true"></i> Services Management
                </a>
            </li> --}}

            <li><a href="{{ route('admin.inquiries_listing') }}">
                    <i class="fa fa-comment" aria-hidden="true"></i> inquiry Management
                </a>
            </li>
            {{-- <li><a href="{{ route('admin.reviews_listing') }}">
                    <i class="fa fa-comments" aria-hidden="true"></i> Review Management
                </a>
            </li> --}}
            {{-- <li><a href="{{ route('admin.template_listing') }}">
                <i class="fa fa-window-maximize" aria-hidden="true"></i> Template Management
            </a>
        </li> --}}
        {{-- <li><a href="{{ route('admin.quotes_listing') }}">
            <i class="fa fa-money" aria-hidden="true"></i> Qoute Request Management
        </a>
    </li> --}}
    <li><a href="{{ route('admin.testimonial_listing') }}">
            <i class="fa fa-comments" aria-hidden="true"></i> Testimonials Management
        </a>
    </li>

            <li><a href="{{ route('admin.orders_listing') }}">
                <i class="fa fa-pencil-square" aria-hidden="true"></i> Orders Management
            </a>
        </li>

            {{-- <li><a href="{{ route('admin.planning_listing') }}">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Planning Tip Management
                </a>
            </li> --}}
            <li><a href="{{ route('admin.newsletter_listing') }}">
                    <i class="fa fa-envelope" aria-hidden="true"></i> Newsletter
                </a>
            </li>

            {{-- <li><a href="{{ route('admin.gallery_listing') }}">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>Product Gallery
                </a>
            </li> --}}

            {{-- <li><a href="{{ route('admin.faq_listing') }}">
                    <i class="fa fa-comment" aria-hidden="true"></i> Faqs
                </a>
            </li> --}}

            <li><a href="{{ route('admin.invoice_listing') }}">
                <i class="fa fa-file-text" aria-hidden="true"></i> Invoice Generator
            </a>
        </li>


            {{-- <li><a href="{{ route('admin.party_listing') }}">
                    <i class="fa fa-gift" aria-hidden="true"></i> Party Packages Management
                </a>
            </li> --}}
            <li
                class="custom-dropdown {{ in_array(Request::url(), [route('admin.products_listing'), route('admin.product_category_listing')]) ? 'open' : '' }}">
                <a href="javascript:void(0)" class="custom-dropdown__active">
                    <i class="fa fa-list-alt" aria-hidden="true"></i> Inventory Management
                </a>
                <div class="custom-dropdown__values">
                    <ul class="values-wrapper">
                        <li><a class="{{ Request::url() == route('admin.products_listing') ? 'active' : '' }}"
                                href="{{ route('admin.products_listing') }}">Products</a></li>
                        <li><a class="{{ Request::url() == route('admin.product_category_listing') ? 'active' : '' }}"
                                href="{{ route('admin.product_category_listing') }}">Products Categories</a></li>
                        <li><a class="{{ Request::url() == route('admin.subcategory_listing') ? 'active' : '' }}"
                                href="{{ route('admin.subcategory_listing') }}">Products Sub Categories</a></li>
                    </ul>
                </div>
            </li>


            {{-- <li><a href="{{ route('admin.contest_listing') }}">
                    <i class="fa fa-trophy" aria-hidden="true"></i> Contest Management
                </a>
            </li>

            <li><a href="{{ route('admin.participant_listing') }}">
                <i class="fa fa-users" aria-hidden="true"></i> Participants Management
            </a>
        </li> --}}
            <li
                class="custom-dropdown {{ in_array(Request::url(), [route('admin.blog_listing'), route('admin.blog_category_listing')]) ? 'open' : '' }}">
                <a href="javascript:void(0)" class="custom-dropdown__active">
                    <i class="fa fa-cog" aria-hidden="true"></i> Blogs Management
                </a>
                <div class="custom-dropdown__values">
                    <ul class="values-wrapper">
                        <li><a class="{{ Request::url() == route('admin.blog_listing') ? 'active' : '' }}"
                                href="{{ route('admin.blog_listing') }}">Blogs</a></li>
                        <li><a class="{{ Request::url() == route('admin.blog_category_listing') ? 'active' : '' }}"
                                href="{{ route('admin.blog_category_listing') }}">Blogs Categories</a></li>
                    </ul>
                </div>
            </li>
            {{-- <li><a href="{{ route('admin.packages_listing') }}">
                    <i class="fa fa-file-text" aria-hidden="true"></i> Packages Management
                </a>
            </li> --}}



            <li
                class="custom-dropdown {{ in_array(Request::url(), [
                    route('admin.showLogo'),
                    route('admin.welcomeSlider'),
                    route('admin.homeSlider'),
                    route('admin.socialInfo'),
                ])
                    ? 'open'
                    : '' }}">
                <a href="javascript:void(0)" class="custom-dropdown__active">
                    <i class="fa fa-cog" aria-hidden="true"></i> Site Settings
                </a>
                <div class="custom-dropdown__values">
                    <ul class="values-wrapper">
                        <li><a class="{{ Request::url() == route('admin.showLogo') ? 'active' : '' }}"
                                href="{{ route('admin.showLogo') }}">Logo Management</a></li>
                        <li><a class="{{ Request::url() == route('admin.welcomeSlider') ? 'active' : '' }}"
                                href="{{ route('admin.welcomeSlider') }}">Welcome Slider</a></li>
                        {{-- <li><a class="{{ Request::url() == route('admin.homeSlider') ? 'active' : '' }}"
                                href="{{ route('admin.homeSlider') }}">Banners Management</a></li> --}}
                        <li><a class="{{ Request::url() == route('admin.socialInfo') ? 'active' : '' }}"
                                href="{{ route('admin.socialInfo') }}">Contact / Social Info</a></li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
