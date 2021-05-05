<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use App\Models\Exam;
use App\Models\Question;

class CreateAnswer extends Component
{
	public $exam;
	public $qt;
	public $shortAnsOpts = [''];
	public $pairAnsOpts = ['left' => [], 'right' => []];

	public function mount($exam, $qt)
    {
        $this->exam = $exam;
        $this->qt = $qt;
        // $this->qtTypes = Question::types;
    }

    public function render()
    {
        return view('livewire.teacher.create-answer', [
        	'exam' => $this->exam,
        	'qt' => $this->qt,
            'shortAnsOpts' => $this->shortAnsOpts,
        ]);
    }

    public function addShortAnsOpt()
    {
    	$this->shortAnsOpts[] = '';
    }
}
