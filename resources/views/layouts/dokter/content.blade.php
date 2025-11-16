<!-- ========== MAIN CONTENT ========== -->
<div class="content-wrapper">
	@if(session('success'))
		<div class="alert alert-success" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" style="display: none;" x-transition>
			{{ session('success') }}
		</div>
	@endif

	@if(session('error'))
		<div class="alert alert-error" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" style="display: none;" x-transition>
			{{ session('error') }}
		</div>
	@endif

	@if($errors->any())
		<div class="alert alert-error" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" style="display: none;" x-transition>
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	@yield('content')
</div>
