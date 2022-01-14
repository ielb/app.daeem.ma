<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class UserController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $users = User::where('role', 'admin')->where('id' ,'!=',$user_id)->latest()->get();
        return view('auth.index', ['users' =>  $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
            $request->validate( [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'regex:/(\+212|0)([ \-_\/]*)(\d[ \-_\/]*){9}/','unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]);
            $data = $request->all();
    
            $user =  User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'role' => 'admin',
                'status' => 1,
                'remember_token' => Str::random(60),
                'password' => Hash::make($data['password']),
            ]);
    
            // $user->assignRole('admin');
            $token = $user->createToken('apptoken')->plainTextToken;
    
            $response = [
                'user' => $user,
                'token' => $token
            ];
    
          //  return $response;
            return redirect()->route('auth.index')->withStatus(__('User successfully created.'));
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

    
        return view('auth.edit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deactivate(User $user)
    {
        $user->status = 0;
        $user->save();

        return redirect()->route('auth.index')->withStatus(__('User successfully deactivated.'));
    }

    public function activate(User $user)
    {
        $user->status = 1;
        $user->update();

        return redirect()->route('auth.index')->withStatus(__('User successfully activated.'));
    }

    public function update(Request $request, $id)
    {
        //
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'phone' => ['required', 'string', 'regex:/(\+212|0)([ \-_\/]*)(\d[ \-_\/]*){9}/'],
        ]);
        $data = $request->all();

        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->update();
        return redirect()->route('auth.edit')->withStatus(__('User updated successfully.'));

        
    }

    public function driverLocation(User $user,Request $request)
    {
        # code...
        if(auth()->user()->role == "driver" && auth()->user()->working == 1){
            $id = auth()->user()->id;
            $data = $request->all();
            $user = User::find($id);
            $user->lat = $data['lat'];
            $user->lng = $data['lng'];
            $user->update();
        }else{
            return response()->json([
                'status' => false,
                'msg' => '',
            ]);
        }
        
        return response()->json([
            'status' => true,
            'msg' => '',
        ]);

    }

    public function driversLocations()
    {
        //TODO - Method for admin onlt
        if (! auth()->user()->role == "admin") {
            abort(403);
        }

        $toRespond = [
            'drivers'=> User::select('id','name','lat','lng')->where([['status','=','1'],['role' ,'=', 'driver'],['working','=','1']])->get(),
        ];

        return response()->json($toRespond);
    }


    public function password(Request $request)
    {
        
        $user = Auth::user();
        $userPassword = $user->password;
        $request->validate([
            'current_password' => ['required','min:8'],
            'new_password' => ['required','same:confirm_password','min:8'],
            'confirm_password' => ['required','min:8'],
        ]);

        if (!Hash::check($request->current_password, $userPassword)) {
            return redirect()->route('auth.edit')->withError(__('Password not match.'));
        }

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('auth.edit')->withStatus(__('Password updated successfully.'));

        
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

    public function logOut() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function support()
    {
        return view('support.create');
    }
}
