<div class="text-center question__select">
    @foreach ($question->question->options as $optionKey => $option)
        <input type="hidden" name="answers[select][{{$question->id}}][{{$optionKey}}]" value="">
        <input
            class="checkbox__question"
            type="checkbox"
            id="{{"select" . $question->id . "-" . $optionKey}}"
            name="answers[select][{{$question->id}}][{{$optionKey}}]"
            value="{{$option}}"
        >
        <label for="{{"select" . $question->id . "-" . $optionKey}}">{{$option}}</label>
    @endforeach
</div>

