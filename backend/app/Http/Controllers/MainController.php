<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class MainController extends Controller
{
    public function addCard(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'admin' && $user->role !== 'root') {
            return response()->json([
                "message" => "У вас нет прав администратора."
            ], 403);
        };

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:category,id',
            'material' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        $photo = null;
        if ($request->hasFile('image')) {
            $photo = $request->file('image')->store('photo', 'public');
        } else {
            $photo = 'photo/default.png';
        }

        Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'material' => $request->material,
            'image' => $photo
        ]);
        return response()->json([
            "messenge" => "Успешно добавлено."
        ]);
    }

    public function deleteAdd(Request $request, string $id)
    {
        $product = Product::find($id);
        $user = $request->user();
        if ($user->role !== "admin" && $user->role !== "root") {
            return response()->json([
                "messenge" => "У вас нет прав"
            ]);
        }
        if (!$product) {
            return response()->json([
                "messenge" => "Не найдено"
            ]);
        }
        $product->delete();
        return response()->json([
            "messenge" => "Del"
        ]);
    }

    public function getProduct(Request $request) {
        return Product::all();
    }

    public function getProductCategory(Request $request, string $category) {
        $products = Product::where('category_id', $category)->get();
        return response()->json($products);
    }

    public function add(Product $product)
{
    $cart = Cart::firstOrCreate([
        'user_id' => auth()->id()
    ]);

    $item = $cart->items()
        ->where('product_id', $product->id)
        ->first();

    if ($item) {
        $item->increment('quantity');
    } else {
        $cart->items()->create([
            'product_id' => $product->id,
            'quantity' => 1
        ]);
    }

    return response()->json(['message' => 'OK']);
}

public function index()
{
    return Cart::with('items.product')
        ->where('user_id', auth()->id())
        ->first();
}

public function checkout()
{
    $cart = Cart::with('items.product')
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $order = Order::create([
        'user_id' => auth()->id(),
        'status' => 'new',
        'total_price' => 0
    ]);

    $total = 0;

    foreach ($cart->items as $item) {
        $order->items()->create([
            'product_id' => $item->product_id,
            'price' => $item->product->price,
            'quantity' => $item->quantity
        ]);

        $total += $item->product->price * $item->quantity;
    }

    $order->update(['total_price' => $total]);

    $cart->items()->delete();

    return response()->json($order);
}

public function decrease(Product $product)
{
    $cart = Cart::where('user_id', auth()->id())->first();

    if (!$cart) {
        return response()->json(['message' => 'Cart empty'], 404);
    }

    $item = $cart->items()
        ->where('product_id', $product->id)
        ->first();

    if (!$item) {
        return response()->json(['message' => 'Item not found'], 404);
    }

    if ($item->quantity > 1) {
        $item->decrement('quantity');
    } else {
        $item->delete();
    }

    return response()->json(['message' => 'OK']);
}

public function remove(Product $product)
{
    $cart = Cart::where('user_id', auth()->id())->first();

    if (!$cart) {
        return response()->json(['message' => 'Cart empty'], 404);
    }

    $cart->items()
        ->where('product_id', $product->id)
        ->delete();

    return response()->json(['message' => 'Deleted']);
}
public function clear()
{
    $cart = Cart::where('user_id', auth()->id())->first();

    if ($cart) {
        $cart->items()->delete();
    }

    return response()->json(['message' => 'Cart cleared']);
}

    public function myOrders(Request $request)
    {
        return Order::where('user_id', $request->user()->id)
            ->with('items.product')
            ->latest()
            ->get();
    }
}


