<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Products;

class ProductController extends Controller
{
    public static function countProducts()
    {
        return Products::where('status', 1)->count();
    }

    public function index()
    {
        return view('products/index', [
            'title' => 'Products',
            'totalProducts' => self::countProducts(),
        ]);
    }

    public function fetch(Request $request, Products $products)
    {
        $draw   = intval($request->input('draw'));
        $start  = intval($request->input('start'));
        $length = intval($request->input('length'));
        $search = trim($request->input('search')['value'] ?? '');
        
        // Total user count
        $totalRecords = $products::count();
        
        // Filtered total user count
        $totalRecordsWithFilter = $products::query()
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })->count();

        // Fetch filtered records
        $records = $products::selectRaw('id, title, description, price, status,
            DATE_FORMAT(created_at, "%e-%b-%y, %l:%i %p") AS createdAt, DATE_FORMAT(updated_at, "%e-%b-%y, %l:%i %p") AS updatedAt')
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderByDesc('id')
            ->offset($start)
            ->limit($length)
            ->get();

        // Formatting data for response
        $data = [];
        $sn   = ( ! empty($start)) ? $start + 1 : 1;
        foreach ($records as $record) {
            $data[] = [
                'id'            => $record->id,
                'sno'           => $sn,
                'title'         => '<div class="d-flex justify-content-start align-items-center product-name">
                                        <div class="d-flex flex-column">
                                            <h6 class="text-nowrap mb-0">'. $record->title .'</h6>
                                        </div>
                                    </div>',
                'description'   => '<div class="d-flex justify-content-start align-items-center product-name">
                                        <div class="d-flex flex-column">
                                            <small class="text-truncate d-none d-sm-block" data-bs-toggle="popover" data-bs-placement="right" data-bs-custom-class="custom-popover" title="'. $record->title .'" data-bs-content="'. $record->description .'">'. Str::of($record->description)->limit(25) .'</small>
                                        </div>
                                    </div>',
                'price'         => $record->price,
                'status'        => $record->status 
                                    ? '<button type="button" class="btn btn-xs rounded-pill btn-success waves-effect waves-light ActiveStatus" data-id="' . $record->id . '" data-ajax="' . url('/products/inactive') . '">Active</button>' 
                                    : '<button type="button" class="btn btn-xs rounded-pill btn-danger waves-effect waves-light InactiveStatus" data-id="' . $record->id . '" data-ajax="' . url('/products/active') . '">Inactive</button>',
                'created_at'    => $record->createdAt,
                'updated_at'    => $record->updatedAt
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

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|max:255|unique:products,title',
            'description' => 'required|max:500',
            'price'       => 'required|numeric|min:0',
            'date_available' => 'nullable|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => FALSE, 'message' => $validator->messages()]); exit;
        }
        $validated = $validator->validated();
        $product = Products::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'price'       => $validated['price'] ?? 0,
            'date_available' => $validated['date_available'] ?? null,
            'created_by'  => session()->get('id'),
        ]);
        if ($product) {
            return response()->json(['success' => TRUE, 'message' => 'Product added successfully.']);
        } else {
            return response()->json(['success' => FALSE, 'message' => 'Failed to add product.']);
        }
    }

    public function active()
    {
        $validator = Validator::make(request()->all(), [
            'id' => 'required|numeric|exists:products,id'
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => FALSE, 'message' => $validator->messages()]); exit;
        }
        $validated = $validator->validated();
        $id = $validated['id'];
        $product = Products::find($id);
        if ($product):
            $product->status = 1;
            $product->save();
            return response()->json(['success' => TRUE, 'message' => 'Product Activated Successfully']);
        else:
            return response()->json(['success' => FALSE, 'message' => 'Product Not Found']);
        endif;
    }

    public function inactive()
    {
        $validator = Validator::make(request()->all(), [
            'id' => 'required|numeric|exists:products,id'
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => FALSE, 'message' => $validator->messages()]); exit;
        }
        $validated = $validator->validated();
        $id = $validated['id'];
        $product = Products::find($id);
        if ($product):
            $product->status = 0;
            $product->save();
            return response()->json(['success' => TRUE, 'message' => 'Product Inactivated Successfully']);
        else:
            return response()->json(['success' => FALSE, 'message' => 'Product Not Found']);
        endif;
    }

    public function delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => 'required|numeric|exists:products,id'
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => FALSE, 'message' => $validator->messages()]); exit;
        }
        $validated = $validator->validated();
        $id = $validated['id'];
        $product = Products::find($id);
        if ($product):
            $product->delete();
            return response()->json(['success' => TRUE, 'message' => 'Product Deleted Successfully']);
        else:
            return response()->json(['success' => FALSE, 'message' => 'Product Not Found']);
        endif;
    }
}
