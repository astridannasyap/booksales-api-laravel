<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'book')->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource not found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get All Resource",
            "data" => $transactions
        ], 200);
    }



    public function store(Request $request)
    {
        // 1. Validator & cek validator

        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error",
                "errors" => $validator->errors()
            ], 422);
        }
        // 2. Generate orderNumber -> unique | ORD -0003

        $uniqueCode = 'ORD-' . strtoupper(uniqid());

        // 3. Ambil user yang sedang login & cek login (apakah ada data user)

        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                "success" => false,
                "message" => "Unauthorized"
            ], 401);
        }


        // 4. Mencari data buku dari request

        $book = Book::find($request->book_id);

        // 5. Cek Stok Buku
        if ($book->stock < $request->quantity) {
            return response()->json([
                "success" => false,
                "message" => "Stock buku tidak mencukupi"
            ], 400);
        }

        // 6. hitung total harga = price * quality
        $totalAmount = $book->price * $request->quantity;

        // 7. kurangi stock buku (update)
        $book->stock -= $request->quantity;
        $book->save();

        // 8. simpan transaksi
        $transaction = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            "success" => true,
            "message" => "Transaksi create successfully",
            "data" => $transaction
        ], 201);
    }

    public function show($id)
    {
        $transaction = Transaction::with('user', 'book')->find($id);

        if (!$transaction) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get Detail Resource",
            "data" => $transaction
        ], 200);
    }

    public function update(string $id, Request $request)
    {
        // 1. Cari data transaksi berdasarkan ID
        $transaction = Transaction::with('user', 'book')->find($id);

        if (!$transaction) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 404);
        }

        // 2. Validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error",
                "errors" => $validator->errors()
            ], 422);
        }

        // 3. Cek autentikasi user
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                "success" => false,
                "message" => "Unauthorized"
            ], 401);
        }

        // 4. Kembalikan stok buku lama
        $oldBook = Book::find($transaction->book_id);
        $oldQuantity = $transaction->total_amount / $oldBook->price;
        $oldBook->stock += $oldQuantity;
        $oldBook->save();

        // 5. Ambil data buku baru
        $newBook = Book::find($request->book_id);

        // 6. Cek stok buku baru
        if ($newBook->stock < $request->quantity) {
            // Rollback stok buku lama jika gagal
            $oldBook->stock -= $oldQuantity;
            $oldBook->save();

            return response()->json([
                "success" => false,
                "message" => "Stock buku tidak mencukupi"
            ], 400);
        }

        // 7. Kurangi stok buku baru
        $newBook->stock -= $request->quantity;
        $newBook->save();

        // 8. Hitung total amount baru
        $totalAmount = $newBook->price * $request->quantity;

        // 9. Update transaksi
        $transaction->update([
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount
        ]);

        // 10. Reload relasi
        $transaction->load('user', 'book');

        return response()->json([
            "success" => true,
            "message" => "Transaction updated successfully",
            "data" => $transaction
        ], 200);
    }


    public function destroy(string $id)
    {
        // 1. Cari data transaksi
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 404);
        }

        // 2. Kembalikan stok buku sebelum menghapus
        $book = Book::find($transaction->book_id);

        if ($book) {
            // Hitung quantity dari total_amount / price
            $quantity = $transaction->total_amount / $book->price;
            $book->stock += $quantity;
            $book->save();
        }

        // 3. Hapus transaksi
        $transaction->delete();

        return response()->json([
            "success" => true,
            "message" => "Resource deleted successfully"
        ], 200);
    }
}
