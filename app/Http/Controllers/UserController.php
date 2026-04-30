<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public static function countAccounts()
    {
        return User::count();
    }

    public function index()
    {
        return ($this->isLogin()) ? redirect('/dashboard') : view('index');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'email'    => 'required|email|exists:users,email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => FALSE, 'message' => $validator->messages()]); exit;
        }
        $validated = $validator->validated();
        $email     = $validated['email'];
        $password  = $validated['password'];
        $user      = User::where('email', $email)->first();
        if ($user) {
            if (password_verify($password, $user->password)) {
                $request->session()->put('id', $user->id);
                $request->session()->put('name', $user->name);
                $request->session()->put('email', $user->email);
                $request->session()->put('type', $user->role);
                $request->session()->put('isLogIn', TRUE);
                return response()->json(['success' => TRUE, 'redirectUrl' => url('/dashboard'), 'message' => 'Login successful! Redirecting to the Dashboard.']); exit;
            } else {
                return response()->json(['success' => FALSE, 'message' => 'Invalid email or password.']); exit;
            }
        } else {
            return response()->json(['success' => FALSE, 'message' => 'Invalid email or password.']); exit;
        }
    }

    public function registration(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:user,admin',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => FALSE, 'message' => $validator->messages()]); exit;
        }
        $validated = $validator->validated();
        $name      = $validated['name'];
        $role      = $validated['role'];
        $email     = $validated['email'];
        $password  = password_hash($validated['password'], PASSWORD_DEFAULT);
        User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => $password,
            'role'     => $role,
        ]);
        return response()->json(['success' => TRUE, 'redirectUrl' => url('/login'), 'message' => 'Registration successful! Redirecting to the Login page.']); exit;
    }

    public function accountsList()
    {
        if (!$this->isLogin()) {
            return redirect('/login');
        } elseif (session()->get('type') !== 'admin') {
            return redirect('/dashboard');
        }
        return view('accounts/index', [
            'title' => 'Accounts',
        ]);
    }

    public function fetch(Request $request)
    {
        $draw   = intval($request->input('draw'));
        $start  = intval($request->input('start'));
        $length = intval($request->input('length'));
        $search = trim($request->input('search')['value'] ?? '');

        // Total user count
        $totalRecords = User::count();

        // Filtered total user count
        $totalRecordsWithFilter = User::query()
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            })->count();

        // Fetch filtered records
        $records = User::selectRaw('id, name, email, role, DATE_FORMAT(created_at, "%e-%b-%y, %l:%i %p") AS createdAt')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            })
            ->orderByDesc('id')
            ->limit($length)
            ->offset($start)
            ->get();

        // Formatting data for response
        $data = [];
        $sn   = ( ! empty($start)) ? $start + 1 : 1;
        foreach ($records as $record) {
            $data[] = [
                'sno'        => $sn,
                'id'         => $record->id,
                'name'       => '<div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="d-flex flex-column">
                                        <span class="fw-medium">'. $record->name .'</span>
                                    </div>
                                </div>',
                'email'      => $record->email,
                'role'       => $record->role,
                'loginType'  => ($record->role == 'admin')
                    ? '<span class="text-truncate d-flex align-items-center text-heading"><i class="ri-computer-line ri-22px text-danger me-2"></i>Admin</span>'
                    : '<span class="text-truncate d-flex align-items-center text-heading"><i class="ri-user-line ri-22px text-success me-2"></i>User</span>',
                'created_at' => $record->createdAt,
            ];
            $sn++;
        }

        return response()->json([
            "draw"            => $draw,
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordsWithFilter,
            "data"            => $data
        ]);
    }

    public function delete()
    {
        if ($this->isLogin() && session()->get('type') === 'admin'):
            $validator = Validator::make(request()->all(), [
                'id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => FALSE, 'message' => $validator->messages()]); exit;
            }
            $validated = $validator->validated();
            $id    = $validated['id'];
            $model = User::find($id);
            if ($model):
                if ($model->delete()):
                    return response()->json(['success' => TRUE, 'message' => 'Account Deleted Successfully']);
                else:
                    return response()->json(['success' => FALSE, 'message' => 'Failed to Delete Account']);
                endif;
            else:
                return response()->json(['success' => FALSE, 'message' => 'Account Not Found']);
            endif;
        else:
            return response()->json(['success' => FALSE, 'message' => 'You are not authorized to perform this action']);
        endif;
    }
}
