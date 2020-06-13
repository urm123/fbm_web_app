<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/5/2018
 * Time: 2:26 PM
 */

namespace App\Http\Controllers;


use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class WebInventoryController
 * @package App\Http\Controllers
 */
class WebInventoryController extends Controller
{
    protected $product;

    protected $user;

    /**
     * WebInventoryController constructor.
     * @param ProductRepository $product_repository
     * @param UserRepository $user_repository
     */
    function __construct(ProductRepository $product_repository, UserRepository $user_repository)
    {
        $this->product = $product_repository;
        $this->user = $user_repository;
        $this->middleware('auth');
        $this->middleware('web_admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addProduct()
    {
        $products = $this->product->getDashboardProducts();
        $json_products = json_encode($products);
        return view('page.inventory.add-product', ['products' => $products, 'json_products' => $json_products]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdateProduct(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'product' => 'required',
            'quantity' => 'numeric',
            'price' => 'required'
        ], $messages);

        $product = $request->product;
        $quantity = $request->quantity;
        $current_quantity = $request->current_quantity;
        $price = $request->price;

        $new_quantity = $current_quantity + $quantity;

        $update_product = $this->product->updateProduct($product, $new_quantity);

        $stock = $this->product->createStock();

        $stock_product = $this->product->addProductsToStock($stock->id, $product, $quantity, $price);

        $request->session()->put('product', 'update');

        if ($update_product && $stock && $stock_product) {
            return redirect('/inventory/product/add-product')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateUpdateProduct(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $validator = Validator::make($request->all(), [
            'product' => 'required',
            'quantity' => 'numeric',
            'price' => 'numeric'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['message' => 'Failed', 'validation' => $validator->messages()]);
        } else {
            return response()->json(['message' => 'Success']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateProduct(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $this->validate($request, [
            'product' => 'string|required',
            'quantity' => 'numeric|required',
            'shortage_alert' => 'numeric|required',
            'price' => 'numeric|required'
        ], $messages);

        $product_name = $request->product;
        $quantity = $request->quantity;
        $shortage_alert = $request->shortage_alert;
        $description = $request->description;
        $price = $request->price;
        $type = $request->type;
        $unit = $request->unit;
        $product_code = $request->product_code;

        $product = $this->product->createProduct($product_name, $price, $quantity, $unit, 1, $shortage_alert, $description, $type, $product_code);

        $stock = $this->product->createStock();

        $stock_product = $this->product->addProductsToStock($stock->id, $product->id, $quantity, $price);

        $request->session()->put('product', 'create');

        if ($product && $stock && $stock_product) {
            return redirect('/inventory/product/add-product')->with(['success' => 'Saved successfully']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateCreateProduct(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required.',
            'string' => 'The :attribute must be a valid text',
            'numeric' => 'The :attribute must be a valid number'
        ];

        $validator = Validator::make($request->all(), [
            'product' => 'string|required',
            'quantity' => 'numeric|required',
            'shortage_alert' => 'numeric|required',
            'price' => 'numeric|required',
            'type' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['message' => 'Failed', 'validation' => $validator->messages()]);
        } else {
            return response()->json(['message' => 'Success']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageInventory()
    {
        $clients = $this->user->getClientsForSupply();
        $products = $this->product->getClientInventoryProducts();
        foreach ($products as $product) {
            $product->selected_products = $this->product->getSelectedProducts($product->product_type);
        }
        $all_products = $this->product->getProducts();
        return view('page.inventory.client-supply', ['clients' => $clients, 'products' => $products, 'all_products' => $all_products]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postAssignToTask(Request $request)
    {

        $client_id = $request->client;

        $client_products = $request->data;

        $all_products = $this->product->getSingleClientInventoryProducts($client_id);

        foreach ($all_products as $product) {
            $product->delete = true;
            foreach ($client_products as $client_product) {
                if ($client_product['id'] == $product->id) {
                    $product->delete = false;
                }
            }
        }

        foreach ($client_products as $client_product) {
            if (isset($client_product['additional_quantity'])) {
                $product_quantity = $this->product->getProduct($client_product['product_id']);
                $remaining_quantity = $product_quantity->qty - $client_product['additional_quantity'];
                $product_update = $this->product->updateProduct($client_product['product_id'], $remaining_quantity);
                if ($client_product['id'] == 'new') {
                    $client_product_result = $this->product->assignProductToClient($client_id, $client_product['product_id'], $client_product['additional_quantity'], $client_product['shortage_alert']);
                } else {
                    $current_client_quantity = $this->product->getSingleClientInventoryProducts($client_id)[0]->quantity;
                    $new_quantity = $current_client_quantity + $client_product['additional_quantity'];
                    $client_product_result = $this->product->updateClientProduct($client_product['id'], $new_quantity, $client_product['shortage_alert']);
                }
            } else {
                $client_product_result = true;
            }
        }

        foreach ($all_products as $product) {
            if ($product->delete) {
                $this->product->deleteClientProduct($product->id);
            }
        }

        return response()->json(['result' => $client_product_result]);

//        $messages = [
//            'required' => 'The :attribute is required.',
//            'string' => 'The :attribute must be a valid text',
//            'numeric' => 'The :attribute must be a valid number'
//        ];
//
//        $this->validate($request, [
//            'client' => 'required',
//            'product' => 'required',
//            'shortage_alert' => 'numeric',
//        ], $messages);
//
//        $client = $request->client;
//        $product = $request->product;
//        $shortage_alert = $request->shortage_alert;
//
//        $product_quantity = $this->product->getProduct($product);
//
//        $this->validate($request, [
//            'quantity' => 'numeric|max:' . $product_quantity->qty
//        ], $messages);
//
//        $quantity = $request->quantity;
//
//
//        $remaining_quantity = $product_quantity->qty - $quantity;
//
//        $product_update = $this->product->updateProduct($product, $remaining_quantity);
//
//      @todo reduce products from the main stock
//
//        if ($client_product) {
//            return redirect('/inventory/product/client-supply')->with(['success' => 'Saved successfully']);
//        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function costMonitoring()
    {
        $products = $this->product->getInventoryProducts();

        $stock_products = $this->product->getProducts();

        foreach ($products as $product) {
            $product->added_date = Carbon::parse($product->added_date)->format('Y-m-d');
        }

        return view('page.inventory.cost-monitoring', ['products' => json_encode($products), 'stock_products' => $stock_products]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postProductCost(Request $request)
    {
        $product_id = $request->product_id;
        $stock_product_id = $request->stock_product_id;

        $name = $request->name;
        $price = $request->price;
        $quantity = $request->quantity;

        $added_date = $request->added_date;

        $update_product_cost = $this->product->updateProductCost($product_id, $name, $price, $quantity, $stock_product_id);

        $last_stock_date = $this->product->getLastStock($product_id);

        $stock_date_update = $this->product->updateLastStockDate($last_stock_date->id, Carbon::parse($added_date)->format('Y-m-d H:i:s'));

        if ($update_product_cost && $stock_date_update) {
            return response()->json(['message' => 'Costing updated successfully!']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function alerts()
    {
        $products = $this->product->getClientsProducts();

        foreach ($products as $product) {
            $remaining_quantity = $product->quantity - $product->shortage_alert;
            if ($remaining_quantity > 0 && $remaining_quantity < 5) {
                $product->alert = 'Yellow';
            } else if ($remaining_quantity == 0 || $remaining_quantity < 0) {
                $product->alert = 'Red';
            } else {
                $product->alert = 'Green';
            }
        }

        return view('page.inventory.alerts', ['products' => $products]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function overview()
    {
        $products = $this->product->getOverviewProducts();
        foreach ($products as $product) {
            $product->added_date = Carbon::parse($product->added_date)->format('Y-m-d');
        }
        return view('page.inventory.overview', ['products' => $products]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxGetProduct(Request $request)
    {
        $product_id = $request->product_id;
        $product = $this->product->getProduct($product_id);
        return response()->json(['product' => $product]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function product()
    {
        $products = $this->product->getProducts();
        foreach ($products as $product) {
            $product->encoded = encrypt($product->id);
        }
        return view('page.inventory.product', ['products' => $products]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editProduct(Request $request)
    {
        $product_id = decrypt($request->product_id);
        $product = $this->product->getProduct($product_id);
        return view('page.inventory.edit-product', ['product' => $product]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteProduct(Request $request)
    {
        $product_id = decrypt($request->product_id);
        $this->product->deleteProduct($product_id);
        return redirect('inventory/product');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postEditProduct(Request $request)
    {
        $product_id = $request->product_id;
        $name = $request->name;
        $unit = $request->unit;
        $update_product = $this->product->editProduct($product_id, $name, $unit);
        if ($update_product) {
            return redirect('inventory/product');
        } else {
            return redirect('admin');
        }
    }
}