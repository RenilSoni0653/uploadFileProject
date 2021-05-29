@extends('layouts.app')

@section('content')
    <div class="container">
            <h3 align="center">Laravel</h3><br/>
            @if(count($errors) > 0)
                <div class="alert alert-danger">Upload Validation Error<br><br>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
            @endif

            <form method="post" enctype="multipart/form-data" action="{{ url('/import_excel/import') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <table class="table">
                <tr>
                    <td width="40%" align="right"><label>Select File for Upload</label></td>
                    <td width="30">
                        <input type="file" name="select_file" />
                    </td>
                    <td width="30%" align="left">
                        <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                    </td>
                </tr>
        </table>
    </div>
   </form><br/>

   <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Customer Data</h3><br>
            <form method="GET" action="{{ route('excelsearch') }}">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" name="search" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default-sm" type="submit">
                                    <i class="fa fa-search">Search
                                </button>
                            </span>
                        </div>
                    </form>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Customer Name</th>
                    <th>Gender</th>
                    <th>Address</th>
                </tr>
                @foreach($data as $row)
                <tr>
                    <td>{{ $row->cust_name }}</td>
                    <td>{{ $row->gender }}</td>
                    <td>{{ $row->address }}</td>
                </tr>
                @endforeach
            </table>
                <div>
                    {!! $data->links() !!}
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection('content')