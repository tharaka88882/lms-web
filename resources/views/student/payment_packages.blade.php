@extends('layouts.app')

@section('title')
    Premium Packages | YOU2MENTOR
@endsection

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
@endpush

@section('content')
<!-- Content Header (Page header) -->
   {{-- <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item active">Payment</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section> --}}
 <section class="content-header">
        <div class="container-fluid">
  <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title"><strong> Premium Packages </strong></h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    @if (sizeOf($payment_packages)>0)

                    @foreach ($payment_packages as $payment_package)
                    <div class="col-sm-4 mb-4">
                        <div class="position-relative p-3 bg-white shadow-lg" style="height: 280px">
                                <div class="ribbon-wrapper ribbon-xl">
                                    <div class="ribbon bg-{{$payment_package->color}} text-lg">
                                    {{$payment_package->name}}
                                    </div>
                                </div>
                                {{-- <h5><strong>Package Details</strong></h5> --}}
                                <table class="table table-bordered table-striped dataTable dtr-inline text-center">
                                    <tr>
                                        <th>Unlimited Chat</th>
                                    </tr>
                                    <tr>
                                        <th>{{$payment_package->streaming_count}} Video Streamings</th>
                                    </tr>
                                    <tr>
                                        <th><h2><strong>${{$payment_package->price}}</strong></h2></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="{{route('student.payment_summary',$payment_package->id)}}" style="color: white; text-align: center;" class="btn btn-success">Purchase Now <i class="fas fa-arrow-circle-right"></i></a>
                                        </td>
                                    </tr>
                                </table>
                                {{-- <ul>
                                    <li class="nav-item">
                                        Unlimited Chat
                                    </li>
                                    <li class="nav-item">
                                      {{$payment_package->streaming_count}} Video Streams
                                    </li>
                                    <li class="nav-item">
                                      Price : ${{$payment_package->price}}
                                    </li>
                                    <li class="nav-item">
                                      Description : {{$payment_package->description}}
                                    </li>
                                        <div class="card-footer">
                                            <a href="{{route('student.payment_summary',$payment_package->id)}}" style="color: white; text-align: center;" class="btn btn-success">Purchase Now <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                </ul> --}}


                        </div>

                    </div>
                    @endforeach
                    @else
                    <h4>No Packages Available..!</h4>
                    @endif
                </div>


                </div>
              </div>
              <!-- /.card-body -->
            <div class="card-footer text-center">
            {{ $payment_packages->render() }}
          </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.row -->
 </section>
@endsection
