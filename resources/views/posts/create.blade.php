@extends ('layouts.app')

@section ('content')
  <div class="container">
  <h1>Create Post</h1>

  {!! Form::open(['action'=> 'PostsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
      <div class="form-group">
        {{-- Starts with the label (first is the label name associated with the
         second parameter(displayed on the screen))
         Then the text has the text name associated with what will be entered in the
         second parameter (empty because user must provide), then the third is
         the attribute of that text or textarea etc using bootstrap --}}
        {{Form::label('title','Title')}}
        {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Title'])}}
      </div>
      <div class="form-group">
        {{Form::label('body','Body')}}
        {{Form::textarea('body', '', ['id'=> 'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Body Text'])}}
      </div>
      <div class="form-group">
        {{Form::file('cover_image')}}
      </div>
      {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
  {!! Form::close() !!}

  </div>
@endsection
