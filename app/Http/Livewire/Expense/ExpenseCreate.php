<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;
use App\Models\Expense;
use Livewire\WithFileUploads;

class ExpenseCreate extends Component
{
    use WithFileUploads;

    public $amount;
    public $type;
    public $description;
    public $photo;

    protected $rules = [
        'amount' => 'required',
        'type'   => 'required',
        'description' => 'required',
        'photo' => 'image'
    ];

    public function createExpense()
    {
        $this->validate();

        if ($this->photo) {
            $photo = $this->photo->store('expenses-photos', 'public');
        }

        auth()->user()->expenses()->create([
            'amount' => $this->amount,
            'type'   => $this->type,
            'description' => $this->description,
            'user_id'     => 1,
            'photo'       => $photo?? null
        ]);

        session()->flash('message', 'Registro criado com sucesso!');

        $this->amount = $this->type = $this->description = null;
    }

    public function render()
    {
        return view('livewire.expense.expense-create');
    }
}
