<?php

namespace App\Http\Controllers;
use Session;
use App\Models\Product;
use App\Models\UserModel;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{


    public function index1()
    {

        $products = Product::all();
        $sliders = Slider::all();
        $featuredProducts = Product::where('is_featured', 1)->get();
        $bestSellers = Product::where('sales_count', '>=', 2)
        ->orderBy('sales_count', 'desc')
        ->take(2)
        ->get();
        return view('index',compact('products','sliders','featuredProducts','bestSellers'));
    }

    public function index()
    {
        return view('registration');
    }

    public function register(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'status' => 'required|string|max:15',
            'email' => 'required|email|unique:user_migration1,email',
            'password' => 'required|string|min:8|',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Register User
        UserModel::RegisterAdd($request);

        return redirect()->route('user.registration')->with('success', 'Registration successful!');
    }

    public function showLoginForm()
    {
        $cartItems = session()->get('cart', []);
        $cartTotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cartItems));
        return view('login',compact('cartTotal'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the user by email
        $user = UserModel::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Store user in session (for manual auth)
            session(['user_id' => $user->id, 'user_name' => $user->f_name,'user_lastname'=>$user->l_name,'user_status'=>$user->status,'address'=>$user->address,'email'=>$user->email,'phone'=>$user->phone]);

            // Redirect to the intended page after login
            return redirect()->intended('/');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }


    public function logout(Request $request)
{
    session()->flush();  // Clear all session data
    return redirect('/');
}



public function Adminloginview()
    {
        return view('index');
    }


    public function Adminloginsend(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the user by email
        $user = UserModel::where('status','email', $request->email,)->first();

        if ($user && Hash::check($request->password, $user->password,$user->status==1)) {
            // Store user in session (for manual auth)
            session(['user_id' => $user->id, 'user_name' => $user->f_name,'user_lastname'=>$user->l_name]);

            // Redirect to the intended page after login
            return view('admin.index');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function accountview()
{
    if (Session::has('user_id')) {
        // Retrieve user information from the session
        $userId = session('user_id');
        $userName = session('user_name');
        $userLastName = session('user_lastname');
        $userAddress = session('address');
        $userEmail = session('email');
        $userPhone = session('phone');

        // Pass the session data to the view
        return view('accounts', [
            'userId' => $userId,
            'userName' => $userName,
            'userLastName' => $userLastName,
            'userAddress' => $userAddress,
            'userEmail' => $userEmail,
            'userPhone' => $userPhone
        ]);
    } else {
        // If no user_id in session, redirect to login or show error message
        return redirect()->route('login')->with('error', 'Please log in to view your account.');
    }
}

public function updateview()
{
    if (Session::has('user_id')) {
        // Retrieve user information from the session
        $userId = session('user_id');
        $userName = session('user_name');
        $userLastName = session('user_lastname');
        $userAddress = session('address');
        $userEmail = session('email');
        $userPhone = session('phone');

        // Pass the session data to the view
        return view('userinfoupdate', [
            'userId' => $userId,
            'userName' => $userName,
            'userLastName' => $userLastName,
            'userAddress' => $userAddress,
            'userEmail' => $userEmail,
            'userPhone' => $userPhone
        ]);
    } else {
        // If no user_id in session, redirect to login or show error message
        return redirect()->route('login')->with('error', 'Please log in to view your account.');
    }
    
}


public function userupdate(Request $request)
{
    // Validate the request data
    $request->validate([
        'userName' => 'required|string|max:255',
        'userEmail' => 'required|email|unique:users,email,' . session('user_id'),
        'userPhone' => 'required|string|max:20',
        'userAddress' => 'required|string|max:255',
    ]);

    // Fetch the user based on session user_id
    $user = UserModel::find(session('user_id'));

    // If user exists, update the user's information
    if ($user) {
        $user->f_name = $request->userName;
        $user->email = $request->userEmail;
        $user->phone = $request->userPhone;
        $user->address = $request->userAddress;

        if ($user->save()) {
            // Update session data
            session([
                'user_name' => $user->f_name,
                'address' => $user->address,
                'email' => $user->email,
                'phone' => $user->phone,
            ]);

            return response()->json(['success' => true, 'message' => 'Account updated successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update account.']);
        }
    } else {
        return response()->json(['success' => false, 'message' => 'User not found.']);
    }
}

}