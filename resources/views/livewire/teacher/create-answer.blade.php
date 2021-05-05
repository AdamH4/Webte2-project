<div>
    <form action="{{ route('teacher.questions.answers.create', [$exam, $qt]) }}" method="POST">
		@csrf

		<div class="form-group">
            <label for="points">Počet bodov za túto odpoveď</label>
            <input type="number" class="form-control" name="points" required step="0.01">
        </div>

		@if ($qt->type == 'short_answer')
			<div class="form-group">
                <label for="answer">Odpoveď</label>
                <input class="form-control" name="answer" required>
            </div>
		@elseif ($qt->type == 'select_answer')
			<div class="form-group">
                <label for="answer">Odpoveď</label>
                <input class="form-control" name="answer" required>
            </div>
		@elseif ($qt->type == 'pair_answer')
			c
		@endif

		<button type="submit" class="btn btn-primary">Uložiť</button>

	</form>
</div>
