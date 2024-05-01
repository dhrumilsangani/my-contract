@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              
              <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">CMS Management</h2>
                  <div class="card shadow">
                    <div class="card-body">
                    @include('message_data')
                      <div class="toolbar row mb-3">
                        <div class="col">
                          <form class="form-inline" action="" method="GET" role="search">
                            <div class="form-row">
                              <div class="form-group col-auto mr-2">
                                <label for="search" class="sr-only">Search</label>
                                <input type="text" placeholder="Search" class="form-control" id="search_by_page_title" name="search_by_page_title" value="{{isset($request->search_by_page_title)?$request->search_by_page_title:'' }}">
                              </div>
                            </div>
                            <button type="submit" name="search_submit" value="1" class="btn btn-primary mr-2">Search</button>
                            <a href="{{ url('/admin/cms_pages') }}" class="btn btn-secondary">Reset</a>
                          </form>
                        </div>
                        <div class="col ml-auto">
                          <div class="dropdown float-right">
                            
                            <a class="btn btn-primary float-right ml-3" href="{{url('/admin/add_cms')}}">Add CMS +</a>
                          </div>
                        </div>
                      </div>
                      <!-- table -->
                      <table class="table table-bordered">
                        <thead>
                          <tr role="row">
                            <th>#</th>
                            <th>Page title</th>
                            <th>Page slug</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!empty($cms_pages))
                                @php
                                //$i=1;
                                $i = $cms_pages->perPage() * ($cms_pages->currentPage() - 1) + 1;
                                @endphp
                                @foreach ($cms_pages as $cms)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ !empty($cms->page_title) ? $cms->page_title : 'N/A' }}</td>
                                        <td>{{ !empty($cms->page_slug) ? $cms->page_slug : 'N/A' }}</td>
                                        <td>{{ !empty($cms->status) ? 'Active' : 'Inactive' }}</td>
                                        <td class="mb-0 text-center">
                                          <a class="mr-3" href="{{url('admin/edit_cms_page/'.$cms->id)}}" alert="Edit"><i class="fe fe-edit fe-16"></i></a>
                                          <a onClick="deleteCms({{$cms->id}})" href="javascript:void(0)" ><i alert="Delete" class="fe fe-trash-2 fe-16"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                    $i=$i+1;
                                    @endphp
                                @endforeach
                            @endif
                        </tbody>
                      </table>
                      <div class="d-flex justify-content-center">  {!! $cms_pages->withQueryString()->links("pagination::bootstrap-4") !!}</div>
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