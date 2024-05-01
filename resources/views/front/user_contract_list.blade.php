@extends('front/layouts.master')
@section('content')
<!-- Start Hero Area -->
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">My contract</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{url('/front/dashboard')}}">Dashboard</a></li>
                        <li>My contract</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
      <!-- Start Pricing Table Area -->
     <section id="pricing" class="pricing-table section">
        <div class="container">
        <div class="row">
        <!-- Alert messages code start here -->	
        @include('message_data')	
            <!-- Alert messages code end here -->
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">My contract</h2>
                  <div class="card shadow">
                    <div class="card-body">
                        <div class="toolbar row mb-3">
                            <div class="col">
                                <form class="form-inline">
                                    <div class="form-row row">
                                        <div class="form-group col-auto">
                                            <input type="text" name="search_by_name" class="form-control" id="search" value="" placeholder="Search">
                                        </div>
                                        <div class="form-group col-auto">
                                            <button type="submit" name="search_submit" value="submit" class="btn btn-primary">Search</button>
                                        </div>
                                        <div class="form-group col-auto">
                                            <a href="{{ url('/front/user_contract_list') }}" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- <div class="col ml-auto">
                                <div class="dropdown float-right">
                                     <a href="{{url('/front/contract-list')}}" style="float: right;" class="btn btn-primary float-right ml-3">Create new contract</a>
                            </div>
                        </div> -->
                    </div>
                      <!-- table -->
                      <table class="table table-bordered">
                        <thead>
                        <tr role="row">
                            <th>#</th>
                            <th>Contract name</th>
                            <th>Date</th>
                            @if($check == 1)
                            <th>Actions</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if(!empty($contractData))
                                <?php $i = 1;?>
                                @foreach ($contractData as $value)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$value->title}}</td>
                                        <td>{{convertOnlyDate($value->created_at)}}</td>
                                        @if($check == 1)
                                        <td>
                                            <a class="btn btn-primary" href="{{url('front/edit_contract/'.$value->id)}}"><i class="lni lni-pencil"></i></a>
                                            <a class="btn btn-primary" href="{{url('front/send-contract-page/'.$value->id)}}"><i class="lni lni-envelope"></i></a>
                                            <a class="btn btn-primary" href="{{url('front/download_contract/'.$value->id)}}">Download contract</a>
                                        </td>
                                        @endif
                                    </tr>
                                <?php $i++; ?>
                                @endforeach 
                                @else
                                <tr>
                                    <td colspan="3">
                                        <p class="font-weight-bold mb-1 text-center">No record found.</p>
                                    </td>
                                </tr>
                                
                            @endif  
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div> <!-- simple table -->
              </div> <!-- end section -->
    </section>
    <!--/ End Pricing Table Area -->
@endsection    