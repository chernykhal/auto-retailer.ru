<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CarController extends Controller
{

    /**
     * @var Car $cars
     */
    protected $cars;

    /**
     * CarController constructor.
     * @param Car $cars
     */
    public function __construct(Car $cars)
    {
        $this->cars = $cars;
    }


    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        $cars = $this->cars->filter($frd)->orderbyDesc('id')->get()->all();
        return Inertia::render('Cars/Index', ['cars' => $cars]);
    }

    /**
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Cars/Create');
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
            'registration_number' => ['required', Rule::unique('cars')],
            'brand' => ['required', 'max:100'],
            'model' => ['required', 'max:100'],
            'year' => ['required', 'max:100'],
            'price' => ['required', 'max:100', Rule::unique('cars')],
        ])->validateWithBag('storeCar');
        $this->cars->create([
            'registration_number' => $frd['registration_number'],
            'brand' => $frd['brand'],
            'model' => $frd['model'],
            'year' => $frd['year'],
            'price' => $frd['price'],
        ]);
        return \Redirect::route('cars.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Car $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * @param Car $car
     * @return Response
     */
    public function edit(Car $car)
    {
        return Inertia::render('Cars/Edit', ['car' => $car]);
    }

    /**
     * @param Request $request
     * @param Car $car
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Car $car)
    {
        $frd = $request->all();
        Validator::make($frd, [
            'registration_number' => ['required', Rule::unique('cars')->ignore($car)],
            'brand' => ['required', 'max:100'],
            'model' => ['required', 'max:100'],
            'year' => ['required', 'max:100'],
            'price' => ['required', 'max:100', Rule::unique('cars')->ignore($car)],
        ])->validateWithBag('storeCar');
        $car->update([
            'registration_number' => $frd['registration_number'],
            'brand' => $frd['brand'],
            'model' => $frd['model'],
            'year' => $frd['year'],
            'price' => $frd['price'],
        ]);
        return \Redirect::route('cars.index');
    }

    /**
     * @param Request $request
     * @param Car $car
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Car $car)
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
        $car->delete();
        return \Redirect::route('cars.index');
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
            'Content-Disposition' => 'attachment; filename=cars-' . date("Y-m-d H:i:s") . '.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        ];

        $cars = $this->cars->get();
        foreach ($cars as $car) {
            $array = [
                '№' => $car->getKey(),
                'Регистрационный номер' => $car->getRegistrationNumber(),
                'Марка' => $car->getBrand(),
                'Модель' => $car->getModel(),
                'Год' => $car->getYear(),
                'Цена' => $car->getPrice(),
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
