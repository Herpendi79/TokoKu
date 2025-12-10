<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pelanggan;
use Livewire\Attributes\Layout;

#[Layout('Layouts.app')]
class Pelanggans extends Component
{

    public $nama, $alamat, $telepon, $email, $id;
    public $updateMode = false;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:500',
        'telepon' => 'required|string|max:15',
        'email' => 'required|email|unique:pelanggans,email',
    ];

    public function render()
    {
        return view('livewire.pelanggans', [
            'pelanggans' => Pelanggan::latest()->get()
        ]);
    }


    public function resetInputFields()
    {
        $this->nama = '';
        $this->alamat = '';
        $this->telepon = '';
        $this->email = '';
        $this->id = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $this->validate();

        Pelanggan::create([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Pelanggan berhasil ditambahkan.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $this->id = $id;
        $this->nama = $pelanggan->nama;
        $this->alamat = $pelanggan->alamat;
        $this->telepon = $pelanggan->telepon;
        $this->email = $pelanggan->email;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email|unique:pelanggans,email,' . $this->id,
        ]);

        $pelanggan = Pelanggan::findOrFail($this->id);
        $pelanggan->update([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Pelanggan berhasil diperbarui.');

        $this->resetInputFields();
    }

    public function delete($id)
    {
        Pelanggan::findOrFail($id)->delete();
        session()->flash('message', 'Pelanggan berhasil dihapus.');
    }   
}
