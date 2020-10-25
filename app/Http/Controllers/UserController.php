<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Exception;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Redirect;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{

    /**
     * @var User $users
     */
    protected $users;

    /**
     * RoleController constructor.
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }


    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        $users = $this->users->with('roles')->filter($frd)->orderbyDesc('id')->get()->all();
        return Inertia::render('Users/Index', ['users' => $users]);
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
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', ['user' => $user]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @throws ValidationException
     */
    public function update(Request $request, User $user)
    {
        $frd = $request->all();
        Validator::make($frd, [
            'inn' => ['required', 'digits_between:1,255', Rule::unique('users')->ignore($user)],
            'f_name' => ['required', 'string', 'max:255',],
            'l_name' => ['required', 'string', 'max:255',],
            'm_name' => ['required', 'string', 'max:255',],
            'adress' => ['required', 'string', 'max:255',],
            'phone' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user)],
            'photo' => ['nullable', 'image', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }
        $user->update([
            'inn' => $frd['inn'],
            'f_name' => $frd['f_name'],
            'l_name' => $frd['l_name'],
            'm_name' => $frd['m_name'],
            'employ_date' => $frd['employ_date'],
            'employ_document_date' => $frd['employ_document_date'],
            'employ_document_number' => $frd['employ_document_number'],
            'department_id' => $frd['department_id'],
            'salary' => $frd['salary'],
            'phone' => $frd['phone'],
            'adress' => $frd['adress'],
        ]);
        return Redirect::route('users.index');
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Request $request, User $user)
    {
        $password = $request->get('password');
        $hashedPassword = Hash::make($password);
        $authUser = Auth::user();
        $request->validate([
            'password' => ['required', function ($attribute, $hashedPassword, $fail) use ($authUser) {
                if (!Hash::check($hashedPassword, $authUser->getAuthPassword())) {
                    return $fail(__('Пароль не подходит'));
                }
            }],
        ]);
        $user->delete();
        return Redirect::route('users.index');
    }

    /**
     * @param User $user
     * @return Response
     */
    public function workDays(User $user)
    {
        $workDays = $user->workDays()->get()->first()->only(['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30']);
        return Inertia::render('Users/WorkDays', ['workDays' => $workDays, 'user' => $user]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function workDaysStore(Request $request, User $user)
    {
        $frd = $request->all();
        $user->workDays()->update($frd);
        return Redirect::route('users.index');
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
            'Content-Disposition' => 'attachment; filename=users-' . date("Y-m-d H:i:s") . '.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        ];

        $users = $this->users->get();
        foreach ($users as $user) {
            $array = [
                '№' => $user->getKey(),
                'ИНН' => $user->getInn(),
                'Фамилия' => $user->getLName(),
                'Имя' => $user->getFName(),
                'Отчество' => $user->getMName(),
                'Адрес' => $user->getAdress(),
                'Телефон' => $user->getPhone(),
                'Дата приема на работу' => $user->getEmployDate(),
                'Дата документа о приеме на работу' => $user->getEmployDocumentDate(),
                'Номер документа о приеме на работу' => $user->getEmployDocumentNumber(),
                'Номер отдела' => $user->getDepartmentId(),
                'Зарплата' => $user->getSalary(),
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
