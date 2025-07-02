<?php

namespace App\Livewire\Teacher\Grades;

use App\Models\Grade;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class AddGrade extends Component
{
    public $name = '';

    public function save()
    {
        $this->validate([
            'name' => 'required|string',
        ]);

        Grade::create([
            'name' => $this->name,
        ]);

        $this->reset();

        Toaster::success('Grade added successfully!');
    }
    public function render()
    {
        return view('livewire.teacher.grades.add-grade');
    }
}
