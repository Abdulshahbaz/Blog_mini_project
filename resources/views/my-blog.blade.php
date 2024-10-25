<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .container {
            width: 50%;
            height: auto;
            border: 1px solid gray;
            margin-top: 42px;
        }
    </style>
</head>

<body>
    <h1 class="mt-3" style="text-align: center">My Post </h1>
    <div class="container-lg">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <div class="card mb-4">

            <div class="card-body">
                <div class="example">
                    <div class="tab-content rounded-bottom">
                        <div class="tab-pane p-3 active preview table-responsive" role="tabpanel" id="preview-1035">
                            <table class="table table-striped border datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($mypost as $item)
                                            
                                       
                                         <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{!!$item->description!!}</td>
                                            <td>
                                                    <a href="{{route('edit.show',$item->id)}}" class="btn  btn-sm btn-success">Edit</a>

                                                    <form action="{{ route('delete',$item->id) }}" method="POST"
                                                        class="d-inline">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this data?')">
                                                            Delete</button>
                                                    </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
