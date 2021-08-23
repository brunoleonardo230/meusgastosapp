<?php

namespace App\Http\Livewire\Plan;

use Livewire\Component;
use \App\Models\Plan;

class PlanCreate extends Component
{
    public array $plan = [];

    protected $rules = [
        'plan.name' => 'required',
        'plan.description' => 'required',
        'plan.price' => 'required',
        'plan.slug' => 'required',
        'plan.reference' => 'required',
    ];

    public function createPlan()
    {
        $this->validate();

        $plan = $this->plan;
        $plan['reference'] = 'PAGSEGURO-REFERENCE';

        PLan::create($plan);

        session()->flash('message', 'Plano criado com sucesso');
    }

    public function render()
    {
        return view('livewire.plan.plan-create');
    }
}
