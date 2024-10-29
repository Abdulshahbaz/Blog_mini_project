@extends('admin.layout.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Users List</h2>
              </div>
          
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $key=>$item)
                    <tr>
                      <td>{{$key + 1}}</td>
                      <td>{{$item->name}}</td>
                      <td>{!!$item->email!!}</td>
                      <td>
                        <form action="{{route('toggle.button', $item->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" class="btn {{$item->status ? 'btn-danger' : 'btn-success'}}">
                                {{$item->status ? 'Block' : 'Unblock'}}</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
                <div class="float-end">
                    {{$users->links()}}
                </div>
              </div>
              
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
</section>
</div>
@endsection