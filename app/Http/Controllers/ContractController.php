<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Redirect;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContractController extends Controller
{

    /**
     * @var Contract $contracts
     */
    protected $contracts;

    /**
     * @var Customer $roles
     */
    protected $customers;

    /**
     * @var User $users
     */
    protected $users;

    /**
     * @var Car $cars
     */
    protected $cars;

    /**
     * ContractController constructor.
     * @param Contract $contracts
     * @param Customer $customers
     * @param User $users
     * @param Car $cars
     */
    public function __construct(Contract $contracts, Customer $customers, User $users, Car $cars)
    {
        $this->contracts = $contracts;
        $this->customers = $customers;
        $this->users = $users;
        $this->cars = $cars;
    }


    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        $contracts = $this->contracts->with(['customer', 'user', 'car'])->filter($frd)->orderbyDesc('id')->get()->all();
        return Inertia::render('Contracts/Index', ['contracts' => $contracts]);
    }

    /**
     * @return Response
     */
    public function create()
    {
        $usersList = User::getList();
        $customersList = Customer::getList();
        $carsList = Car::getList();
        return Inertia::render('Contracts/Create', ['usersList' => $usersList, 'customersList' => $customersList, 'carsList' => $carsList]);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $frd = $request->all();
        Validator::make($frd, [
            'car_id' => ['required'],
            'date' => ['required', 'date'],
            'customer_id' => ['required'],
            'user_id' => ['required'],
        ])->validateWithBag('storeContract');
        $this->contracts->create([
            'car_id' => $frd['car_id'],
            'date' => $frd['date'],
            'customer_id' => $frd['customer_id'],
            'user_id' => $frd['user_id'],
        ]);
        return Redirect::route('contracts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * @param Contract $contract
     * @return Response
     */
    public function edit(Contract $contract)
    {
        $usersList = User::getList();
        $customersList = Customer::getList();
        $carsList = Car::getList();
        return Inertia::render('Contracts/Edit', ['contract' => $contract,'usersList' => $usersList, 'customersList' => $customersList, 'carsList' => $carsList]);
    }

    /**
     * @param Request $request
     * @param Contract $contract
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Contract $contract)
    {
        $frd = $request->all();
        Validator::make($frd, [
            'car_id' => ['required'],
            'date' => ['required', 'date'],
            'customer_id' => ['required'],
            'user_id' => ['required'],
        ])->validateWithBag('updateContract');
        $contract->update([
            'car_id' => $frd['car_id'],
            'date' => $frd['date'],
            'customer_id' => $frd['customer_id'],
            'user_id' => $frd['user_id'],
        ]);
        return Redirect::route('contracts.index');
    }

    /**
     * @param Request $request
     * @param Contract $contract
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Contract $contract)
    {
        $password = $request->get('password');
        $hashedPassword = \Hash::make($password);
        $user = \Auth::user();
        $request->validate([
            'password' => ['required', function ($attribute, $hashedPassword, $fail) use ($user) {
                if (!\Hash::check($hashedPassword, $user->getAuthPassword())) {
                    return $fail(__('Пароль не подходит'));
                }
            }],
        ]);
        $contract->delete();
        return \Redirect::route('contracts.index');
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
            'Content-Disposition' => 'attachment; filename=contracts-' . date("Y-m-d H:i:s") . '.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        ];

        $contracts = $this->contracts->get();
        foreach ($contracts as $contract) {
            $array = [
                '№' => $contract->getKey(),
                'Регистрационный номер машины' => $contract->getCar()->getRegistrationNumber(),
                'Дата контракта' => $contract->getDate(),
                'Цена контракта' => $contract->getCar()->getPrice(),
                'ИНН покупателя' => $contract->getCustomer()->getInn(),
                'ИНН продавца' => $contract->getUser()->getInn(),
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
