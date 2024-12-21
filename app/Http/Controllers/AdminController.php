<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Interfaces\AdminRepositoryInterface;
use App\Http\Requests\userRequest;


class AdminController extends Controller
{
    private $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }


 # View Register
 public function viewRegister()
 {
     return view('admin.create');
 }

    #create
    public function registeradmin(Request $request){
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|string',
            'phone' => 'nullable|string|max:15',
            'shares' => 'integer|min:0', 
            'address' => 'nullable|string|max:255',
        ]);
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return redirect()->back()->withErrors(['email' => 'The email is already in use.']);
        }
        $user = User::create([
            'name' => $request->fname ." ". $request->lname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'NumberOfShares' => $request->shares,
            'address' => $request->address,
        ]);

        // Auth::login($user);
        return redirect('/list')->with('success', 'User Data Inserted Successfully');
    }


    #select
    public function adminView()
    {
        $admins = $this->adminRepository->getAllAdmin(['id', 'name', 'email' ,'role', 'NumberOfShares', 'is_active']);
        return view('admin.list', compact('admins'));
    }
}
