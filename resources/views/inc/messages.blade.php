{{-- we wanna chek for session successes or errors
we also wanna check the errors array if the validation fails
they will be flash messages --}}
<div class="container">
@if(count($errors)>0)
  @foreach($errors->all() as $error)
    <div class="alert alert-danger">
      {{$error}}
    </div>
  @endforeach
@endif

@if(session('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
@endif
@if(session('error'))
  <div class="alert alert-danger">
    {{session('error')}}
  </div>
@endif
</div>
