@extends('layout.app')
@section('content')
<style>
    .main
    {
        width: 50%;
        height: auto;
        margin-top: 90px;
        border: 1px solid rgb(243, 241, 241);
        background-color: #e5e4e4;
        height: 310px;

    }
    .main h1 {text-align: center;}
</style>
    <div class="container main">
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding:10px">
            <div class="card">
                <div class="card-header">
                    <h1> User Edit
                    </h1>
                </div>
       
         <div class="card-body">  
            <form action="{{route('update',$my_post->id)}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="mb-3">
              <label for="exampleInputTitle" class="form-label mt-1">Title</label>
              <input type="text" class="form-control" name="title" value="{{$my_post->title}}">
               @error('title')
                   <div class="text-danger">{{$message}}</div>
               @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputTitle" class="form-label mt-1">Description</label>
                <textarea class="form-control"  name="description" id="editor">{{$my_post->description}}</textarea>
                @error('description')
                <div class="text-danger">{{$message}}</div>
            @enderror
         </div>
           
            <button type="submit" class="btn btn-primary mb-3">Update</button>
           
          </form>
        </div>
      </div>
  </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.2.0/"
            }
        }
    </script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font
        } from 'ckeditor5';

        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            } )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection