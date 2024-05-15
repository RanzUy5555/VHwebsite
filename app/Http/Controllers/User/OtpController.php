<?php

namespace App\Http\Controllers\User;

use App\Models\Otp;
use Illuminate\Http\Request;
use App\Services\TextService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Otp\OtpRequest;

class OtpController extends Controller
{
    public function __invoke(OtpRequest $request, TextService $service)
    {
        $otp = mt_rand(123456, 999999);

        //Mail::to($request->email)->send(new SendOtp($otp)); // send otp to user

        $service->send(recipient:$request->contact, message: "To process your order from Virgilio Handicraft you are required to enter the following code. Your OTP code is: $otp");    // send SMS

        $new_otp =  Otp::updateOrCreate(
            ['user_id' => auth()->id()],
            ['otp' => $otp,]
        );

        return $this->res(['message' => 'OTP code has been sent to your contact number. Please check and apply it to the OTP input field']);
    }
}