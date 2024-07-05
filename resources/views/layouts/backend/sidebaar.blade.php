<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
  <div>
    <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="{{asset('backend/assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{asset('backend/assets/images/logo/logo_dark.png')}}" alt=""></a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{asset('backend/assets/images/logo/logo-icon.png')}}" alt=""></a></div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn"><a href="index.html"><img class="img-fluid" src="{{asset('backend/assets/images/logo/logo-icon.png')}}" alt=""></a>
            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
          </li>

          <li class="sidebar-main-title">
            <div>
              <h6 class="lan-1">General</h6>
            </div>
          </li>

          <!-- Dashboard  -->
          @php
          $dashboard_style = '';
          $dashboard_arr = ['dashboard'];
          $current_route = Route::current()->getName();
          if (in_array($current_route, $dashboard_arr)) {
          $dashboard_style = 'active';
          }
          @endphp


          <li class="sidebar-list"><i class=""></i>
            <label class="badge badge-light-primary"></label><a class="sidebar-link {{$dashboard_style}}" href="{{ route('dashboard') }}">
              <svg class="stroke-icon">
                <use href="{{asset('backend/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
              </svg>
              </svg><span class="">Dashboard</span></a>
          </li>

          @php
          $users_style = '';
          $users_arr = ['users.index', 'users.create', 'users.edit', 'users.show'];
          if (in_array(Route::current()->getName(), $users_arr)) {
          $users_style = 'active';
          }
          @endphp

          <li class="sidebar-list"><i class=""></i>
            <label class="badge badge-light-primary"></label><a class="sidebar-link {{$users_style}}" href="{{ route('users.index') }}">
              <svg class="stroke-icon">
                <use href="{{asset('backend/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
              </svg>
              </svg><span class="">Users</span></a>
          </li>


          @php
          $products_style = '';
          $products_arr = ['products.index', 'products.create', 'products.edit', 'products.show'];
          if (in_array(Route::current()->getName(), $products_arr)) {
          $products_style = 'active';
          }
          @endphp

          <li class="sidebar-list"><i class=""></i>
            <label class="badge badge-light-primary"></label><a class="sidebar-link {{$products_style}}" href="{{ route('products.index') }}">
              <svg class="stroke-icon">
                <use href="{{asset('backend/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
              </svg>
              </svg><span class="">Products</span></a>
          </li>

          <!-- Categories -->

          @php
          $categories_style = '';
          $categories_arr = ['categories.index', 'categories.create', 'categories.edit', 'categories.show'];
          if (in_array(Route::current()->getName(), $categories_arr)) {
          $categories_style = 'active';
          }
          @endphp

          <li class="sidebar-list"><i class=""></i>
            <label class="badge badge-light-primary"></label><a class="sidebar-link {{$categories_style}}" href="{{ route('categories.index') }}">
              <svg class="stroke-icon">
                <use href="{{asset('backend/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
              </svg>
              </svg><span class="">Categories</span></a>
          </li>

          <!-- SubCategories -->

          @php
          $sub_categories_style = '';
          $sub_categories_arr = ['sub-categories.index', 'sub-categories.create', 'sub-categories.edit', 'sub-categories.show'];
          if (in_array(Route::current()->getName(), $sub_categories_arr)) {
          $sub_categories_style = 'active';
          }
          @endphp

          <li class="sidebar-list"><i class=""></i>
            <label class="badge badge-light-primary"></label><a class="sidebar-link {{$sub_categories_style}}" href="{{ route('sub-categories.index') }}">
              <svg class="stroke-icon">
                <use href="{{asset('backend/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
              </svg>
              </svg><span class="">SubCategories</span></a>
          </li>

          <!-- setting -->

          @php
          $settings_style = '';
          $settings_arr = ['settings.index', 'settings.create', 'settings.edit', 'settings.show'];
          if (in_array(Route::current()->getName(), $settings_arr)) {
          $settings_style = 'active';
          }
          @endphp

          <li class="sidebar-list"><i class=""></i>
            <label class="badge badge-light-primary"></label><a class="sidebar-link {{$settings_style}}" href="{{ route('settings.index') }}">
              <svg class="stroke-icon">
                <use href="{{asset('backend/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
              </svg>
              </svg><span class="">Settings</span></a>
          </li>


          <!-- CMS pages -->

          @php
          $cms_style = '';
          $cms_arr = ['cms.index', 'cms.create', 'cms.edit', 'cms.show'];
          if (in_array(Route::current()->getName(), $cms_arr)) {
          $cms_style = 'active';
          }
          @endphp

          <li class="sidebar-list"><i class=""></i>
            <label class="badge badge-light-primary"></label><a class="sidebar-link {{$cms_style}}" href="{{ route('cms.index') }}">
              <svg class="stroke-icon">
                <use href="{{asset('backend/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
              </svg>
              </svg><span class="">CMS</span></a>
          </li>


      </div>
    </nav>
  </div>
</div>