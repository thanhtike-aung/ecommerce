<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Services\Admin\CustomerServiceInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(
        protected readonly CustomerServiceInterface $customerServiceInterface
    )
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = $this->customerServiceInterface->get();
        return view('pages.admin.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        dd($request->validated());
        $this->customerServiceInterface->create($request->validated());
        return redirect()->route('admin.customer.index')->with('success', 'Customer created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $customer)
    {
        $customer = $this->customerServiceInterface->getById($customer->id);
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $customer)
    {
        return view('pages.admin.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, User $customer)
    {
        $this->customerServiceInterface->update($customer->id, $request->validated());
        return redirect()->route('admin.customer.index')->with('success', 'Customer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customerId = (int)$id;
        $this->customerServiceInterface->delete($customerId);
        return response()->json([
            'success' => true,
            'message' => 'Customer deleted successfully!',
        ]);
    }
}
