@can('access_by_admin')

@can('manage_orders')
<div class="nav-item @if(request()->get('type') == 'Service') {{ activeClassIfRoutes(['panel.orders.index','panel.orders.show','panel.orders.invoice']) }} @endif">
    <a href="{{route('panel.orders.index',['payment_status' => App\Models\Order::PAYMENT_STATUS_PAID, 'type' => 'Service'])}}" class="a-item" ><i class="ik ik-shopping-cart"></i><span>{{ __('Service Orders')}}</span></a>
</div>
<div class="nav-item @if(request()->get('type') == 'Lead') {{ activeClassIfRoutes(['panel.orders.index'])  }} @endif">
    <a href="{{route('panel.orders.index',['type' => 'Lead'])}}" class="a-item" ><i class="ik ik-shopping-bag"></i><span>{{ __('Lead Orders')}}</span></a>
</div>
<div class="nav-item {{ activeClassIfRoutes(['panel.services.index','panel.services.show','panel.services.invoice'], 'active')  }}">
    <a href="{{route('panel.services.index')}}" class="a-item" ><i class="ik ik-layers"></i><span>{{ __('Services')}}</span></a>
</div>
<div class="nav-item {{ ($segment2 == 'requirements') ? 'active' : '' }}">
    <a href="{{ route('panel.requirements.index')}}" class="a-item" ><i class="ik ik-book"></i><span>Requirements</span></a>
