<?php

namespace App\Http\Controllers;

use App\Models\PaymentPackage;
use App\Models\Setting;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserOrder;
use App\Models\UserTransaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Traits\UserTrait;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use UserTrait;
    public function index()
    {
        //$user_orders = UserOrder::all();
        $userTransactions =  UserTransaction::where('receiver_id', Auth()->user()->id)->where('status', 1)->orderBy('updated_at', 'DESC')->paginate(20);
        return view('admin.payout_history', compact('userTransactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_package');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $package_list = PaymentPackage::all();
        $flag = true;
        foreach ($package_list as $package) {
            if (Str::lower($request->get('name')) == Str::lower($package->name)) {
                $flag = false;
            }
        }
        if ($flag) {
            $package = new PaymentPackage();
            $package->name = $request->get('name');
            $package->streaming_count = $request->get('count');
            // $package->description = $request->get('description');
            $package->price = $request->get('price');
            $package->color = $request->get('color');
            $package->status = 1;
            $package->save();
            Toastr::success('Package Added successfully :)', 'Success');
        } else {
            Toastr::error('Duplicate Package Name :(', 'Error');
            //return redirect()->route('admin.create_subject');
        }
        return redirect()->route('admin.create_package');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_order =  UserOrder::findOrFail($id);
        return view('admin.view_order', compact('id', 'user_order'));
    }
    public function show_payout($id)
    {
        $userTransaction =  UserTransaction::findOrFail($id);
        return view('admin.view_payout', compact('id', 'userTransaction'));
    }
    public function approve_payout(Request $request)
    {
        $userTransaction =  UserTransaction::findOrFail($request->get('transaction_id'));
        $userTransaction->status = 1;
        $userTransaction->save();

        $user = User::findOrFail($userTransaction->sender->id);
        $mentor = Teacher::findOrFail($user->userable->id);
        $mentor->amount = $mentor->amount - $userTransaction->amount;
        $mentor->save();
        $mentor->user()->save($user);

        $this->createNotification($user->id, explode(' ', Auth()->user()->name)[0] . ' has Approve Your Request..!.', route('teacher.payout_history'));

        $to = $user->email;
        $subject = "Approve Payout.!";
        $txt = "Hi, YoutoMentor has Approved Your Payout Request..! Your payment will be transfered around 7 working days to your Paypal.
        /n Click Here : " . route('login') . " ";
        $headers = "From: info@you2mentor.com" . "\r\n";
         mail($to,$subject,$txt,$headers);

        Toastr::success('Payment Approved :)', 'Success');
        return redirect()->route('admin.payouts');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.edit_payout');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function payout_requests()
    {
        $userTransactions =  UserTransaction::where('receiver_id', Auth()->user()->id)->where('status', 0)->orderBy('updated_at', 'DESC')->paginate(20);
        return view('admin.payout_requests', compact('userTransactions'));
    }


    public function packages_list()
    {
        $packages = PaymentPackage::paginate(10);
        // return dd($subjects);
        return view('admin.packages_list', compact('packages'));
    }

    public function edit_package($id)
    {
        //dd($id);
        $package =  PaymentPackage::findOrFail($id);
        return view('admin.edit_package', compact('id', 'package'));
    }

    public function update_package(Request $request, $id)
    {
        //dd($request);
        $package = PaymentPackage::findOrFail($id);
        $package->name = $request->get('name');
        $package->streaming_count = $request->get('count');
        // $package->description = $request->get('description');
        $package->price = $request->get('price');
        $package->color = $request->get('color');
        if ($request->get('status') == 'on') {
            $package->status = true;
        } else {
            $package->status = false;
        }
        $package->save();
        Toastr::success('Payment Package Updated successfully :)', 'Success');

        return redirect()->route('admin.edit_package', $id);
    }

    public function destroy_package($id)
    {
        $package = PaymentPackage::findOrFail($id);
        $package->delete();
        Toastr::success('Payment Package Deleted successfully :)', 'Deleted');
        return redirect()->route('admin.packages_list');
    }

    public function settings()
    {
        //dd($request);
        $setting = Setting::first();
        return view('admin.settings', compact('setting'));
    }

    public function update_settings(Request $request)
    {
        //dd($request);
        $setting = Setting::first();
        // $setting->commission = $request->get('commission');
        $setting->payout_limit = $request->get('limit');
        $setting->streaming_amount = $request->get('streamprice');
        $setting->paid_level = $request->get('level');
        $setting->save();
        Toastr::success('Settings Updated successfully :)', 'Success');
        return redirect()->route('admin.settings');
    }
    public function payment_packages()
    {
        $payment_packages = PaymentPackage::where('status', 1)->paginate(9);
        return view('student.payment_packages', compact('payment_packages'));
    }

    public function payment_summary($id)
    {
        $payment_package = PaymentPackage::findOrFail($id);
        return view('student.payment_summary', compact('payment_package'));
    }

    public function user_orders()
    {
        $user_orders = UserOrder::all();
        return view('admin.user_orders', compact('user_orders'));
    }

    public function show_payout_history($id)
    {
        $setting = Setting::first();
        $userTransaction = UserTransaction::findOrFail($id);
        return view('admin.view_payout_history', compact('setting', 'userTransaction', 'id'));
    }
}
