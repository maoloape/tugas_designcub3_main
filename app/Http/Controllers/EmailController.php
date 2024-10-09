<?php

namespace App\Http\Controllers;

use App\Models\email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        return view('email.index');
    }

    public function getEmails(Request $request)
    {
        if ($request->ajax()) {
            $emails = Email::select(['id', 'email']);

            return datatables()::of($emails)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editBtn = '<button class="btn btn-primary edit-btn" data-id="' . $row->id . '" data-email="' . $row->email . '">Edit</button>';
                    $deleteBtn = '<button class="btn btn-danger delete-btn" data-id="' . $row->id . '">Hapus</button>';
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'mail' => 'required|email|min:10',
        ]);

        try {
            Email::create(['email' => $request->mail]);

            return redirect()->route('email')->with('success-email', 'Email berhasil ditambahkan!');

        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->errorInfo[1] == 1062) {
                return redirect()->route('email')->with('error-email', 'Email sudah terdaftar!');
            }

            return redirect()->route('email')->with('error-email', 'Terjadi kesalahan, silakan coba lagi!');
        }
    }


    public function destroy($id)
    {
        $email = Email::findOrFail($id);
        $email->delete();

        return redirect()->route('email')->with('success-email', 'Email berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = Email::findOrFail($id);
        $email->update(['email' => $request->email]);

        return redirect()->route('email')->with('success-email', 'Email berhasil diperbarui!');
    }

}