</div>
@endcan
    @can('manage_administrator')
        <div class="nav-item {{ activeClassIfRoutes(['panel.users.index','panel.users.show', 'panel.users.create', 'panel.user_log.index','panel.roles','panel.permission', 'panel.users.balance'], 'active open') }} has-sub">
            <a href="#"><i class="ik ik-users"></i><span>{{ __('Adminstrator')}}</span></a>
            <div class="submenu-content">
                <!-- only those have manage_user permission will get access -->
              @php
                  $roles = Spatie\Permission\Models\Role::whereNotIn('id',[1])->pluck('name');
              @endphp
                @foreach ($roles as $role)
                    <a href="{{route('panel.users.index')}}?role={{$role}}" class="menu-item a-item @if(request()->has('role') && request()->get('role') == $role) active @endif">{{ $role }} Management</a>
                @endforeach

               
                @can('create_user')
                <a href="{{route('panel.users.create')}}" class="menu-item a-item {{ activeClassIfRoute('panel.users.create', 'active')  }}">{{ __('Add User')}}</a>
                @endcan
                {{-- @can('transactions')
                    <a href="{{route('panel.users.balance')}}" class="menu-item a-item {{ activeClassIfRoute('panel.users.balance', 'active')  }}">{{ __('Transactions')}}</a>
                @endcan --}}

                <!-- only those have manage_role permission will get access -->
                {{-- @can('manage_role')
                    <a href="{{routpartneadme('panel.roles')}}" class="menu-item a-item {{ activeClassIfRoute('panel.roles' ,'active')  }}">{{ __('Roles')}}</a>
                @endcan
                <!-- only those have manage_permission permission will get access -->
                @can('manage_permission')
                    <a href="{{route('panel.permission')}}" class="menu-item a-item {{ activeClassIfRoute('panel.permission', 'active')  }}">{{ __('Permission')}}</a>
                @endcan --}}
                
            </div>
        </div>
    @endcan   
   
     
    <div class="nav-item {{ activeClassIfRoutes(['panel.partner.account.statement'], 'active open')  }} has-sub">
        <a href="#"><i class="ik ik-pie-chart"></i><span>{{ __('Report')}}</span></a>
        <div class="submenu-content">
            <a href="{{ route('panel.partner.account.statement')}}" class="menu-item a-item" >
                <span>Account Statement</span>
            </a>
            {{-- <div class="nav-item {{ ($segment2 == 'user-advisories') ? 'active' : '' }}"> --}}
                <a href="{{ route('panel.user_advisories.index')}}" class="menu-item a-item" >
                    <span>User Advisory</span>
                </a>
            {{-- </div> --}}
            <a href="{{ route('panel.affiliate-items.index')}}" class="menu-item a-item" >
                <span>Affiliate Items</span>
            </a>

            <a href="{{ route('panel.users.balance')}}" class="menu-item a-item" >
                <span>Transactions</span>
            </a>
        </div>
    </div>

    {{-- @can('manage_manage')
    <div class="nav-item {{ activeClassIfRoutes(['panel.payouts.index','panel.payouts.show','panel.orders.invoice','panel.orders.create' ], 'active open')  }} has-sub">
        <a href="#"><i class="ik ik-layers"></i><span>{{ __('Manage')}}</span></a>
        <div class="submenu-content">
            <a href="{{route('panel.payouts.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['panel.payouts.index', 'panel.payouts.edit'], 'active')  }}">{{ __('Payouts')}}</a>
            
        </div>
    </div>
    @endcan --}}
    
    
    {{-- <div class="nav-item {{ ($segment2 == 'affiliate-items') ? 'active' : '' }}">
        <a href="{{ route('panel.affiliate-items.index')}}" class="a-item" ><i class="ik ik-airplay"></i><span>Affiliate Items</span></a>
    </div> --}}
    @can('manage_resources')
    <div class="nav-item {{ activeClassIfRoutes(['panel.admin.lead.index','panel.admin.lead.create','panel.admin.lead.edit','panel.admin.lead.show','panel.constant_management.user_enquiry.index', 'panel.constant_management.user_enquiry.create','backend/constant-management.news_letters.index','backend/constant-management.news_letters.create','panel.constant_management.support_ticket.index' , 'panel.constant_management.support_ticket.show','backend/constant-management.news_letters.edit'], 'active open')  }} has-sub">
            <a href="#"><i class="ik ik-mail"></i><span>{{ __('Contacts / Enquiry')}}</span></a>
            <div class="submenu-content">
                @can('manage_user_enquiry')
                    <a href="{{route('panel.constant_management.user_enquiry.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['panel.constant_management.user_enquiry.index', 'panel.constant_management.user_enquiry.create','panel.constant_management.user_enquiry.edit'], 'active')  }}">{{ __('Website Enquiry')}}</a>
                @endcan
                @can('manage_support_ticket')
                    <a href="{{route('panel.constant_management.support_ticket.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['panel.constant_management.support_ticket.index', 'panel.constant_management.support_ticket.show'], 'active')  }}">{{ __('Support Tickets')}}</a>
                @endcan

                {{-- @can('manage_newsletter')
                    <a href="{{ route('backend/constant-management.news_letters.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['backend/constant-management.news_letters.index', 'backend/constant-management.news_letters.create','backend/constant-management.news_letters.edit'], 'active')  }}">{{ __('Newsletter')}}</a>
                @endcan

                @can('manage_leads')
                    <a href="{{route('panel.admin.lead.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['panel.admin.lead.index', 'panel.admin.lead.create','panel.admin.lead.edit','panel.admin.lead.show'], 'active')  }}">{{ __('Leads')}}</a>
                @endcan --}}

            </div>
    </div>
    @endcan
    <div class="nav-item {{ ($segment2 == 'codes') ? 'active' : '' }}">
        <a href="{{ route('panel.codes.index')}}" class="a-item" ><i class="ik ik-shopping-bag"></i><span>Promo Code</span></a>
    </div>
    <div class="nav-item {{ ($segment2 == 'requirements') ? 'active' : '' }}">
        <a href="{{ route('panel.requirements.index')}}" class="a-item" ><i class="ik ik-book"></i><span>Requirements</span></a>
    </div>
    

    @can('mange_constant_management')
    <div class="nav-item {{ activeClassIfRoutes(['panel.constant_management.mail_sms_template.index','backend/constant-management.faqs.index','backend/constant-management.faqs.create','backend/constant-management.faqs.edit','panel.constant_management.mail_sms_template.create','panel.constant_management.mail_sms_template.edit','panel.constant_management.mail_sms_template.show', 'panel.constant_management.category_type.index','panel.constant_management.category_type.create','panel.constant_management.category_type.edit','panel.constant_management.category.index','panel.constant_management.category.create','panel.constant_management.category.edit', 'backend.site_content_managements.index','backend.site_content_managements.create','backend.site_content_managements.edit','backend.constant-management.slider_types.index','backend.constant-management.slider_types.create','backend.constant-management.slider_types.edit','backend.constant-management.sliders.index','backend.constant-management.sliders.create','panel.constant_management.article.index','panel.constant_management.article.create','panel.constant_management.article.edit','panel.constant_management.article.show','backend.constant-management.sliders.edit','panel.constant_management.location.country' ], 'active open')  }} has-sub">
        <a href="#"><i class="ik ik-hard-drive"></i><span>{{ __('Content Management')}}</span></a>
        <div class="submenu-content">
            @can('manage_article')
                <a href="{{route('panel.constant_management.article.index')}}" class="menu-item {{ activeClassIfRoutes(['panel.constant_management.article.index','panel.constant_management.article.create','panel.constant_management.article.edit','panel.constant_management.article.show'], 'active')  }}">{{ __('Articles/Blogs')}}</a>
            @endcan
            @can('manage_mail_sms')
                <a href="{{route('panel.constant_management.mail_sms_template.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['panel.constant_management.mail_sms_template.index','panel.constant_management.mail_sms_template.create','panel.constant_management.mail_sms_template.edit','panel.constant_management.mail_sms_template.show'], 'active')  }}">{{ __('Mail/Text Templates')}}</a>
            @endcan

            @can('manage_category')
                <a href="{{route('panel.constant_management.category_type.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['panel.constant_management.category_type.index','panel.constant_management.category_type.create','panel.constant_management.category_type.edit','panel.constant_management.category.index','panel.constant_management.category.create','panel.constant_management.category.edit',], 'active')  }}">{{ __('Category Group')}}</a>
            @endcan

            @can('manage_slider')
                <a href="{{ route('backend.constant-management.slider_types.index')}}" class="menu-item a-item {{ activeClassIfRoutes(['backend.constant-management.slider_types.index','backend.constant-management.slider_types.create','backend.constant-management.slider_types.edit'], 'active')  }}" ><span>Slider Group</span></a>
            @endcan
            
            @can('manage_slider')
            {{-- <a href="{{ route('panel.testimonial.add')}}" class="menu-item a-item" >Testimonial Management</a> --}}
                <a href="{{ route('panel.testimonial.add')}}" class="menu-item a-item {{ activeClassIfRoutes(['panel.testimonial.add','panel.testimonial.create','panel.testimonial.edit'], 'active')  }}" ><span>Testimonial Management</span></a>
            @endcan

            {{-- @can('manage_paragraph_content')
                <a href="{{ route('backend.site_content_managements.index')}}" class="menu-item {{ activeClassIfRoutes(['backend.site_content_managements.index','backend.site_content_managements.create','backend.site_content_managements.edit',], 'active')  }}">{{ __('Paragraph Content')}}</a>
            @endcan --}}

            @can('manage_faq')
                <a href="{{ route('backend/constant-management.faqs.index')}}" class="menu-item {{ activeClassIfRoutes(['backend/constant-management.faqs.index','backend/constant-management.faqs.create','backend/constant-management.faqs.edit',], 'active')  }}">{{ __('Manage FAQs')}}</a>
            @endcan
            <a href="{{ route('panel.testimonial.index')}}" class="menu-item {{ activeClassIfRoutes(['panel.testimonial.index','panel.testimonial.create','panel.testimonial.edit'], 'active')  }}">{{ __('Client Videos')}}</a>

            {{-- @can('manage_location')
                <a href="{{ route('panel.constant_management.location.country')}}" class="menu-item {{ activeClassIfRoutes(['panel.constant_management.location.country','panel.constant_management.location.create','panel.constant_management.location.edit',], 'active')  }}">{{ __('Location')}}</a>
            @endcan --}}
        </div>
    </div>
    @endcan


    @can('manage_webiste_setup')
    <div class="nav-item {{ activeClassIfRoutes(['panel.website_setting.footer', 'panel.website_setting.pages','panel.website_setting.pages.create','panel.website_setting.pages.edit', 'panel.website_setting.appearance', 'panel.website_setting.social-login'] ,'active open' ) }} has-sub">
        <a href="#"><i class="ik ik-monitor"></i><span>{{ __('Website Setup')}}</span></a>
        <div class="submenu-content">
            @can('manage_basic_detail')
                <a href="{{route('panel.website_setting.footer')}}" class="menu-item a-item {{ activeClassIfRoute('panel.website_setting.footer', 'active')  }}">{{ __('Basic Details')}}</a>
            @endcan

            @can('manage_pages')
                <a href="{{route('panel.website_setting.pages')}}" class="menu-item a-item {{ activeClassIfRoutes(['panel.website_setting.pages','panel.website_setting.pages.create','panel.website_setting.pages.edit'], 'active')  }}">{{ __('Pages')}}</a>
            @endcan
            {{-- <a href="{{route('panel.website_setting.appearance')}}" class="menu-item a-item {{ activeClassIfRoute('panel.website_setting.appearance', 'active')  }}">{{ __('Appearance')}}</a> --}}
            {{-- <a href="{{route('panel.website_setting.social-login')}}" class="menu-item a-item {{ activeClassIfRoute('panel.website_setting.social-login',  'active')  }}">{{ __('Social Login')}}</a> --}}
        </div>
    </div>
    @endcan

    @can('manage_setup_configuation')
    <div class="nav-item {{ activeClassIfRoutes(['panel.setting.general', 'panel.setting.general', 'panel.setting.mail', 'panel.setting.payment'], 'active open')  }} has-sub">
        <a href="#"><i class="ik ik-settings"></i><span>{{ __('Setup & Configurations')}}</span></a>
        <div class="submenu-content">
            @can('manage_general_configuration')
            <a href="{{route('panel.setting.general')}}" class="menu-item a-item {{ activeClassIfRoute('panel.setting.general', 'active')  }}">{{ __('General Configuration')}}</a>
            @endcan
            {{-- <a href="{{route('panel.setting.general')}}" class="menu-item a-item {{ activeClassIfRoute('panel.setting.general', 'active')  }}">{{ __('Content Group')}}</a> --}}

            @can('mail_sms_configuration')
            <a href="{{route('panel.setting.mail')}}" class="menu-item a-item {{ activeClassIfRoute('panel.setting.mail', 'active')  }}">{{ __('Mail/SMS Configuration')}}</a>
            @endcan

            {{-- @can('payment_configuaration')
            <a href="{{route('panel.setting.payment')}}" class="menu-item a-item {{ activeClassIfRoute('panel.setting.payment', 'active')  }}">{{ __('Payment Configuaration')}}</a>
            @endcan --}}
        </div>
    </div>
    @endcan
    
    <div class="nav-item {{ activeClassIfRoutes(['panel.medical_insurance_logics.index', 'panel.assumption_logics.index', 'panel.investor_types.index', 'panel.debt_logics.index', 'panel.investment_options.index'], 'active open')  }} has-sub">
        <a href="#"><i class="ik ik-grid"></i><span>{{ __('Master Logics')}}</span></a>
        <div class="submenu-content">

            <a href="{{ route('panel.medical_insurance_logics.index')}}" class="menu-item a-item" ><span>Medical Insurance Logic</span></a>
            <a href="{{ route('panel.assumption_logics.index')}}" class="menu-item a-item" >Assumption Logic</a>
            <a href="{{ route('panel.investor_types.index')}}" class="menu-item a-item" >Investor Type</a>
            <a href="{{ route('panel.debt_logics.index')}}" class="menu-item a-item" >Debt Logic</a>
            <a href="{{ route('panel.investment_options.index')}}" class="menu-item a-item" >Investment Option</a>
        </div>
    </div>
@endcan