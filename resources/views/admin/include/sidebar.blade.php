<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
          <!-- nav bar -->
          <div class="w-100 mb-4 d-flex">
            <!-- <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
              <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="{{asset('admin/images/logo.svg')}}" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                  <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                  <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                  <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                </g>
              </svg>
            </a> -->

            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{url('/admin/client_management')}}" id="navbarDropdownMenuLink" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
                <img src="{{ asset('front/images/logo/Logo.png') }}" alt="..." class="avatar-img rounded-circle">
              </span>
            </a>
          </div>
          <ul class="navbar-nav nav-tabs flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="{{url('/admin/dashboard')}}" class="{{ (strpos(Route::current()->uri(),'admin/dashboard') !== false) ? 'nav-link active' : 'nav-link' }}"">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Dashboard</span>
              </a>
            </li>
          </ul>

          <ul class="navbar-nav flex-fill w-100 mb-2">
          <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/client_management') !== false) || (strpos(Route::current()->uri(),'admin/add_client') !== false) || (strpos(Route::current()->uri(),'admin/edit_client') !== false) ? 'nav-link active' : 'nav-link' }}"" href="{{url('/admin/client_management')}}">
              <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">Clients Management</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/cms_pages') !== false) || (strpos(Route::current()->uri(),'admin/add_cms') !== false) || (strpos(Route::current()->uri(),'admin/edit_cms_page') !== false) ? 'nav-link active' : 'nav-link' }}"" href="{{url('/admin/cms_pages')}}">
                <i class="fe fe-file fe-16"></i>
                <span class="ml-3 item-text">CMS Management</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/price_management') !== false) || (strpos(Route::current()->uri(),'admin/add_price') !== false) || (strpos(Route::current()->uri(),'admin/edit_price') !== false) ? 'nav-link active' : 'nav-link' }}"" href="{{url('/admin/price_management')}}">
                <i class="fe fe-file fe-16"></i>
                <span class="ml-3 item-text">Prices Management</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/categories_management') !== false) || (strpos(Route::current()->uri(),'admin/add_categories') !== false) || (strpos(Route::current()->uri(),'admin/edit_categories') !== false) ? 'nav-link active' : 'nav-link' }}" href="{{url('/admin/categories_management')}}">
              <i class="fe fe-folder fe-16"></i>
                <span class="ml-3 item-text">Categories Management</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/sub_categories_management') !== false) || (strpos(Route::current()->uri(),'admin/add_sub_categories') !== false) || (strpos(Route::current()->uri(),'admin/edit_sub_categories') !== false) ? 'nav-link active' : 'nav-link' }}"" href="{{url('/admin/sub_categories_management')}}">
              <i class="fe fe-folder fe-16"></i>
                <span class="ml-3 item-text">Sub Categories</span>
              </a>
            </li>

            <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/contract_management') !== false) || (strpos(Route::current()->uri(),'admin/add_contract') !== false) || (strpos(Route::current()->uri(),'admin/edit_contract') !== false) ? 'nav-link active' : 'nav-link' }}"" href="{{url('/admin/contract_management')}}">
              <i class="fe fe-folder fe-16"></i>
                <span class="ml-3 item-text">Contracts Management</span>
              </a>
            </li>

            <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/template_management') !== false) || (strpos(Route::current()->uri(),'admin/template/create') !== false) || (strpos(Route::current()->uri(),'admin/edit_template') !== false) ? 'nav-link active' : 'nav-link' }}"" href="{{url('/admin/template_management')}}">
                <i class="fe fe-credit-card fe-16"></i>
                <span class="ml-3 item-text">Templates Management</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/testimonial_management') !== false) || (strpos(Route::current()->uri(),'admin/add_testimonial') !== false) || (strpos(Route::current()->uri(),'admin/edit_testimonial') !== false) ? 'nav-link active' : 'nav-link' }}"" href="{{url('/admin/testimonial_management')}}">
                <i class="fe fe-file fe-16"></i>
                <span class="ml-3 item-text">Testimonials Management</span>
              </a>
            </li>

            <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/team_management') !== false) || (strpos(Route::current()->uri(),'admin/add_team') !== false) || (strpos(Route::current()->uri(),'admin/edit_team') !== false) ? 'nav-link active' : 'nav-link' }}"" href="{{url('/admin/team_management')}}">
              <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">Teams Management</span>
              </a>
            </li>

            <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/transaction_management') !== false) || (strpos(Route::current()->uri(),'admin/view_transaction') !== false) ? 'nav-link active' : 'nav-link' }}"" href="{{url('/admin/transaction_management')}}">
                <i class="fe fe-repeat fe-16"></i>
                <span class="ml-3 item-text">Transactions Management</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/frequently_questions') !== false) || (strpos(Route::current()->uri(),'admin/questions/create') !== false) || (strpos(Route::current()->uri(),'admin/edit_questions') !== false) ? 'nav-link active' : 'nav-link' }}"" href="{{url('/admin/frequently_questions')}}">
                <i class="fe fe-credit-card fe-16"></i>
                <span class="ml-3 item-text">Frequently Asked Questions</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/content_management') !== false) || (strpos(Route::current()->uri(),'admin/edit_content') !== false) ? 'nav-link active' : 'nav-link' }}"" href="{{url('/admin/content_management')}}">
                <i class="fe fe-credit-card fe-16"></i>
                <span class="ml-3 item-text">Contents Management</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/news_management') !== false) || (strpos(Route::current()->uri(),'admin/add_news') !== false) || (strpos(Route::current()->uri(),'admin/edit_news') !== false) ? 'nav-link active' : 'nav-link' }}"" href="{{url('/admin/news_management')}}">
                <i class="fe fe-credit-card fe-16"></i>
                <span class="ml-3 item-text">News Management</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="{{ (strpos(Route::current()->uri(),'admin/subs_management') !== false) || (strpos(Route::current()->uri(),'admin/add_subs') !== false) || (strpos(Route::current()->uri(),'admin/edit_subs') !== false) ? 'nav-link active' : 'nav-link' }}"" href="{{url('/admin/subs_management')}}">
                <i class="fe fe-credit-card fe-16"></i>
                <span class="ml-3 item-text">Subscribers Management</span>
              </a>
            </li>
            
          </ul>
        </nav>
      </aside>