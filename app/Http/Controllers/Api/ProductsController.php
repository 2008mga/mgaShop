<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index ()
    {
        return $this->json(Product::simplePaginate(10));
    }

    public function get (Product $product)
    {
        return $this->json($product->load([
            'category',
            'comments'
        ]));
    }

    public function commenting (Request $request, Product $product)
    {
        $now = Carbon::now();
        $last = $request->user()->comments()->orderBy('id', 'DESC')->first()->created_at;

        if ($now->diffInMinutes($last) < 1) {
            return $this->json('Прежде чем написать новый комментарий подождите 1 минуту', 403);
        }

        $comment = $request->user()->comments()->create([
            'product_id' => $product->id,
            'comment' => $request->get('comment')
        ]);

        return $this->json(Comment::find($comment->id));
    }
}
