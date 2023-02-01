<?php

namespace App\Http\Controllers;
use App\DataTables\UsersDataTable;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        $this->authorize('read role');

        
        return $dataTable->render('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        return view('users.users-action',["role"=>$role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;
    
        $default_user_value = [
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];

        DB::beginTransaction();
        try {
            $account = User::create(array_merge([
                'email' => $email,
                'name' => $name,
                "password" => $password
            ], $default_user_value));
    
            $account->assignRole($role);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'massage' => 'Create data successfully'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
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
        $role = Role::all();
        return view('users.users-action',["user"=>$user, "role"=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, User $user)
    {
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
      
        $user->save();
        $user->syncRoles($request->role);
   

        return response()->json([
            'status' => 'success',
            'massage' => 'Update data successfully'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'status' => 'success',
            'massage' => 'Delete data successfully'
        ]);
    }
}
