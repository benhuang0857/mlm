<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Mail\GeneratePassword;
use Illuminate\Support\Facades\Mail;

use App\Models\Category;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:最高權限管理員');
        $this->middleware('role:管理員');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return App\Models\User
     */
    protected function create(array $data)
    {
        $creatorID = auth()->user()->id;

        if(request()->hasFile('avatar'))
        {
            $avatar = request()->file('avatar')->getClientOriginalName();
            $imageName = pathinfo($avatar, PATHINFO_FILENAME);
            $extension = request()->file('avatar')->getClientOriginalExtension();
            $imageNametoStore = $imageName.'_'.time().'.'.$extension;
            $path = request()->file('avatar')->storeAs('public/images/avatar', $imageNametoStore);
        }

        $pwd = $data['password'];

        $categories = Category::all();
        $userLevelArray = array();

        foreach($categories as $category)
        {
            $jsonArray = array("$category->name" => "F",);
            if($userLevelArray != NULL)
            {
                $userLevelArray = array_merge($jsonArray, $userLevelArray);
            }
            else
            {
                $userLevelArray = $jsonArray;
            }
        }

        $user = new User;
        $user->name = $data['name'];
        $user->nickname = $data['nickname'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->phone = $data['phone'];
        $user->line_id = $data['line_id'];
        $user->address = $data['address'];
        $user->leader_id = intval($data['leader_id']);
        $user->image = $imageNametoStore;
        $user->authorization_code = $data['authorization_code'];
        $user->milage = 0;
        
        $user->level = json_encode($userLevelArray,JSON_UNESCAPED_UNICODE);
        $user->remarks = $data['remarks'];
        $user->role = $data['role'];            
        $user->save();

        $params = [
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'password' => $pwd,
        ];

        Mail::to($user->email)->send(new GeneratePassword($params));

        return redirect('/admin');
    }
}
