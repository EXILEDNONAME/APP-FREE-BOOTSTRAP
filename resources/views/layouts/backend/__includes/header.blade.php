<div class="kt-sidebar-header hidden lg:flex items-center relative justify-between px-3 lg:px-6 shrink-0" id="sidebar_header">
    <a class="dark:hidden" href="/dashboard">
        <span class="default-logo font-semibold text-xl"> {{ \DB::table('system_settings')->first()->application_name; }} </span>
        <img class="small-logo" src="{{ env('APP_URL') }}/logo-mode-default.png" />
    </a>
    <a class="hidden dark:block" href="/dashboard">
        <span class="default-logo font-semibold text-xl"> {{ \DB::table('system_settings')->first()->application_name; }} </span>
        <img class="small-logo" src="{{ env('APP_URL') }}/logo-mode-dark.png" />
    </a>
    <button class="kt-btn kt-btn-outline kt-btn-icon size-[30px] absolute start-full top-2/4 -translate-x-2/4 -translate-y-2/4 rtl:translate-x-2/4" data-kt-toggle="body" data-kt-toggle-class="kt-sidebar-collapse" id="sidebar_toggle">
        <i class="ki-filled ki-black-left-line kt-toggle-active:rotate-180 transition-all duration-300 rtl:translate rtl:rotate-180 rtl:kt-toggle-active:rotate-0"></i>
    </button>
</div>