@extends('layouts.app')

@section('title')
    View Payout
@endsection

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
@endpush

@section('content')

   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>YOU2MENTOR</h1> --}}
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
  <section class="content">
  <!-- general form elements -->
  <div class="col-sm-6">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">View Payout</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.approve_payout')}}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="SubjectName">Details</label>
                 <textarea disabled   name="paypal_email"  class="form-control"   for="SubjectName" rows="2">{{$userTransaction->notes}}
                </textarea>
                      {{-- @if($errors->has('paypal_email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('paypal_email') }}</strong>
                        </span>
                    @endif --}}

                </div>
                <div class="form-group">
                    <label for="SubjectName">Available Balance($)</label>
                    <input disabled="" type="text" value="{{$userTransaction->sender->userable->amount}}" class="form-control" />


                </div>
                {{-- <div class="form-group">
                    <label for="SubjectName">Minimum Payout</label>
                    <label disabled="" class="form-control" for="SubjectName">${{$setting->payout_limit}}</label>

                </div> --}}
                <div class="form-group">
                    <label for="SubjectName">Payout Amount($)</label>
                    <input type="text" disabled name="payout_amount" value="{{$userTransaction->amount}}"  class="form-control  @if($errors->has('payout_amount')) {{'is-invalid'}} @endif"  for="SubjectName"/>
                      @if($errors->has('payout_amount'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('payout_amount') }}</strong>
                        </span>
                    @endif
                </div>
                 <div class="callout callout-info">
                        {{-- <h5>Follow the Instrctions</h5> --}}

                        <p>You go to <strong><a target="_blank" href="https://www.paypal.com/us/signin">Paypal</a></strong> and credit <strong>${{$userTransaction->amount}}</strong> to the paypal account associated with the email.
                            Then approve this.
                        </p>
                    </div>
            </div>
            <!-- /.card-body -->
            <input type="hidden" name="transaction_id" value="{{$userTransaction->id}}"/>
            <div class="card-footer">
                <button  type="submit" class="btn btn-success pull-left">Approve</button>
                {{-- <button id="payout_cancel"  type="button" class="btn btn-danger pull-left">Cancel</button> --}}
                <a target="_blank" href="https://www.paypal.com/us/signin"> <img src="{{ url('public/') }}/theme/admin/dist/img/credit/paypal2.png" alt="Paypal"></a>
            </div>
        </form>
    </div>
  </div>
  <!-- /.card -->
  </section>
@endsection
