<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

final class ProductService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Product::class);
        $this->model = Product::class;
    }

    public function createProduct(array $params) : Product
    {   
        $product = $this->model::create([
            'name'          => $params['name'],
            'description'   => (isset($params['description']) ? $params['description'] : null),
            'price'         => $params['price'],
            'qty'           => $params['qty'],
        ]);

        return $product;
    }

    public function deleteProductAddress(Product $product)
    {   
        $product->delete();
    }

    public function findProduct(int $id) : Product
    {
        return $this->model::findOrFail($id);
    }

    public function searchProducts(array $params)
    {
        $products = $this->model::orderBy('products.created_at', 'desc')
            ->whereNotNull('products.id');

        if (isset($params['q'])) {
            $products = $products->orWhere('name', 'like', '%' . $params['q'] . '%')
                ->orWhere('description', 'like', '%' . $params['q'] . '%');
        }

        return $products->paginate($params['limit'], ['*'], 'page', $params['page']);
    }

    public function reduceProductQty(array $params) : Collection
    {   
        $ids = ''; //Get product ids in array
        $products = $this->model::withNoTrashed()
            ->whereIn('id', $ids)
            ->each(function($q) use($params) {
                $o_qty = ''; //Find id in array to get qty
                $p_qty = $q->qty;
                $c_qty = ($p_qty - $o_qty);

                if ($c_qty > 0) {
                    $q->qty = $c_qty;
                    $q->save();

                    $q->purchase = true;
                } else {
                    $q->purchase = false;
                }
            });

        return $products;
    }

    public function updateProduct(Product $product, array $params) : Product
    {   
        $product->update([
            'name'          => $params['name'],
            'description'   => (isset($params['description']) ? $params['description'] : null),
            'price'         => $params['price'],
            'qty'           => $params['qty'],
        ]);

        return $product;
    }
}