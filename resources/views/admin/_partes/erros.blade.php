@if( isset($errors) && $errors->any())
    <div class="alert alert-danger" >
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
  @if(Session::has('alert-' . $msg))
  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert">&times;</a></p>
  @endif
@endforeach