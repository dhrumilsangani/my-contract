@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              
              <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">News Management</h2>
                  <div class="card shadow">
                    <div class="card-body">
                    @include('message_data')
                      <div class="toolbar row mb-3">
                        <div class="col">
                          <form class="form-inline" action="" method="GET" role="search">
                            <div class="form-row">
                              <div class="form-group col-auto mr-2">
                                <label for="search" class="sr-only">Search</label>
                                <input type="text" placeholder="Search" class="form-control" id="search_by_english_text" name="search_by_title" value="{{isset($request->search_by_title)?$request->search_by_title:'' }}">
                              </div>
                            </div>
                            <button type="submit" name="search_submit" value="1" class="btn btn-primary mr-2">Search</button>
                            <a href="{{ url('/admin/news_management') }}" class="btn btn-secondary">Reset</a>
                          </form>
                        </div>
                        <div class="col ml-auto">
                          <div class="dropdown float-right">
                            
                          <a class="btn btn-primary float-right ml-3" href="{{url('/admin/add_news')}}">Add news +</a> 
                          </div>
                        </div>
                      </div>
                      <!-- table -->
                      <table class="table table-bordered  news_management_tbl">
                        <thead>
                          <tr role="row">
                          <th style="width: 5%;">#</th>
                        <th>News title</th>
                        <th style="width: 60%;">News description</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 6%;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                       
          <?php 
            if(!empty($data)){
                //$i = 1;
                $i = $data->perPage() * ($data->currentPage() - 1) + 1;
                foreach ($data as $key => $value) { ?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ !empty($value->title) ? $value->title : 'N/A' }}</td>
                        <td>{{$value->description}}</td>
                        <td>{{$value->status == 1?"Active":"Inactive"}}</td>
                        <td class="text-center">
                        <a class="mr-1" href="{{url('admin/edit_news/'.$value->id)}}" alert="Edit"><i class="fe fe-edit fe-16"></i></a>
                            <a class="mr-1" href="{{url('admin/delete_news/'.$value->id)}}" alert="delete"><i class="fe fe-trash-2 fe-16"></i></a>
                        </td>
                    </tr>
            <?php 
                $i++;
                }}
            ?>
                        </tbody>
                      </table>
                      <div class="d-flex justify-content-center">  {!! $data->withQueryString()->links("pagination::bootstrap-4") !!}</div>
                      <!-- <nav aria-label="Table Paging" class="mb-0 text-muted">
                        <ul class="pagination justify-content-end mb-0">
                          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                      </nav> -->
                    </div>
                  </div>
                </div> <!-- simple table -->
              </div> <!-- end section -->
              
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        
@endsection