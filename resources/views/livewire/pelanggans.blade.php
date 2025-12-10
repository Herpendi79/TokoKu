<div class="p-4">

    @if (session()->has('message'))
        <div class="alert alert-success mb-2">
            {{ session('message') }}
        </div>
    @endif

    <h1 class="mb-0">CRUD Pelanggan (Livewire 3)</h1>

    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" wire:model="nama">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" wire:model="alamat">
            @error('alamat')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="telepon" wire:model="telepon">
            @error('telepon')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" wire:model="email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary">
            {{ $updateMode ? 'Update' : 'Tambah' }}
        </button>

        @if ($updateMode)
            <button type="button" wire:click="resetInputFields" class="btn btn-secondary">
                Batal
            </button>
        @endif
    </form>

    <hr>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pelanggans as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->telepon }}</td>
                    <td>{{ $p->email }}</td>
                    <td>
                        <button wire:click="edit({{ $p->id }})" class="btn btn-sm btn-warning">Edit</button>
                        <button wire:click="delete({{ $p->id }})" class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
