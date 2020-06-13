<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 11/14/2017
 * Time: 4:51 PM
 */

namespace App\Repositories;


use App\Product;
use App\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    /**
     * @return mixed
     */
    public function getDashboardProducts()
    {
        return DB::select(DB::raw("SELECT
  max(products.id)         AS id,
  max(products.name)       AS name,
  max(products.qty)        AS qty,
  max(stock_product.price) AS price,
  max(products.type)       AS type,
  max(products.units)      AS units
FROM products
  INNER JOIN stock_product ON products.id = stock_product.product_id
GROUP BY products.id
ORDER BY max(stock_product.created_at) DESC;"));
    }

//    public function getInventoryProducts(){
//        return
//    }

    /**
     * @param int $product_id
     * @param int $quantity
     * @return mixed
     */
    public function updateProduct($product_id = 0, $quantity = 0)
    {
        return Product::where('id', '=', $product_id)->update([
            'qty' => $quantity
        ]);
    }

    /**
     * @return mixed
     */
    public function getClientInventoryProducts()
    {
        return DB::select(DB::raw("SELECT 
  products.name AS product_name,
  products.type AS product_type,
  client_product.quantity,
  client_product.shortage_alert,
  client_product.client_id,
  products.id AS product_id,
  client_product.id AS id
FROM products
  INNER JOIN client_product ON products.id = client_product.product_id"));
    }

    /**
     * @param int $client_id
     * @return mixed
     */
    public function getSingleClientInventoryProducts($client_id = 0)
    {
        return DB::select(DB::raw("SELECT 
  products.name AS product_name,
  products.type AS product_type,
  client_product.quantity,
  client_product.shortage_alert,
  client_product.client_id,
  products.id AS product_id,
  client_product.id AS id
FROM products
  INNER JOIN client_product ON products.id = client_product.product_id
  where client_id=$client_id"));
    }

    /**
     * @param string $name
     * @param int $price
     * @param int $qty
     * @param string $units
     * @param int $available
     * @param int $shortage_alert
     * @param string $description
     * @param string $type
     * @param string $product_code
     * @return mixed
     */
    public function createProduct($name = '', $price = 0, $qty = 0, $units = '', $available = 1, $shortage_alert = 0, $description = '', $type = '', $product_code = '')
    {
        return Product::create([
            'name' => $name,
            'price' => $price,
            'qty' => $qty,
            'units' => $units,
            'available' => $available,
            'shortage_alert' => $shortage_alert,
            'description' => $description,
            'type' => $type,
            'product_code' => $product_code,
        ]);
    }

    /**
     * @param int $client_id
     * @param int $product_id
     * @param int $quantity
     * @param int $shortage_alert
     * @return mixed
     */
    public function assignProductToClient($client_id = 0, $product_id = 0, $quantity = 0, $shortage_alert = 0)
    {
        return DB::table('client_product')->insert([
            'client_id' => $client_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'shortage_alert' => $shortage_alert,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * @param int $client_product_id
     * @param int $quantity
     * @param int $shortage_alert
     * @return mixed
     */
    public function updateClientProduct($client_product_id = 0, $quantity = 0, $shortage_alert = 0)
    {
        return DB::table('client_product')
            ->where('id', '=', $client_product_id)
            ->update([
                'quantity' => $quantity,
                'shortage_alert' => $shortage_alert,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
    }

    /**
     * @param int $client_product_id
     * @return mixed
     */
    public function deleteClientProduct($client_product_id = 0)
    {
        return DB::table('client_product')
            ->where('id', '=', $client_product_id)
            ->delete();
    }

    /**
     * @return mixed
     */
    public function createStock()
    {
        return Stock::create([
            'added_date' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * @param int $stock_id
     * @param int $product_id
     * @param int $qty
     * @param int $price
     * @return mixed
     */
    public function addProductsToStock($stock_id = 0, $product_id = 0, $qty = 0, $price = 0)
    {
        return DB::table('stock_product')->insert([
            'stock_id' => $stock_id,
            'product_id' => $product_id,
            'qty' => $qty,
            'price' => $price,
        ]);
    }

    /**
     * @return mixed
     */
    public function getInventoryProducts()
    {
        return DB::table('products')
            ->join('stock_product', 'products.id', '=', 'stock_product.product_id')
            ->join('stocks', 'stock_product.stock_id', '=', 'stocks.id')
            ->orderBy('added_date', 'asc')
            ->orderBy('products.id', 'asc')
            ->groupBy('products.id')
            ->get([
                DB::raw('max(products.id)    AS product_id'),
                DB::raw('max(stock_product.id) as stock_product_id'),
                DB::raw('max(products.name) as name'),
                DB::raw('max(stock_product.price) AS product_price'),
                DB::raw('max(stock_product.qty)   AS product_quantity'),
                DB::raw('sum(stock_product.qty)   AS product_total'),
                DB::raw('max(added_date) as added_date'),
            ]);
    }

    /**
     * @param int $product_id
     * @param string $name
     * @param int $price
     * @param int $qty
     * @param int $stock_product_id
     * @return mixed
     */
    public function updateProductCost($product_id = 0, $name = '', $price = 0, $qty = 0, $stock_product_id = 0)
    {
        $stock_product_update = DB::table('stock_product')->where('id', '=', $stock_product_id)->update([
            'qty' => $qty,
            'price' => $price
        ]);

        return Product::where('id', '=', $product_id)->update(['name' => $name,]);
    }

    /**
     * @param int $product_id
     * @return mixed
     */
    public function getLastStock($product_id = 0)
    {
        return DB::table('stocks')
            ->join('stock_product', 'stocks.id', '=', 'stock_product.stock_id')
            ->where('stock_product.product_id', '=', $product_id)
            ->orderBy('stocks.added_date', 'desc')
            ->first([
                'stocks.id',
                'stocks.added_date',
            ]);
    }

    /**
     * @param int $stock_id
     * @param string $added_date
     * @return mixed
     */
    public function updateLastStockDate($stock_id = 0, $added_date = '')
    {
        return Stock::where('id', '=', $stock_id)->update([
            'added_date' => $added_date
        ]);
    }

    /**
     * @return mixed
     */
    public function getOverviewProducts()
    {
        return DB::table('products')
            ->join('stock_product', 'products.id', '=', 'stock_product.product_id')
            ->join('stocks', 'stock_product.stock_id', '=', 'stocks.id')
            ->groupBy('products.id')
            ->get([
                DB::raw('max(products.name) as name'),
                DB::raw('max(products.qty) as qty'),
                DB::raw('max(products.units) as units'),
                DB::raw('max(products.shortage_alert) as shortage_alert'),
                DB::raw('max(stocks.added_date) as added_date'),
            ]);
    }

    /**
     * @return mixed
     */
    public function getInventory()
    {
        return DB::select(DB::raw("SELECT
  max(clients.id)                    AS client_id,
  max(clients.name)                  AS client_name,
  max(products.name)                 AS product_name,
  max(products.price)                AS price,
  max(products.units)                AS units,
  max(client_product.created_at)     AS stock_date,
  max(client_product.created_at)     AS stock_date,
  max(client_product.shortage_alert) AS shortage_alert,
  sum(client_product.quantity)       AS client_quantity,
  sum(products.qty)                  AS qty
FROM products
  INNER JOIN client_product ON products.id = client_product.product_id
  INNER JOIN clients ON client_product.client_id = clients.id
  WHERE clients.deleted_at IS NULL 
GROUP BY clients.id, products.id
ORDER BY max(client_product.created_at) ASC"));
    }

    public function getStoreInventory()
    {
        return DB::select(DB::raw("SELECT
  clients.id                    AS client_id,
  clients.name                  AS client_name,
  products.name                 AS product_name,
  products.price                AS price,
  products.units                AS units,
  client_product.created_at     AS stock_date,
  client_product.created_at     AS stock_date,
  client_product.shortage_alert AS shortage_alert,
  client_product.quantity       AS client_quantity,
  products.qty                  AS qty
FROM products
  INNER JOIN client_product ON products.id = client_product.product_id
  INNER JOIN clients ON client_product.client_id = clients.id
  WHERE clients.deleted_at IS NULL 
ORDER BY client_product.created_at DESC"));
    }

    /**
     * @return mixed
     */
    public function getInventoryDates()
    {
        return DB::select(DB::raw("SELECT
  max(year(client_product.updated_at))      AS year,
  max(monthname(client_product.updated_at)) AS month_name,
  max(date_format(client_product.updated_at,'%m'))     AS month
FROM products
  INNER JOIN client_product ON products.id = client_product.product_id
  INNER JOIN clients ON client_product.client_id = clients.id
WHERE client_product.updated_at IS NOT NULL AND clients.deleted_at IS NULL 
GROUP BY month(client_product.updated_at), year(client_product.updated_at)
ORDER BY max(client_product.updated_at) DESC"));
    }

    /**
     * @param int $product_id
     * @return mixed
     */
    public function getProduct($product_id = 0)
    {
        return Product::where('id', '=', $product_id)
            ->first();
    }

    /**
     * @return mixed
     */
    public function getClientsProducts()
    {
        return DB::select(DB::raw("SELECT
  client_product.id,
  products.name                                                         AS product_name,
  products.price,
  products.units,
  client_product.quantity,
  client_product.shortage_alert,
  clients.name                                                          AS client_name,
  concat(street_number, ', ', street_name, ', ', city, ', ', post_code) AS client_address,
  client_product.quantity - client_product.shortage_alert               AS shortage
FROM client_product
  INNER JOIN products ON client_product.product_id = products.id
  INNER JOIN clients ON client_product.client_id = clients.id
WHERE clients.deleted_at IS NULL
ORDER BY shortage ASC"));
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return Product::get();
    }

    /**
     * @param int $product_id
     * @return mixed
     */
    public function deleteProduct($product_id = 0)
    {
        return Product::where('id', '=', $product_id)->delete();
    }

    /**
     * @param int $product_id
     * @param string $name
     * @param string $unit
     * @return mixed
     */
    public function editProduct($product_id = 0, $name = '', $unit = '')
    {
        return Product::where('id', '=', $product_id)->update([
            'name' => $name,
            'units' => $unit
        ]);
    }

    /**
     * @param string $type
     * @return mixed
     */
    public function getSelectedProducts($type = '')
    {
        return Product::where('type', '=', $type)->get();
    }
}