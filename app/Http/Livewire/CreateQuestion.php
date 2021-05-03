<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;

class CreateQuestion extends Component
{
	public $exam;
	public $qtTypes;
	public $qtType = 'short_answer';
	public $shortAnsOpts = ['', ''];

    public function mount($exam)
    {
        $this->exam = $exam;
        $this->qtTypes = Question::types;
    }

    public function render()
    {

        return view('livewire.create-question', [
        	'qtTypes' => $this->qtTypes,
        	'shortAnsOpts' => $this->shortAnsOpts,
        ]);
    }

    public function addShortAnsOpt()
    {
    	$shortAnsOpts[] = '';
    }
}
