<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CustomerDishCrossRef;
use App\Events\OrderNotification;

class CustomerController extends Controller
{
    public function getLastKey()
    {
        $customer = Customer::orderBy('customerId', 'desc')->first();
        return $customer->customerId;
    }

    public function saveDishes($arrayDish, $customer)
    {
        $customerDishCrossRefs = [];
        if (gettype($arrayDish) == "string") {
            // "dish" : "[{"dishId":1,"amount":2},{"dishId":2,"amount":3}]"
            $arrayDish = json_decode($arrayDish, true);
        }
        foreach ($arrayDish as $dish) {
            $dishId = $dish['dishId'];
            $amount = $dish['amount'];

            $dish = Dish::where('dishId', '=', $dishId)->first();

            if ($dish != null) {
                $customerDishCrossRefs[] = CustomerDishCrossRef::create([
                    'customerId' => $customer->customerId,
                    'dishId' => $dishId,
                    'amount' => $amount,
                    'promotion' => 0
                ]);
            }
        }
        return $customerDishCrossRefs;
    }
    public function findAll()
    {
        
        $models = Customer::all();
        $customers = [];

        foreach ($models as $model) {
            $customerDishCrossRef = CustomerDishCrossRef::where('customerId', '=', $model->customerId)->get();
            $order = Order::where('customerId', '=', $model->customerId)->first();
            $model->order = $order;
            unset($model["deleted_at"]);
            $model->customerDishCrossRefs = $customerDishCrossRef;
            $customers[] = $model;
        }

        return $customers;
    }
    public function findOne(string $id)
    {
        $model = Customer::find($id);
        if ($model == null) {
            abort(404, 'customer does not exist');
        }
        $customerDishCrossRef = CustomerDishCrossRef::where('customerId', '=', $id)->get();
        $order = Order::where('customerId', '=', $model->customerId)->first();
        $model->order = $order;
        $model->customerDishCrossRefs = $customerDishCrossRef;
        return $model;
    }

    public function findOneTable(string $id)
    {
        $model = DB::table('tableOrder')->where('nameTable', '=', $id)->first();
        if ($model == null) {
            abort(404, 'table does not exist');
        }
        return $model;
    }

    public function findAllTable()
    {
        $models = DB::table('tableOrder')->get();
        return $models;
    }

    public function findAllInvestment()
    {
        $models = DB::table('investment')->get();
        return $models;
    }
    public function createCustomer(Request $request)
    {
        $request->validate([
            'userId' => 'required',
            'name' => 'required',
            'code' => 'required',
            'phoneNumber' => 'required',
            'address' => 'required',
            'dishes' => 'required',
            'promotion' => 'required',
            'statusOrder' => 'required',
            'payments' => 'required',
            'tableId' => 'required',
            // 'created' => 'required',
            'codeStaff' => 'required',
        ]);

        $codeStaff = env('CODE_STAFF');

        if ($request->codeStaff != $codeStaff) {
            abort(404, 'code of staff does not exist');
        }

        if ($request->created != null) {
            $customer = Customer::create([
                'userId' => $request->userId,
                'dateExpireCode' => date('y-m-d', strtotime("+3 day", time() - 86400)),
                'name' => $request->name,
                'code' => md5(microtime()),
                'phoneNumber' => $request->phoneNumber,
                'address' => $request->address,
                'created_at' => $request->created
            ]);
        } else {
            $customer = Customer::create([
                'userId' => $request->userId,
                'dateExpireCode' => date('y-m-d', strtotime("+3 day", time() - 86400)),
                'name' => $request->name,
                'code' => md5(microtime()),
                'phoneNumber' => $request->phoneNumber,
                'address' => $request->address,
            ]);
        }

        Order::create([
            'customerId' => $customer->customerId,
            'status' => $request->statusOrder,
            'promotion' => $request->promotion,
            'payments' => $request->payments,
            'nameTable' => $request->tableId,
        ]);

        $this->saveDishes($request->dishes, $customer);
        
        if ($customer && $request->tableId != "0")
            OrderNotification::dispatch($customer);

        return "success";
    }
    public function createTable(Request $request)
    {
        $request->validate([
            'numberTable' => 'required',
        ]);

        $models = [];

        for ($x = 1; $x <= $request->numberTable; $x++) {
            $models[] = [
                'nameTable' => $x,
                'status' => "Free"
            ];
        }

        DB::table('tableOrder')->truncate();
        DB::table('tableOrder')->insert($models);

        return "success";
    }
    public function createInvestment(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cost' => 'required',
        ]);

        $model = [
            'name' => $request->name,
            'cost' => $request->cost
        ];

        DB::table('investment')->insert($model);

        return "success";
    }
    public function updateCustomer(string $id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'phoneNumber' => 'required',
            'address' => 'required',
            'dishes' => 'required',
            'promotion' => 'required',
            'statusOrder' => 'required',
            'payments' => 'required',
        ]);

        $customerInput = [
            'name' => $request->name,
            'code' => $request->code,
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address,
        ];


        $customerBuilder = Customer::where('customerId', '=', $id);
        $customer = $customerBuilder->first();
        if ($customer == null) {
            abort(404, 'customer does not exist');
        }
        $customer->update($customerInput);

        $orderBuilder = Order::where('customerId', '=', $id);
        $order = $orderBuilder->first();
        $order->update([
            'status' => $request->statusOrder,
            'promotion' => $request->promotion,
            'payments' => $request->payments,
        ]);

        CustomerDishCrossRef::where('customerId', '=', $id)->delete();
        $this->saveDishes($request->dishes, $customer);

        return "success";
    }
    public function updateTable(string $id, Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);
        $table = [
            'nameTable' => $id,
            'status' => $request->status
        ];
        $tableOrderBuilder = DB::table('tableOrder')->where('nameTable', '=', $id);

        if ($tableOrderBuilder->first() == null) {
            abort(404, 'table does not exist');
        }
        $tableOrderBuilder->update($table);

        return "success";
    }
    public function deleteCustomer(string $id)
    {
        $order = Order::where('customerId', '=', $id)->first();
        $customerBuilder = Customer::where('customerId', '=', $id);
        $customerDishCrossRefBuilder = CustomerDishCrossRef::where('customerId', '=', $id);
        $customer = $customerBuilder->first();
        if ($customer == null) {
            abort(404, 'customer does not exist');
        }
        $customer->delete();
        $order->delete();
        // $customerDishCrossRefBuilder->delete();
        return "success";
    }
    public function deleteInvestment(string $id)
    {
        $investmentBuilder = DB::table('investment')->where('name', '=', $id);
        $investment = $investmentBuilder->first();
        if ($investment == null) {
            abort(404, 'investment does not exist');
        }
        $investmentBuilder->delete();

        return "success";
    }
}
