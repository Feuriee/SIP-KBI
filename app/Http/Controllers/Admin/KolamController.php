<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kolam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KolamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $month = $request->get('month');

        $query = Kolam::query()->orderBy('created_at','desc');

        if ($month) {
            $driver = \DB::getDriverName();
            if ($driver === 'sqlite') {
                $query->whereRaw("strftime('%Y-%m', created_at) = ?", [$month]);
            } else {
                $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$month]);
            }
        }

        if ($q) {
            $query->where(function($b) use ($q) {
                $b->where('nama','like', "%$q%")
                ->orWhere('lokasi','like', "%$q%");
            });
        }

        $kolams = $query->paginate(20)->appends($request->query());

        return view('admin.kolam.index', compact('kolams','q','month'));
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
    public function show(Kolam $kolam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kolam $kolam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kolam $kolam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kolam $kolam)
    {
        //
    }
}
