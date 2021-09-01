<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\SupervisorDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('roleUser:Admin')->except(['select','edit','editprofile','uploadImage']);
    }
    public function select(Request $request)
    {
        $search = $request->q;
        $query = User::orderby('name', 'asc')->select('id', 'name');
        if ($search != '') {
            $query = $query->where('name', 'like', '%' . $search . '%');
        }
        $users = $query->get();

        $response = [];
        foreach ($users as $user) {
            $response['results'][] = [
                "id" => $user->id,
                "text" => $user->name
            ];
        }

        return response()->json($response);
    }
    public function selectSupervisor(Request $request)
    {
        $search = $request->q;
        $query = User::orderby('name', 'asc')->where('role', 'Supervisor')->select('id', 'name');
        if ($search != '') {
            $query = $query->where('name', 'like', '%' . $search . '%');
        }
        $users = $query->get();

        $response = [];
        foreach ($users as $user) {
            $response['results'][] = [
                "id" => $user->id,
                "text" => $user->name
            ];
        }

        return response()->json($response);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            $no = 1;
            $data2 = [];
            foreach ($data as $row) {
                $row->no = $no++;
                $data2[] = $row;
            }
            return DataTables::of($data2)
                ->addColumn('no', function ($row) {
                    $no = $row->no;
                    return $no;
                })
                ->addColumn('status', function($row){
                    if($row->status)
                        return '<small class="label label-success">active</small>';
                    else
                        return '<small class="label label-danger">inactive</small>';
                })
                ->addColumn('action', function($row){
                    $updateable = 'button';
                    $updateValue = $row->id;
                    if ($row->role != 'Admin'){
                        $deleteable = true;
                        $deleteId = $row->id;
                        return view('components.action-button', compact(['updateable', 'updateValue','deleteable', 'deleteId']));
                    }else
                        return view('components.action-button', compact(['updateable', 'updateValue']));
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('pages.admin.users.index');
    }

    public function getSupervisorDetailComplete()
    {
        if (auth()->user()->role == 'Supervisor'){
            $detail = SupervisorDetail::where('user_id', auth()->user()->id)
                ->whereNotNull(['full_name','gender','number_phone','address','last_education','province_id','involved','skill','profile_link'])
                ->get();
            $returning = count($detail) > 0 ? true : false;
            return $returning;
        } else
            return true;
    }

    public function getSupervisors()
    {
        $supervisors = User::where('role', 'Supervisor')->has('detailSupervisor')
        ->with('detailSupervisor','detailSupervisor.province')->get();
        return $supervisors;
    }
    public function getUserJurnals()
    {
        $supervisors = User::where('role', 'User Jurnal')->get();
        return $supervisors;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'max:50', 'email:rfc,dns', 'unique:users,email'],
            'role' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($request->status) {
            $status = 1;
        }
        else {
            $status = 0;
        }

        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'status' => $status,
        ]);
        return response()->json(['success' => 'User data has been added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = User::find($id);
            // $detail = User::find(auth()->user()->id);
            return response()->json([
                'status'     => true,
                'data' => $user
            ], 200);
        }
    }
    public function editprofile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:100', 'unique:users,email'],
            'email' => 'required|email|unique:users,email,' . $id . '|max:100',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'success'     => 'User data updated successfully. Please refresh this page to get changed !',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->ajax()) {
//            if ($user->password == $request->password) {
//                $request->merge(['password' => $user->password]);
//            } else {
//                $request->merge(['password' => bcrypt($request->password)]);
//            }

            if ($request->password == null){
                $request->validate([
                    'name' => ['required', 'max:100', 'unique:users,email'],
                    'email' => 'required|email|unique:users,email,' . $user->id . '|max:100',
                    'role' => ['required', 'string'],
                ]);
                User::where('id', $user->id)
                    ->update([
                        'email' => $request->email,
                        'name' => $request->name,
                        'role' => $request->role,
                        'status' => $request->status == "on" ? true : false,
                ]);
            }else{
                $request->validate([
                    'name' => ['required', 'max:100', 'unique:users,email'],
                    'email' => 'required|email|unique:users,email,' . $user->id . '|max:100',
                    'role' => ['required', 'string'],
                    'password' => ['required', 'string', 'min:8'],
                ]);
                User::where('id', $user->id)
                    ->update([
                        'email' => $request->email,
                        'name' => $request->name,
                        'role' => $request->role,
                        'password' => bcrypt($request->password),
                        'status' => $request->status == "on" ? true : false,
                ]);
            }
        }
        return response()->json(['success' => 'User data updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return response()->json(['success' => 'User Data has been Deleted']);
    }

    public function uploadImage(Request $request){
        if($request->ajax()) {
            $data = $request->file('file');
            $extension = $data->getClientOriginalExtension();
            $filename = 'user_' . $request->user()->email . '.' . $extension;
            $path = public_path('uploads/user/img/');

            $usersImage = public_path("uploads/user/img/{$filename}"); // get previous image from folder

            if (File::exists($usersImage)) { // unlink or remove previous image from folder
                unlink($usersImage);
            }
            $successText = 'Your profile picture successfully changed!';

            User::where('id', $request->user()->id)
                ->update([
                    'image' => $filename,
                ]);

            $data->move($path, $filename);

            return response()->json(['success' => $successText]);
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current' => ['required', new MatchOldPassword()],
            'new' => ['required', 'string', 'max:255'],
            'confirm' => ['same:new'],
        ]);

        User::where('id', $request->user()->id)
            ->update([
                'password' => bcrypt($request->new),
            ]);

        return response()->json(['success' => 'Your password successfully changed!']);
    }

}
