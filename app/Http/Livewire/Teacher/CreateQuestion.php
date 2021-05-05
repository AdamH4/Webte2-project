<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use App\Models\Question;

class CreateQuestion extends Component
{
	public $exam;
	public $qtTypes;
	public $qtType = 'short_answer';
	public $shortAnsOpts = [];
	public $pairAnsOpts = ['left' => [], 'right' => []];

    public function mount($exam)
    {
        $this->exam = $exam;
        $this->qtTypes = Question::types;
    }

    public function render()
    {

        return view('livewire.teacher.create-question', [
        	'qtTypes' => $this->qtTypes,
        	'shortAnsOpts' => $this->shortAnsOpts,
        ]);
    }

    public function addShortAnsOpt()
    {
    	$this->shortAnsOpts[] = '';
    }

    public function addPairAnsOpt(String $side)
    {
    	$this->pairAnsOpts[$side][] = '';
    }
}