@extends('admin.layout.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container">
                <div class="row">

                </div>
            </div>
        </section>
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Post List</h2>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($post as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{!! $item->description !!}</td>
                                                <td>
                                                    <a href="{{ route('edits', $item->id) }}"
                                                        class="btn btn-warning d-inline">edit</a>

                                                    <form action="{{ route('delete.post', $item->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info"
                                                            onclick="return confirm('Are you sure you want to delete this data?')">
                                                            delete</button>
                                                    </form>

                                                    <form action="{{ route('toggle.post', $item->id) }}" method="post"
                                                        enctype="multipart/form-data" class="d-inline">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn {{ $item->status ? 'btn-danger' : 'btn-success' }}">
                                                            {{ $item->status ? 'Block' : 'Unblock' }}</button>
                                                    </form>

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
        </section>
    </div>
@endsection
