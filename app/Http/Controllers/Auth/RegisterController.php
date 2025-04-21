<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $middleware = ['guest'];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validZodiacSigns = [
            'Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo',
            'Libra', 'Scorpio', 'Sagittarius', 'Capricorn', 'Aquarius', 'Pisces'
        ];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9_]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
            'zodiac_sign' => ['required', 'string', 'in:' . implode(',', $validZodiacSigns)],
            'birth_date' => ['nullable', 'date', 'before_or_equal:' . Carbon::now()->subYears(13)->format('Y-m-d')],
        ], [
            'name.required' => 'Your mystical identity must be revealed',
            'name.regex' => 'Your mystical name may only contain stellar letters, numerals, and cosmic underscores',

            'email.required' => 'Your ethereal email address is essential for cosmic communication',
            'email.email' => 'This email does not resonate with the universal pattern',
            'email.unique' => 'This astral signature is already inscribed in our cosmic records',

            'password.required' => 'A mystic seal is required to protect your cosmic journey',
            'password.min' => 'Your arcane seal requires at least 8 symbols of power',
            'password.confirmed' => 'Your arcane seals must align in cosmic harmony',
            'password.regex' => 'Your arcane seal must contain celestial symbols (uppercase), earthly symbols (lowercase), numerical runes, and magical characters',

            'zodiac_sign.required' => 'Your zodiac alignment is essential for cosmic guidance',
            'zodiac_sign.in' => 'Please select a valid celestial sign',

            'birth_date.before_or_equal' => 'You must have completed at least 13 revolutions around the sun',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'zodiac_sign' => $data['zodiac_sign'],
            'birth_date' => isset($data['birth_date']) ? $data['birth_date'] : null,
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
}
