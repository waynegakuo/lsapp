@extends ('layouts.app')

@section ('content')
  <div class="container">

    <h1>Edit Post</h1>
    {!! Form::open(['action'=> ['PostsController@update', $post->id], 'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
      {{-- Starts with the label (first is the label name associated with the
      second parameter(displayed on the screen))
      Then the text has the text name associated with what will be entered in the
      second parameter (empty because user must provide), then the third is
      the attribute of that text or textarea etc using bootstrap --}}
      {{Form::label('title','Title')}}
      {{Form::text('title', $post->title, ['class'=>'form-control', 'placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
      {{Form::label('body','Body')}}
      {{Form::textarea('body', $post->body, ['id'=> 'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Body Text'])}}
    </div>
    {{-- file upload --}}
    <div class="form-group">
      {{Form::file('cover_image')}}
    </div>
    {{-- Laravel allows us to spoof a PUT request as per the route requirement since
    you cannot change the form's method to PUT or PATCH therefore, you do the
    hidden spoofing below --}}
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
  </div>
@endsection
