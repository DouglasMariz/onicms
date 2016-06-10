<div class="sidebar-wrapper">
	<div class="logo">
        <a href="{{ url('/admin') }}"><img src="{{ asset('assets/admin/img/logo-oni-white.svg') }}" alt="logo" class="img-responsive center-block" width="120" height="40"></a>
    </div>
    <ul class="nav">
    	@if(isset($menu_adm))
	    	{!! $menu_adm !!}
		@endif
        @if( Auth::user()->email == 'admin@onidigital.com' )
            <li><a href="{{ url('admin/menu_admin/create') }}">Cadastrar menus</a></li>
	  	@endif
	</ul>
</div>