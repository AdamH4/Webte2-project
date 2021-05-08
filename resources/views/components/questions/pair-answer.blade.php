<div>
    <div class="pair__answers">
        @foreach ($question->question->options->right as $rightKey => $right)
            <div class="answer">
                <label>{{$rightKey}}</label>
                <input class=" form__input" name="answers[pair][{{$question->id}}][{{$rightKey}}]" type="number">
            </div>
        @endforeach
        {{-- <div class="answer">
            <label>B</label>
            <input class="form__input" name="answers[pair][{{$question->id}}][B]" type="number">
        </div>
        <div class="answer">
            <label>C</label>
            <input class="form__input" name="answers[pair][{{$question->id}}][C]" type="number">
        </div> --}}
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
