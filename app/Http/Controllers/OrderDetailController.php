<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderDetailRequest;
use App\Mail\OrderCreated;
use App\Repositories\OrderDetailRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderDetailController extends Controller
{
    private $orderDetailRepository;

    public function __construct(OrderDetailRepository $orderDetailRepository)
    {
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function index()
    {
        try {
            $orderDetails = $this->orderDetailRepository->all();
            return response()->json($orderDetails);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $orderDetail = $this->orderDetailRepository->find($id);
            return response()->json($orderDetail);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(OrderDetailRequest $request)
    {
        try {
            $data = $request->all();
            $orderDetail = $this->orderDetailRepository->create($data);

            \Mail::to($orderDetail->order->customer->email)->send(new OrderCreated($orderDetail));

            return response()->json($orderDetail, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(OrderDetailRequest $request, $id)
    {
        try {
            $data = $request->all();
            $orderDetail = $this->orderDetailRepository->update($id, $data);
            return response()->json($orderDetail);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->orderDetailRepository->delete($id);
            return response()->json(['message' => 'Order detail deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
