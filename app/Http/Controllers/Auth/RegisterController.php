<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // Get the last user's account number and increment it
        $lastAccountNumber = User::max('account_number');

        // Generate the next account number
        $newAccountNumber = $this->generateNextAccountNumber($lastAccountNumber);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'account_number' => $newAccountNumber,
            'role' => 2, // Default to normal user
        ]);
    }
    /**
     * Generate the next account number based on the last one.
     *
     * @param string|null $lastAccountNumber
     * @return string
     */
    protected function generateNextAccountNumber($lastAccountNumber)
    {
        if (!$lastAccountNumber) {
            return 'ACC0001'; // Start from ACC0001 if no users exist
        }

        // Extract the numeric part and increment it
        $numericPart = (int) substr($lastAccountNumber, 3);
        $newNumericPart = str_pad($numericPart + 1, 4, '0', STR_PAD_LEFT);

        return 'ACC' . $newNumericPart;
    }
}
