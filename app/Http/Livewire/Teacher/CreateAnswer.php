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
    // public $freePairs = [];
    // public $usedPairs = [];

	public function mount($exam, $qt)
    {
        $this->exam = $exam;
        $this->qt = $qt;
        // $this->qtTypes = Question::types;
        // $this->freePairs = (array) $qt->questionDecoded->options->right;
    }

    public function render()
    {
        return view('livewire.teacher.create-answer', [
        	'exam' => $this->exam,
        	'qt' => $this->qt,
            'shortAnsOpts' => $this->shortAnsOpts,
            // 'freePairs' => $this->freePairs,
            // 'usedPairs' => $this->usedPairs,
        ]);
    }

    public function addShortAnsOpt()
    {
    	$this->shortAnsOpts[] = '';
    }
}
