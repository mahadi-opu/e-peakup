<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Mail;
use App\Mail\UserRegistered;

use Exception;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/email/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
            'phone'     => ['required', 'numeric', 'min:10'],
            'refer'     => ['nullable', 'integer', 'exists:users,id'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $refer_id = isset($data['refer']) && $data['refer'] ? $data['refer'] : 0;

        DB::beginTransaction();

        try {
            $refer_user = User::find($refer_id);

            if($refer_user) {
                $refer_user->update([
                    'refers' => $refer_user->refers + 1
                ]);
            }

            $customer_id = strtoupper(substr($data['name'], 0,1)).time();

            $user = User::create([
                'customer_id'   => $customer_id,
                'name'          => $data['name'],
                'email'         => $data['email'],
                'password'      => Hash::make($data['password']),
                'phone'         => $data['phone'],
                'country_id'    => 1,
                'refer_id'      => $refer_id,
            ]);

            // $info_mail = 'info@quickpeakup.com';
            // Mail::to($info_mail)->send(new UserRegistered($user));

            DB::commit();
            return $user;

        } catch (Exception $e) {
            DB::rollback();
            dd($e);
        }
    }
}
