<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUp;

class MailController extends Controller {
   public function sendMail(){

        Mail::to('gaveenwick@gmail.com')->send(new SignUp());

        return redirect()->route('user.milestone');
        // return view('welcome');
   }
}