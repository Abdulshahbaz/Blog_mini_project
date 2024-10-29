@extends('layout.app')
@section('content')
<h5 class="mt-3" style="text-align: center">My Post </h5>
<div class="container-fluid">
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
                                    @foreach ($mypost as $key =>$item)
                                        <tr>
                                            <td>{{ $key + 1}}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{!! $item->description !!}</td>
                                            <td style="display: flex; gap:5px;">
                                                <a href="{{ route('edit.show', $item->id) }}"
                                                    class="btn  btn-sm btn-success">Edit</a>

                                                <form action="{{ route('delete', $item->id) }}" method="POST"
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
    <style>
        .container-fluid{
           
            height: auto;
            margin-top: 90px;
           
        }
    </style>
@endsection
