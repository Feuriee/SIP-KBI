<?php

// app/Http/Controllers/User/KolamController.php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kolam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KolamController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kolam_list = Kolam::where('user_id', $user->id)->latest()->get();

        $total_kolam = $kolam_list->count();
        $kolam_aktif = $kolam_list->where('status', 'aktif')->count();
        $siap_panen = $kolam_list->where('status', 'panen')->count();

        return view('user.kolam.index', compact('kolam_list', 'total_kolam', 'kolam_aktif', 'siap_panen'));
    }

    // Tambahkan store, edit, update, destroy jika perlu
    // Untuk demo awal, cukup index dulu
}