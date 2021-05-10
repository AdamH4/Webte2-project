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
	                <label for="answers">Odpoveď {{ $key + 1 }}</label>
	                <input class="form-control" name="answers[]" required>
	            </div>
	        @endforeach

            <button class="btn btn-secondary mt-2" type="button" wire:click="addShortAnsOpt">Pridať možnosť</button><br>

		@elseif ($qt->type == 'select_answer')

			@foreach ($qt->questionDecoded->options as $key => $option)
	            <div class="custom-control custom-checkbox my-3">
					<input type="checkbox"
						class="custom-control-input" id="{{ $key }}" name="select_answers[]" value="{{ $key }}"
					>
					<label class="custom-control-label" for="{{ $key }}">{{ $option }}</label>
				</div>
			@endforeach

		@elseif ($qt->type == 'pair_answer')
			<div class="row">
				<div class="col">
					@foreach ($allLefts as $key => $left)
						<div class="row">
							<div class="col">
								<strong>{{ $key }})</strong> {{ $left }}
							</div>
							<div class="col">
								<div class="form-group">
									<select class="form-control"
										wire:model="formLefts.{{ $key }}"
										{{-- wire:change="checkFrees" --}}
										name="pair_left[{{ $key }}]"
										@if (isset($formLefts[$key]) && $formLefts[$key] != null)
											disabled
										@endif
									>
										@if (isset($formLefts[$key]) && $formLefts[$key] != null)
											<option value="{{ $formLefts[$key] }}" selected>{{ $formLefts[$key] }}</option>
										@else
											<option value="">-</option>
										@endif
										@foreach ($freeRights as $frKey => $fr)
											<option value="{{ $frKey }}">{{ $frKey }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col" wire:model="formLefts.{{ $key }}">
								@if (isset($formLefts[$key]))
									{{ $allRights[$formLefts[$key]] }}
									<button class="btn btn-danger ml-2" type="button" wire:click="removeFormLeft({{ $key }})">X</button>
								{{-- {{ isset($formLefts[$key]) ? $allRights[$formLefts[$key]] : '' }} --}}
								@endif
							</div>
						</div>
			        @endforeach
				</div>
				<div class="col">
					@foreach ($freeRights as $key => $option)
						<p><strong>{{ $key }})</strong> {{ $option }}</p>
					@endforeach
				</div>
			</div>

			{{-- <div class="row">
				<div class="col">
					@foreach ($qt->questionDecoded->options->left as $key => $option)
						<div class="form-group">
			                <label for="pair_left">{{ $option }}</label>
			                <input class="form-control" name="pair_left[{{ $key }}]" required>
			            </div>
			        @endforeach
				</div>
				<div class="col">
					@foreach ($qt->questionDecoded->options->right as $key => $option)
						<p><strong>{{ $key }})</strong> {{ $option }}</p>
					@endforeach
				</div>
			</div> --}}

			{{-- @foreach ($qt->questionDecoded->options->left as $key => $option)
				<h6>{{ $option }}</h6>
				@foreach ($freePairs as $fokey => $fo)
			            <div class="custom-control custom-checkbox my-2">
							<input type="checkbox" id="{{ $key . $fokey }}" name="{{ 'pair_answers[' . $key . ']' }}" class="custom-control-input" value="{{ $fo }}" wire:model="usedPairs">
							<label class="custom-control-label" for="{{ $key . $fokey }}">{{ $fo }}</label>
						</div>
					@endforeach
			@endforeach --}}

		@endif

		<button type="submit" class="btn btn-primary my-4">Uložiť</button>

	</form>
</div>
