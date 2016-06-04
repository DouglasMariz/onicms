<nav class="navbar navbar-default">
    <div class="container-fluid">
    	<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand visible-xs" href="#"><img src="{{ asset('assets/admin/img/logo-oni-cinza.svg') }}" alt="logo" class="img-responsive center-block" width="120" height="40"></a>
		</div>
		<div class="collapse navbar-collapse">
			
	        <ul class="nav navbar-nav navbar-right">
		        <li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> 
		            	{{ Auth::user()->first_name() }} <span class="caret"></span></a>
		            <ul class="dropdown-menu">
		                <li>
		                	<a href="{{ url('admin/user/'.Auth::user()->id.'/edit') }}">Meus dados</a>
		                </li>
		                <li role="separator" class="divider"></li>
		                <li>
		                	<a href="{{ url('admin/logout') }}"><i class="fa fa-power-off"></i> Sair</a>
		                </li>
		            </ul>
		        </li>
	    	</ul>
		</div>
    </div>
</nav>
