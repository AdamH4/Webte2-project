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

        @if ($qtType == 'short_answer')
			
	    @elseif ($qtType == 'select_answer')

	    	<h5>Možnosti</h5>

	    	@foreach ($shortAnsOpts as $key => $sao)
		    	<div class="form-group">
		            <label for="question">Otázka {{ $key }}</label>
		            <input class="form-control" name="question" type="text" wire:model="shortAnsOpts.{{ $key }}" required>
		        </div>
	        @endforeach

	        <button class="btn btn-secondary" type="button" wire:click="addShortAnsOpt">Pridať možnosť</button>

        @endif

		<button type="submit" class="btn btn-primary">Uložiť</button>
	</form>
</div>
