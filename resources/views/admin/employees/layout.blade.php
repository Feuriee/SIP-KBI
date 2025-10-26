@extends('admin.layout')

@section('title', 'Kelola Karyawan | SIP-KBI')

@section('content')
<div class="flex justify-between items-center mb-4">
  <h1 class="text-2xl font-bold text-sipkbi-green">👥 Kelola Akun Karyawan</h1>
  <a href="{{ route('admin.employees.create') }}" class="bg-sipkbi-green text-white px-4 py-2 rounded hover:bg-green-600">+ Tambah Karyawan</a>
</div>

<div class="overflow-x-auto bg-white dark:bg-gray-800 rounded shadow">
  <table class="w-full border-collapse">
    <thead class="bg-gray-100 dark:bg-gray-700">
      <tr>
        <th class="px-4 py-2 text-left">Nama</th>
        <th class="px-4 py-2 text-left">Email</th>
        <th class="px-4 py-2 text-left">Role</th>
        <th class="px-4 py-2 text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($employees as $employee)
      <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
        <td class="px-4 py-2">{{ $employee->name }}</td>
        <td class="px-4 py-2">{{ $employee->email }}</td>
        <td class="px-4 py-2">{{ ucfirst($employee->role) }}</td>
        <td class="px-4 py-2 text-center space-x-2">
          <a href="{{ route('admin.employees.edit', $employee->id) }}" class="text-blue-500 hover:underline">Edit</a>
          <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Hapus akun ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="4" class="text-center py-4 text-gray-500">Belum ada data karyawan</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
