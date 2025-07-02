<?php

namespace App\Livewire\Teacher\Students;

use App\Models\Grade;
use App\Models\Student;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Title('Student Attendance | Add Student')]
class AddStudent extends Component
{
    public $grades = [];
    public $first_name = '';
    public $last_name = '';
    public $age = '';
    public $grade = '';

    public function mount()
    {
        $this->grades = Grade::all();
    }

    public function save()
    {
        $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'age' => 'required|integer',
            'grade' => 'required|exists:grades,id',
        ]);

        if (!is_numeric($this->grade)) {
            Toaster::error('Please select a valid grade.');
            return;
        }

        Student::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'age' => $this->age,
            'grade_id' => $this->grade,
        ]);

        $this->reset();

        Toaster::success('student added successfully!');
    }
    public function render()
    {
        return view('livewire.teacher.students.add-student');
    }
}
