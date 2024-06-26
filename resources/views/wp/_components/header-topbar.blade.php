<?php 
$user = auth()->user(); 
$notice_badge = get_user_notice_badge($user->id);
?>
                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline">
                            <li class="m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light" m-dropdown-toggle="click" id="m_quicksearch" m-quicksearch-mode="dropdown"
                             m-dropdown-persistent="1">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-icon">
                                        <i class="flaticon-search-1"></i>
                                    </span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                    <div class="m-dropdown__inner ">
                                        <div class="m-dropdown__header">
                                            <form class="m-list-search__form">
                                                <div class="m-list-search__form-wrapper">
                                                    <span class="m-list-search__form-input-wrapper">
                                                        <input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
                                                    </span>
                                                    <span class="m-list-search__form-icon-close" id="m_quicksearch_close">
                                                        <i class="la la-remove"></i>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-height="300" data-mobile-height="200">
                                                <div class="m-dropdown__content">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @include($_component.'header-topbar-notifications')
                            <li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"
                             m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
                                    <span class="m-nav__link-icon">
                                        <i class="flaticon-share"></i>
                                    </span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background: url({{asset('static/manager/assets/app/media/img/misc/quick_actions_bg.jpg')}}); background-size: cover;">
                                            <span class="m-dropdown__header-title">Quick Actions</span>
                                            <span class="m-dropdown__header-subtitle">Shortcuts</span>
                                        </div>
                                        <div class="m-dropdown__body m-dropdown__body--paddingless">
                                            <div class="m-dropdown__content">
                                                {{-- <div class="m-stack__item m-stack__item--center m-stack__item--middle p-4">
                                                    <span class="">All caught up!
                                                        <br>No new logs.</span>
                                                </div> --}}
                                                <div class="data" data="false" data-height="380" data-mobile-height="200">
                                                    <div class="m-nav-grid m-nav-grid--skin-light">
                                                        <div class="m-nav-grid__row">
                                                            <a href="" class="m-nav-grid__item">
                                                                <i class="m-nav-grid__icon flaticon-folder"></i>
                                                                <span class="m-nav-grid__text">Quản lý nôi dung</span>
                                                            </a>
                                                            <a href="" class="m-nav-grid__item">
                                                                <i class="m-nav-grid__icon flaticon-exclamation-2"></i>
                                                                <span class="m-nav-grid__text">Thông tin Website</span>
                                                            </a>
                                                        </div>
                                                        
                                                        <div class="m-nav-grid__row">
                                                            <a href="" class="m-nav-grid__item">
                                                                <i class="m-nav-grid__icon flaticon-file"></i>
                                                                <span class="m-nav-grid__text">Giao diện của tôi</span>
                                                            </a>
                                                            <a href="#" class="m-nav-grid__item">
                                                                <i class="m-nav-grid__icon flaticon-time"></i>
                                                                <span class="m-nav-grid__text">Đang thử nghiệm</span>
                                                            </a>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-topbar__userpic">
                                        <img src="{{$user->getAvatar()}}" class="m--img-rounded m--marginless" alt="" />
                                    </span>
                                    <span class="m-topbar__username m--hide">{{$user->name}}</span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background: url({{asset('static/manager/assets/app/media/img/misc/user_profile_bg.jpg')}}); background-size: cover;">
                                            <div class="m-card-user m-card-user--skin-dark">
                                                <div class="m-card-user__pic">
                                                    <img src="{{$user->getAvatar()}}" class="m--img-rounded m--marginless" alt="" />

                                                    <!-- <span class="m-type m-type--lg m--bg-danger"><span class="m--font-light">S<span><span> -->
                                                </div>
                                                <div class="m-card-user__details">
                                                    <span class="m-card-user__name m--font-weight-500">{{$user->name}}</span>
                                                    <a href="{{route('account.info')}}" class="m-card-user__email m--font-weight-300 m-link">{{$user->email}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
                                                    <li class="m-nav__section m--hide">
                                                        <span class="m-nav__section-text">Section</span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('account.info')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                            <span class="m-nav__link-title">
                                                                <span class="m-nav__link-wrap">
                                                                    <span class="m-nav__link-text">Tài khoản</span>
                                                                    <span class="m-nav__link-badge">
                                                                        <span class="m-badge m-badge--success">2</span>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit">
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('logout')}}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Đăng xuất</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li id="m_quick_sidebar_toggle" class="m-nav__item">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-icon">
                                        <i class="flaticon-grid-menu"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
