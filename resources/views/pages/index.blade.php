@extends ('layouts.app')

@section ('content')
  <div class="jumbotron text-center">
  {{-- same as  php echo $title --}}
  {{-- this is the main index page --}}
<h1>{{$title}}</h1>
<p>
  This is the Laravel Application from the Laravel from Scratch YouTube Series
</p>
<p>
  <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
  <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>
</p>
@endsection
{{-- this basically means that the whole layout (html,etc) will be extended from
the layouts.app file and the only changes to be made will be the content which
will be dictated in the respective files such as the index, about and services. --}}
</div>
