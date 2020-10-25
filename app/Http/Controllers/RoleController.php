<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Exception;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RoleController extends Controller
{
    /**
     * @var Role $roles
     */
    protected $roles;

    /**
     * RoleController constructor.
     * @param Role $roles
     */
    public function __construct(Role $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return Response
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        $roles = $this->roles->filter($frd)->get()->all();
        return Inertia::render('Roles/Index', ['roles' => $roles]);
    }

    /**
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Roles/Create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $frd = $request->all();
        Validator::make($frd, [
            'name' => ['required', Rule::unique('roles')],
            'display_name' => ['required', Rule::unique('roles')],
        ])->validateWithBag('storeRole');
        $this->roles->create([
            'name' => $frd['name'],
            'display_name' => $frd['display_name'],
            'description' => $frd['description'],
        ]);
        return \Redirect::route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param Role $role
     * @return Response
     */
    public function edit(Role $role)
    {
        return Inertia::render('Roles/Edit', ['role' => $role]);
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Role $role)
    {
        $frd = $request->all();
        Validator::make($frd, [
            'name' => ['required', Rule::unique('roles')->ignore($role)],
            'display_name' => ['required', Rule::unique('roles')->ignore($role)],
        ])->validateWithBag('updateRole');
        $role->update([
            'name' => $frd['name'],
            'display_name' => $frd['display_name'],
            'description' => $frd['description'],
        ]);
        return \Redirect::route('roles.index');
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Request $request, Role $role)
    {
        $password = $request->get('password');
        $hashedPassword = Hash::make($password);
        $user = \Auth::user();
        $request->validate([
            'password' => ['required', function ($attribute, $hashedPassword, $fail) use ($user) {
                if (!\Hash::check($hashedPassword, $user->getAuthPassword())) {
                    return $fail(__('Пароль не подходит'));
                }
            }],
        ]);
        $role->delete();
        return \Redirect::route('roles.index');
    }

    /**
     * @return StreamedResponse
     */
    public function export()
    {
        $headers = [
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type' => 'text/csv; charset=UTF-8',
            'Content-Encoding' => 'UTF-8',
            'Content-Disposition' => 'attachment; filename=roles-' . date("Y-m-d H:i:s") . '.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        ];

        $roles = $this->roles->get();
        foreach ($roles as $role) {
            $array = [
                '№' => $role->getKey(),
                'Имя' => $role->getName(),
                'Отоброжаемое имя' => $role->getDisplayName(),
                'Описание' => $role->getDescription(),
            ];
            $list[] = $array;
        }
        $callback = function () use ($list) {
            $flag = false;
            $FH = fopen('php://output', 'wb');
            fprintf($FH, chr(0xEF) . chr(0xBB) . chr(0xBF));

            foreach ($list as $row) {
                if (!$flag){
                    echo implode("\t", array_keys($row)) . "\r\n";
                    $flag = true;
                }
                echo implode("\t", array_values($row)) . "\r\n";
            }
            fclose($FH);
        };

        return response()->stream($callback, 200, $headers);
    }
}
