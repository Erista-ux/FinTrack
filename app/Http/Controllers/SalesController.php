<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    private $sales = [];
    private $nextId = 1;

    public function __construct()
    {
        // Data dummy untuk demo
        $this->sales = [
            [
                'id' => 1,
                'kode_transaksi' => 'TRX-001',
                'nama_pelanggan' => 'Budi Santoso',
                'total' => 1500000,
                'status_pembayaran' => 'lunas',
                'tanggal' => '2024-01-15'
            ],
            [
                'id' => 2,
                'kode_transaksi' => 'TRX-002',
                'nama_pelanggan' => 'Sari Dewi',
                'total' => 2500000,
                'status_pembayaran' => 'pending',
                'tanggal' => '2024-01-16'
            ]
        ];
        $this->nextId = 3;
    }

    public function index()
    {
        // Cek session langsung di controller
        if (!session('logged_in')) {
            return redirect()->route('login.index')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('pages.sales.index', ['sales' => $this->sales]);
    }

    public function create()
    {
        if (!session('logged_in')) {
            return redirect()->route('login.index')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('pages.sales.create');
    }

    public function store(Request $request)
    {
        if (!session('logged_in')) {
            return redirect()->route('login.index')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'kode_transaksi' => 'required|string',
            'nama_pelanggan' => 'required|string',
            'total' => 'required|numeric',
            'status_pembayaran' => 'required|in:lunas,pending,dibatalkan'
        ]);

        $sale = [
            'id' => $this->nextId++,
            'kode_transaksi' => $request->kode_transaksi,
            'nama_pelanggan' => $request->nama_pelanggan,
            'total' => $request->total,
            'status_pembayaran' => $request->status_pembayaran,
            'tanggal' => date('Y-m-d')
        ];

        $this->sales[] = $sale;

        return redirect()->route('sales.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (!session('logged_in')) {
            return redirect()->route('login.index')->with('error', 'Silakan login terlebih dahulu.');
        }

        $sale = collect($this->sales)->firstWhere('id', (int)$id);

        if (!$sale) {
            return redirect()->route('sales.index')->with('error', 'Transaksi tidak ditemukan!');
        }

        return view('pages.sales.edit', compact('sale'));
    }

    public function update(Request $request, $id)
    {
        if (!session('logged_in')) {
            return redirect()->route('login.index')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'kode_transaksi' => 'required|string',
            'nama_pelanggan' => 'required|string',
            'total' => 'required|numeric',
            'status_pembayaran' => 'required|in:lunas,pending,dibatalkan'
        ]);

        foreach ($this->sales as &$sale) {
            if ($sale['id'] == (int)$id) {
                $sale['kode_transaksi'] = $request->kode_transaksi;
                $sale['nama_pelanggan'] = $request->nama_pelanggan;
                $sale['total'] = $request->total;
                $sale['status_pembayaran'] = $request->status_pembayaran;
                break;
            }
        }

        return redirect()->route('sales.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (!session('logged_in')) {
            return redirect()->route('login.index')->with('error', 'Silakan login terlebih dahulu.');
        }

        $this->sales = array_filter($this->sales, function($sale) use ($id) {
            return $sale['id'] != (int)$id;
        });

        return redirect()->route('sales.index')->with('success', 'Transaksi berhasil dihapus!');
    }


}
