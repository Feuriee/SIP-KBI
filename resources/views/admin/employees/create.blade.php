@extends('admin.layout')
@section('title', 'Tambah Karyawan')
@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah Karyawan</h1>

<form action="{{ route('admin.employees.store') }}" method="POST" class="space-y-4 max-w-md">
  @csrf
  <div>
    <label class="block mb-1">Nama</label>
    <input type="text" name="name" class="w-full border p-2 rounded" required>
  </div>
  <div>
    <label class="block mb-1">Email</label>
    <input type="email" name="email" class="w-full border p-2 rounded" required>
  </div>
  <div>
    <label class="block mb-1">Password</label>
    <input type="password" name="password" class="w-full border p-2 rounded" required>
  </div>
  <div>
    <label class="block mb-1">Role</label>
    <select name="role" class="w-full border p-2 rounded">
      <option value="user">Employee</option>
      <option value="admin">Admin</option>
    </select>
  </div>
  <button class="bg-sipkbi-green text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
