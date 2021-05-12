<div>
    <div class="pair__answers">
        @foreach ($question->question->options->right as $rightKey => $right)
            <div class="answer">
                <span>{{$rightKey}}</span>
                <input class="form-control form__input" name="answers[pair][{{$question->id}}][{{$rightKey}}]" type="number">
            </div>
        @endforeach
    </div>
    <div class="pair__options">
        <ul class="first__group">
            @foreach ($question->question->options->right as $rightOption )
                <li>{{$rightOption}}</li>
            @endforeach
        </ul>
        <ul class="second__group">
            @foreach ($question->question->options->left as $left)
                <li>{{$left}}</li>
            @endforeach
        </ul>
    </div>
</div>
