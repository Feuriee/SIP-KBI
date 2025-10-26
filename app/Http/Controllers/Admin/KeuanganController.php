<?php

namespace App\Http\Controllers\Admin;

use App\Models\Keuangan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $month = $request->get('month');

        $query = Keuangan::query()->orderBy('tanggal','desc');

        if ($month) {
            // cross-db compatibility
            $driver = \DB::getDriverName();
            if ($driver === 'sqlite') {
                $query->whereRaw("strftime('%Y-%m', tanggal) = ?", [$month]);
            } else {
                $query->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') = ?", [$month]);
            }
        }

        if ($q) {
            $query->where(function($b) use ($q) {
                $b->where('nama','like', "%$q%")
                ->orWhere('keterangan','like', "%$q%");
            });
        }

        $keuangans = $query->paginate(20)->appends($request->query());

        return view('admin.keuangan.index', compact('keuangans','q','month'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keuangan $keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keuangan $keuangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keuangan $keuangan)
    {
        //
    }
}
