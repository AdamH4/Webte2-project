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
    public $freeRights = [];
    public $allRights = [];
    public $allLefts = [];
    public $formLefts = [];

	public function mount($exam, $qt)
    {
        $this->exam = $exam;
        $this->qt = $qt;
        // $this->qtTypes = Question::types;
        $this->freeRights = (array) $qt->questionDecoded->options->right;
        $this->allRights = (array) $qt->questionDecoded->options->right;
        $this->allLefts = (array) $qt->questionDecoded->options->left;
        $this->formLefts = (array) $qt->questionDecoded->options->left;

        foreach ($this->formLefts as $key => $fl) {
            $this->formLefts[$key] = null;
        }
    }

    public function render()
    {
        // dd($this->allLefts);
        return view('livewire.teacher.create-answer', [
        	'exam' => $this->exam,
        	'qt' => $this->qt,
            'shortAnsOpts' => $this->shortAnsOpts,
            'freeRights' => $this->freeRights,
            'allRights' => $this->allRights,
            'allLefts' => $this->allLefts,
            'formLefts' => $this->formLefts,
        ]);
    }

    public function addShortAnsOpt()
    {
    	$this->shortAnsOpts[] = '';
    }

    public function checkFrees()
    {
        $this->freeRights = [];
        foreach ($this->allRights as $key => $fr) {
            if (!in_array($key, $this->formLefts)) {
                $this->freeRights[$key] = $fr;
            }
        }

        // dd($this->freeRights, $this->formLefts, $this->allRights, $this->allLefts);
    }
}
