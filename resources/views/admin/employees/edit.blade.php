@extends('admin.layout')
@section('title', 'Edit Karyawan')
@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Data Karyawan</h1>

<form action="{{ route('admin.employees.update', $user->id) }}" method="POST" class="space-y-4 max-w-md">
  @csrf
  @method('PUT')
  <div>
    <label class="block mb-1">Nama</label>
    <input type="text" name="name" class="w-full border p-2 rounded" value="{{ $user->name }}" required>
  </div>
  <div>
    <label class="block mb-1">Email</label>
    <input type="email" name="email" class="w-full border p-2 rounded" value="{{ $user->email }}" required>
  </div>
  <div>
    <label class="block mb-1">Password (kosongkan jika tidak diubah)</label>
    <input type="password" name="password" class="w-full border p-2 rounded">
  </div>
  <div>
    <label class="block mb-1">Role</label>
    <select name="role" class="w-full border p-2 rounded">
      <option value="employee" @if($user->role == 'employee') selected @endif>Employee</option>
      <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
    </select>
  </div>
  <button class="bg-blue-600 text-white px-4 py-2 rounded">Perbarui</button>
</form>
@endsection
