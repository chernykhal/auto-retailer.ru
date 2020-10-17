<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $password = $request->only('password');

        $role->delete();
        $roles = $this->roles->get()->all();
        return \Redirect::route('roles.index');
    }
}
