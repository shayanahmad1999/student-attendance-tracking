<?php

namespace App\Livewire\Teacher\Grades;

use App\Models\Grade;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class GradeList extends Component
{

    use WithPagination;
    public $search = '';

    public function updated($property)
    {
        if (in_array($property, ['search'])) {
            $this->resetPage();
        }
    }

    public function clearFilters()
    {
        $this->reset(['search']);
        $this->resetPage();
    }

    public function delete($id)
    {
        Grade::find($id)->delete();
        Toaster::success('grade deleted successfully!');
    }
    public function render()
    {
        $query = Grade::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        $grades = $query->paginate(10);
        return view('livewire.teacher.grades.grade-list', [
            'grades' => $grades
        ]);
    }
}
