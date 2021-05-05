<div>
    <form action="{{ route('teacher.questions.answers.create', [$exam, $qt]) }}" method="POST">
		@csrf

		<div class="form-group">
            <label for="points">Počet bodov za túto odpoveď</label>
            <input type="number" class="form-control" name="points" required step="0.01" value="{{ $qt->points }}">
        </div>

		@if ($qt->type == 'short_answer')

		<h5>Môžete uviesť viac možností, v prípadne, že správna odpoveď má synonymum</h5>

			@foreach ($shortAnsOpts as $key => $sao)
				<div class="form-group">
	                <label for="answer">Odpoveď {{ $key + 1 }}</label>
	                <input class="form-control" name="answer" required>
	            </div>
	        @endforeach

            <button class="btn btn-secondary mt-2" type="button" wire:click="addShortAnsOpt">Pridať možnosť</button><br>

		@elseif ($qt->type == 'select_answer')

			@foreach ($qt->questionDecoded->options as $option)
	            <div class="custom-control custom-checkbox my-3">
					<input type="checkbox"
						class="custom-control-input" id="{{ $option }}" name="select_answers[]" value="{{ $option }}"
					>
					<label class="custom-control-label" for="{{ $option }}">{{ $option }}</label>
				</div>
			@endforeach

		@elseif ($qt->type == 'pair_answer')

			<div class="row">
				<div class="col">
					@foreach ($qt->questionDecoded->options->left as $option)
			            <div class="custom-control custom-checkbox my-3">
							<input type="checkbox"
								class="custom-control-input" id="{{ $option }}" name="select_answers[]" value="{{ $option }}"
							>
							<label class="custom-control-label" for="{{ $option }}">{{ $option }}</label>
						</div>
					@endforeach
				</div>
				<div class="col">
					@foreach ($qt->questionDecoded->options->right as $option)
			            <div class="custom-control custom-checkbox my-3">
							<input type="checkbox"
								class="custom-control-input" id="{{ $option }}" name="select_answers[]" value="{{ $option }}"
							>
							<label class="custom-control-label" for="{{ $option }}">{{ $option }}</label>
						</div>
					@endforeach
				</div>
			</div>

		@endif

		<button type="submit" class="btn btn-primary my-4">Uložiť</button>

	</form>
</div>
