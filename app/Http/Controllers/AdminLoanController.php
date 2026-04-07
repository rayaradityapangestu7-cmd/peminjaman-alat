<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Loan;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Http\Request;

class AdminLoanController extends Controller
{
    /**
     * READ: Menampilkan Daftar Pengajuan Peminjaman
     */
    public function index()
    {
        $loans = Loan::with(['user', 'tool'])
            ->latest('created_at')
            ->paginate(10);

        return view('admin.loans.index', compact('loans'));
    }

    /**
     * CREATE (Form): Menampilkan form tambah peminjaman baru
     */
    public function create()
    {
        $users = User::where('role', 'peminjam')->get();
        $tools = Tool::with('category')->get();

        return view('admin.loans.create', compact('users', 'tools'));
    }

    /**
     * STORE: Proses Simpan Peminjaman Baru (Action)
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tool_id' => 'required|exists:tools,id',
            'tanggal_kembali' => 'required|date',
        ]);

        $tool = Tool::findOrFail($request->tool_id);

        // Cek apakah stok tersedia
        if ($tool->stok <= 0) {
            return back()->with('error', 'Stok alat tidak tersedia.');
        }

        // Buat record peminjaman
        $loan = Loan::create([
            'user_id' => $request->user_id,
            'tool_id' => $request->tool_id,
            'tanggal_pinjam' => now(),
            'tanggal_kembali_rencana' => $request->tanggal_kembali,
            'status' => 'pending',
        ]);

        // Otomatis kurangi stok
        $tool->decrement('stok');

        ActivityLog::record('Tambah Peminjaman (Admin)', 'Admin menambahkan peminjaman alat: '.$tool->nama_alat);

        return redirect()->route('admin.loans.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    /**
     * SHOW: Menampilkan detail peminjaman
     */
    public function show($id)
    {
        $loan = Loan::with(['user', 'tool'])->findOrFail($id);

        return view('admin.loans.show', compact('loan'));
    }

    /**
     * EDIT: Edit data peminjaman
     */
    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        $users = User::where('role', 'peminjam')->get();
        $tools = Tool::with('category')->get();

        return view('admin.loans.edit', compact('loan', 'users', 'tools'));
    }

    /**
     * UPDATE: Simpan perubahan data peminjaman
     */
    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $request->validate([
            'tanggal_kembali_rencana' => 'required|date',
            'status' => 'required|in:pending,disetujui,kembali,ditolak',
        ]);

        $loan->update([
            'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
            'status' => $request->status,
        ]);

        ActivityLog::record('Edit Peminjaman (Admin)', 'Admin mengedit peminjaman ID: '.$loan->id);

        return redirect()->route('admin.loans.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    /**
     * DESTROY: Hapus peminjaman
     */
    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $tool = Tool::findOrFail($loan->tool_id);

        // Jika status masih pending atau ditolak, kembalikan stok
        if (in_array($loan->status, ['pending', 'ditolak'])) {
            $tool->increment('stok');
        }

        $loan->delete();

        ActivityLog::record('Hapus Peminjaman (Admin)', 'Admin menghapus peminjaman ID: '.$id);

        return redirect()->route('admin.loans.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
}
