@extends('layouts.app')

@section('title')
    View Payout | YOU2MENTOR
@endsection

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
@endpush

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
         <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1>View User Payout</h1>
                    </div>
                    {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item active">View Payout</li>
                    </ol>
                    </div> --}}
                </div>
                </div><!-- /.container-fluid -->
            </section>


            <!-- Main content -->
            <div class="invoice p-5 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                      <img src="{{ url('public/') }}/theme/admin/dist/img/logo/you2logo.png" style="width: 150px; height: 150px;"/>

                    {{-- <small class="float-right">Date: 2/10/2014</small> --}}
                <div class="float-right">
                 <small> <b>Reference No: #0000{{$userTransaction->id}}</b></small><br>
                  <br>
                  {{-- <small>  <b>Order ID: </b> 4F3S8J</small><br> --}}
                   <small>  <b>Account Name: </b>{{$userTransaction->sender->name}}</small><br>
                   <small>  <b>Payment Date: </b>{{$userTransaction->updated_at}}</small>
                </div>

                  </h4>
                </div>
                <!-- /.col -->
              </div>


              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Name</th>
                      <th>Payout Details</th>
                      <th>Payout Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>{{ $userTransaction->sender->name}}</td>
                      <td>{{ $userTransaction->notes}}</td>
                      <td>${{$userTransaction->amount}}</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  {{-- <img src="{{ url('public/') }}/theme/admin/dist/img/credit/visa.png" alt="Visa">
                  <img src="{{ url('public/') }}/theme/admin/dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="{{ url('public/') }}/theme/admin/dist/img/credit/american-express.png" alt="American Express"> --}}
                  <img src="{{ url('public/') }}/theme/admin/dist/img/credit/paypal2.png" alt="Paypal">

                  {{-- <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p> --}}
                </div>
                <!-- /.col -->
                <div class="col-6">
                  {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:70%">Subtotal:</th>
                        <td>${{$userTransaction->amount}}</td>
                      </tr>
                      <tr>
                        <th></th>
                        <td></td>
                      </tr>
                      <tr>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                    <form action="" method="post">
                        @csrf
                        {{-- <input type="hidden" name="payment_package_id" value="{{$user_order->payment_package->id}}">
                        <input type="hidden" name="amount" value="{{$user_order->payment_package->price}}"> --}}
                        {{-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> --}}
                        {{-- <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                            Payment
                        </button> --}}
                        <h5 class="text-right"><span class="badge badge-{{$userTransaction->status==('1')? 'success':'danger'}}">{{$userTransaction->status==('1')? 'Successful':'Unsuccessful'}}</span><h5>
                        {{-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generate PDF
                        </button> --}}
                    </form>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
