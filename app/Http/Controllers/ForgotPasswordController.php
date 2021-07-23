<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use DB;
use Str;
Use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    //
    /**
     * Write code on Method
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }

    /**
     * Write code on Method
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        /*Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });*/

        /*$msg = '<h3>Name: ' . 'madhu' . '</h3>' .
            '<h5>Email: '. 'madhumankatha@gmail.com' . '</h5>'.
            '<h5>Phone: ' . '8147887534' .'</h5>'.
            '<h5>Country: ' . 'INDIA' .'</h5>'.
            '<h5>Business / Company / Individual : ' . 'WEB BIRTH' .'</h5>'.
            '<h5>Message: ' . 'Hello World' . '</h5>';*/

        $email = $request->email;

        $msg = '<h1>Forget Password Email - Money App</h1>' . '<br /><br />'.
            '<h3>You can reset password from bellow link:</h3><br />'.
            '<a href="https://kalpavrikshacoir.industries/reset-password/'.$token.'?email='.$email.'">Reset Password</a>';

        $sendmail = new MailController();
        $sendmail->sendMail($email,'Forgot password link',$msg);

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
    /**
     * Write code on Method
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showResetPasswordForm($token) {
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/')->with('message', 'Your password has been changed!');
    }
}
