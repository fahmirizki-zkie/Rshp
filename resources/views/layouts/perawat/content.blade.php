<!-- ========== MAIN CONTENT ========== -->
<div class="content-wrapper">
    @if(session('success'))
        <div class="alert alert-success" 
             x-data="{show: true}" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 5000)"
             x-transition:enter="slideDown"
             x-transition:leave="slideUp">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error" 
             x-data="{show: true}" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 5000)"
             x-transition:enter="slideDown"
             x-transition:leave="slideUp">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</div>
