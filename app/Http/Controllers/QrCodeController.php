<?php

namespace App\Http\Controllers;

use App\Models\QrCodeModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{

    public function index()
    {
        $qrcode = QrCodeModel::paginate(10);
        return view('Admin_page.qrcode.index', compact('qrcode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_qrcode' => 'nullable|string|max:255',
        ]);

        $kodeQr = $request->nama_qrcode ?? Str::upper(Str::random(6));
        $fileName = $kodeQr . '.png';
        generateGoQrAndSave($kodeQr, $fileName);

        $qrcode = QrCodeModel::create([
            'nama_qrcode' => $fileName,
        ]);

        return redirect()->route('qrcode.index')
            ->with('success', 'QR Code berhasil dibuat!');
    }
}
