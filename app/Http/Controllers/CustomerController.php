<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Auth;
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

class CustomerController extends Controller
{

    /**
     * @var Customer $roles
     */
    protected $customers;

    /**
     * RoleController constructor.
     * @param Customer $customers
     */
    public function __construct(Customer $customers)
    {
        $this->customers = $customers;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        $customers = $this->customers->filter($frd)->orderbyDesc('id')->get()->all();
        return Inertia::render('Customers/Index', ['customers' => $customers]);
    }

    /**
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Customers/Create');
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
            'inn' => ['required', Rule::unique('customers')],
            'f_name' => ['required', 'max:100'],
            'l_name' => ['required', 'max:100'],
            'm_name' => ['required', 'max:100'],
            'phone' => ['required', 'max:100', Rule::unique('customers')],
            'adress' => ['max:100'],
        ])->validateWithBag('storeCustomer');
        $this->customers->create([
            'inn' => $frd['inn'],
            'f_name' => $frd['f_name'],
            'l_name' => $frd['l_name'],
            'm_name' => $frd['m_name'],
            'phone' => $frd['phone'],
            'adress' => $frd['adress'],
        ]);
        return Redirect::route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * @param Customer $customer
     * @return Response
     */
    public function edit(Customer $customer)
    {
        return Inertia::render('Customers/Edit', ['customer' => $customer]);
    }

    /**
     * @param Request $request
     * @param Customer $customer
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Customer $customer)
    {
        $frd = $request->all();
        Validator::make($frd, [
            'inn' => ['required', Rule::unique('customers')->ignore($customer)],
            'f_name' => ['required', 'max:100'],
            'l_name' => ['required', 'max:100'],
            'm_name' => ['required', 'max:100'],
            'phone' => ['required', 'max:100', Rule::unique('customers')->ignore($customer)],
            'adress' => ['max:100'],
        ])->validateWithBag('updateCustomer');
        $customer->update([
            'inn' => $frd['inn'],
            'f_name' => $frd['f_name'],
            'l_name' => $frd['l_name'],
            'm_name' => $frd['m_name'],
            'phone' => $frd['phone'],
            'adress' => $frd['adress'],
        ]);
        return Redirect::route('customers.index');
    }

    /**
     * @param Request $request
     * @param Customer $customer
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Customer $customer)
    {
        $password = $request->get('password');
        $hashedPassword = Hash::make($password);
        $user = Auth::user();
        $request->validate([
            'password' => ['required', function ($attribute, $hashedPassword, $fail) use ($user) {
                if (!Hash::check($hashedPassword, $user->getAuthPassword())) {
                    return $fail(__('Пароль не подходит'));
                }
            }],
        ]);
        $customer->delete();
        return \Redirect::route('customers.index');
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
            'Content-Disposition' => 'attachment; filename=customers-' . date("Y-m-d H:i:s") . '.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        ];

        $customers = $this->customers->get();
        foreach ($customers as $customer) {
            $array = [
                '№' => $customer->getKey(),
                'ИНН' => $customer->getInn(),
                'Фамилия' => $customer->getLName(),
                'Имя' => $customer->getFName(),
                'Отчество' => $customer->getMName(),
                'Адрес' => $customer->getAdress(),
                'Телефон' => $customer->getPhone(),
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
