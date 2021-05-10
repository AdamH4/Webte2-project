<div>
    <form action="{{ route('teacher.questions.create', $exam) }}" method="POST">
		@csrf

        <div class="form-group">
            <label for="type">Typ otázky</label>
            <select class="form-control" name="type" wire:model="qtType"
            {{-- wire:change="qtTypeChanged" --}}
             required>
                @foreach($qtTypes as $enType => $skType)
                    <option value="{{ $enType }}">{{ $skType }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="question">Otázka</label>
            <textarea class="form-control" name="question" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="points">Maximálny počet bodov</label>
            <input type="number" step="0.01" class="form-control" name="points" required>
        </div>

        @if ($qtType == 'select_answer')

        	<h5>Možnosti</h5>

	    	@foreach ($shortAnsOpts as $key => $sao)
		    	<div class="form-group">
		            <label for="short_ans_opts">Možnosť {{ $key + 1 }}</label>
		            <input class="form-control" name="short_ans_opts[]" type="text" wire:model="shortAnsOpts.{{ $key }}">
		        </div>
	        @endforeach

	        <button class="btn btn-secondary mt-2" type="button" wire:click="addShortAnsOpt">Pridať možnosť</button><br>
			
	    @elseif ($qtType == 'pair_answer')

	    	<h5>Možnosti</h5>

	    	<div class="row">
	    		<div class="col">
	    			<h6>Ľavá strana</h6>
	    		</div>

	    		<div class="col">
	    			<h6>Pravá strana</h6>
	    		</div>
	    	</div>

	    	<div class="row">
	    		<div class="col">
	    			@foreach ($pairAnsOpts['left'] as $key => $plao)
				    	<div class="form-group">
				            <label for="pair_left">
				            	Možnosť <strong>{{ $key }}</strong>
				            </label>
							<input class="form-control" name="pair_left[]" type="text" wire:model="pairAnsOpts.left.{{ $key }}">
							<input name="pair_left_ind[]" type="hidden" value="{{ $key }}">
				        </div>
			        @endforeach
	    		</div>

	    		<div class="col">
	    			@foreach ($pairAnsOpts['right'] as $key => $plao)
				    	<div class="form-group">
				            <label for="pair_right">
				            	Možnosť <strong>{{ $key }}</strong>
				            </label>
							<input class="form-control" name="pair_right[]" type="text" wire:model="pairAnsOpts.right.{{ $key }}">
							<input name="pair_right_ind[]" type="hidden" value="{{ $key }}">
				        </div>
			        @endforeach
	    		</div>
	    	</div>

	        <div class="row">
	    		<div class="col">
	    			<button class="btn btn-secondary mt-3" type="button" wire:click="addPairAnsOpt('left')">
	    				Pridať možnosť na ľavú stranu
	    			</button>
	    		</div>

	    		<div class="col">
	    			<button class="btn btn-secondary mt-3" type="button" wire:click="addPairAnsOpt('right')">
	    				Pridať možnosť na pravú stranu
	    			</button>
	    		</div>
	    	</div>

        @endif

		<button type="submit" class="btn btn-primary my-4">Uložiť</button>
	</form>
</div>
