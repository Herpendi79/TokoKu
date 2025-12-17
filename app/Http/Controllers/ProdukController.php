<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProdukExport;
use App\Models\TransaksiModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Notification;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProdukController extends Controller
{
    public function index()
    {
        $produk = ProdukModel::latest()->paginate(10);
        return view('Admin_page.produk.index', compact('produk'));
    }

    public function create()
    {
        return view('Admin_page.produk.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'harga_produk' => 'required|numeric',
            'stock_produk' => 'required|integer',
            'foto_produk' =>
            'required|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $image = $request->file('foto_produk');
        $filename = uniqid() . '.webp';

        $manager = new ImageManager(new Driver());

        $img = $manager->read($image->getRealPath())
        ->cover(1200, 675)
        ->toWebp(70);

        Storage::put('produk/' . $filename, $img);

        ProdukModel::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga_produk' => $request->harga_produk,
            'stock_produk' => $request->stock_produk,
            'foto_produk' => $filename,
        ]);
        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }


    public function show($id)
    {
        $produk = ProdukModel::findOrFail($id);
        return view('Admin_page.produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = ProdukModel::findOrFail($id);
        return view('Admin_page.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'harga_produk' => 'required|numeric',
            'stock_produk' => 'required|integer',
            'foto_produk' =>
            'sometimes|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $produk = ProdukModel::findOrFail($id);

        if ($request->hasFile('foto_produk')) {
            // Hapus foto lama jika ada
            if (
                $produk->foto_produk &&
                Storage::exists('produk/' . $produk->foto_produk)
            ) {
                Storage::delete('produk/' . $produk->foto_produk);
            }

            $image = $request->file('foto_produk');
            $filename = uniqid() . '.webp';

            $manager = new ImageManager(new Driver());

            $img = $manager->read($image->getRealPath())
                ->cover(1200, 675)
                ->toWebp(70);

            Storage::put('produk/' . $filename, $img);
        }

        $produk->foto_produk = $filename;
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->harga_produk = $request->harga_produk;
        $produk->stock_produk = $request->stock_produk;
        $produk->save();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id): RedirectResponse
    {
        $produk = ProdukModel::findOrFail($id);

        // Hapus foto produk jika ada
        if (
            $produk->foto_produk &&
            Storage::exists('produk/' . $produk->foto_produk)
        ) {
            Storage::delete('produk/' . $produk->foto_produk);
        }

        $produk->delete();
        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function katalog()
    {
        $produk = ProdukModel::all();
        return view('welcome', compact('produk'));
    }

    public function export()
    {
        return Excel::download(new ProdukExport(), 'produk.xlsx');
    }

    public function katalog_user()
    {
        $produk = ProdukModel::all();
        return view('User_page.produk.katalog', compact('produk'));
    }

    public function show_user($id)
    {
        $produk = ProdukModel::findOrFail($id);
        return view('User_page.produk.show', compact('produk'));
    }

    public function store_user(Request $request): RedirectResponse
    {
        $produk_id = $request->input('produk_id');
        $produk = ProdukModel::where('id', $produk_id)->first();
        $data = Auth::user();
        $order_id = 'ORDER-' . time();

        $transaksi = TransaksiModel::create([
            'user_id' => Auth::user()->user_id,
            'id' => $produk_id,
            'price' => $produk->harga_produk ?? '-',
            'status' => 'pending',
            'order_id' => $order_id,
        ]);

        $durationInMinutes = 3;

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $produk->harga_produk,
            ],
            'customer_details' => [
                'first_name' => $data->name,
                'email' => $data->email,
            ],
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s O'), // waktu sekarang + zona waktu server
                'unit' => 'minute', // minute / hour / day
                'duration' => $durationInMinutes,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaksi->snap_token = $snapToken;
        $transaksi->save();

        return redirect()->route('user.produk.pembayaran', [
            'snapToken' => $snapToken,
        ]);
    }

    public function callback(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');

        $notif = new Notification();

        $transaction_status = $notif->transaction_status;
        $orderId = $notif->order_id;
        $statusCode = $notif->status_code;
        $grossAmount = $notif->gross_amount;
        $signatureKey = $notif->signature_key;

        // Hitung ulang signature
        $expectedSignature = hash(
            'sha512',
            $orderId .
                $statusCode .
                $grossAmount .
                config('midtrans.serverKey'),
        );

        if ($expectedSignature !== $signatureKey) {
            Log::warning('Invalid signature', [
                'expected' => $expectedSignature,
                'received' => $signatureKey,
            ]);
            return response()->json(['message' => 'Invalid signature'], 401);
        }

        $transaksi = TransaksiModel::where('order_id', $orderId)->first();

        if ($transaction_status == 'settlement') {
            $transaksi->status = 'success';
            $transaksi->save();
        } elseif (
            in_array(strtolower($transaction_status), ['expire', 'expired'])
        ) {
            $transaksi->status = 'expired';
            $transaksi->save();
        }
    }
    public function history()
    {
        $user = Auth::user();
        $transaksi = TransaksiModel::where('user_id', $user->user_id)
            ->with('produk')
            ->orderBy('transaksi_id', 'desc')
            ->paginate(10);

        return view('User_page.produk.history', compact('transaksi'));
    }
}
