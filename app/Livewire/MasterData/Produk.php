<?php

namespace App\Livewire\MasterData;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use App\Models\Produk as ModelsProduk;

class Produk extends Component
{
    use WithPagination;
    #[Title('Produk')]

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'delete'
    ];

    protected $rules = [
        'kategori'            => 'required',
        'nama_produk'         => 'required',
        'harga'               => 'required',
        'komisi'              => 'required',
    ];

    public $lengthData = 25;
    public $searchTerm;
    public $previousSearchTerm = '';
    public $isEditing = false;

    public $dataId;

    public $kategori, $nama_produk, $harga, $komisi;

    public function mount()
    {
        $this->kategori            = '';
        $this->nama_produk         = '';
        $this->harga               = '';
        $this->komisi              = '';
    }

    public function render()
    {
        $this->searchResetPage();
        $search = '%' . $this->searchTerm . '%';

        $data = ModelsProduk::select('produk.*')
            ->where(function ($query) use ($search) {
                $query->where('kategori', 'LIKE', $search);
                $query->orWhere('nama_produk', 'LIKE', $search);
                $query->orWhere('harga', 'LIKE', $search);
                $query->orWhere('komisi', 'LIKE', $search);
            })
            ->orderBy('id', 'ASC')
            ->paginate($this->lengthData);

        return view('livewire.master-data.produk', compact('data'));
    }

    public function store()
    {
        $this->validate();

        ModelsProduk::create([
            'kategori'            => $this->kategori,
            'nama_produk'         => $this->nama_produk,
            'harga'               => $this->harga,
            'komisi'              => $this->komisi,
        ]);

        $this->dispatchAlert('success', 'Success!', 'Data created successfully.');
    }

    public function edit($id)
    {
        $this->isEditing        = true;
        $data = ModelsProduk::where('id', $id)->first();
        $this->dataId           = $id;
        $this->kategori         = $data->kategori;
        $this->nama_produk      = $data->nama_produk;
        $this->harga            = $data->harga;
        $this->komisi           = $data->komisi;
    }

    public function update()
    {
        $this->validate();

        if ($this->dataId) {
            ModelsProduk::findOrFail($this->dataId)->update([
                'kategori'            => $this->kategori,
                'nama_produk'         => $this->nama_produk,
                'harga'               => $this->harga,
                'komisi'              => $this->komisi,
            ]);

            $this->dispatchAlert('success', 'Success!', 'Data updated successfully.');
            $this->dataId = null;
        }
    }

    public function deleteConfirm($id)
    {
        $this->dataId = $id;
        $this->dispatch('swal:confirm', [
            'type'      => 'warning',
            'message'   => 'Are you sure?',
            'text'      => 'If you delete the data, it cannot be restored!'
        ]);
    }

    public function delete()
    {
        ModelsProduk::findOrFail($this->dataId)->delete();
        $this->dispatchAlert('success', 'Success!', 'Data deleted successfully.');
    }

    public function updatingLengthData()
    {
        $this->resetPage();
    }

    private function searchResetPage()
    {
        if ($this->searchTerm !== $this->previousSearchTerm) {
            $this->resetPage();
        }

        $this->previousSearchTerm = $this->searchTerm;
    }

    private function dispatchAlert($type, $message, $text)
    {
        $this->dispatch('swal:modal', [
            'type'      => $type,
            'message'   => $message,
            'text'      => $text
        ]);

        $this->resetInputFields();
    }

    public function isEditingMode($mode)
    {
        $this->isEditing = $mode;
    }

    private function resetInputFields()
    {
        $this->kategori            = '';
        $this->nama_produk         = '';
        $this->harga               = '';
        $this->komisi              = '';
    }

    public function cancel()
    {
        $this->isEditing       = false;
        $this->resetInputFields();
    }
}
