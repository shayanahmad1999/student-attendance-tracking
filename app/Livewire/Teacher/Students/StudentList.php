<?php

namespace App\Livewire\Teacher\Students;

use App\Models\Grade;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class StudentList extends Component
{
    use WithPagination;
    public $search = '';
    public $grad = '';
    protected $paginationTheme = 'tailwind';

    public function updated($property)
    {
        if (in_array($property, ['search', 'grad'])) {
            $this->resetPage();
        }
    }

    public function clearFilters()
    {
        $this->reset(['search', 'grad']);
        $this->resetPage();
    }


    public function delete($id)
    {
        Student::find($id)->delete();
        Toaster::success('student deleted successfully!');
        $this->dispatch('navigateToIndex');
    }

    public function render()
    {
        $query = Student::query();

        if ($this->search) {
            $query->where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%');
        }

        if ($this->grad) {
            $query->where('grade_id', $this->grad);
        }

        $students = $query->paginate(10);

        return view('livewire.teacher.students.student-list', [
            'students' => $students,
            'grades' => Grade::all()
        ]);
    }
}
