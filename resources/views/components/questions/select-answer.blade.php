<div class="text-center question__select">
    @foreach ($question->question->options as $optionKey => $option)
        <input class="checkbox__question" type="checkbox" id="{{"age" . $question->id . "-" . $optionKey}}" name="answers[select][{{$question->id}}][{{$optionKey}}]" value="{{$option}}">
        <label for="{{"age" . $question->id . "-" . $optionKey}}">{{$option}}</label>
    @endforeach
    {{-- <input class="checkbox__question" type="checkbox" id="age2" name="answers[select][id][]" value="60">
    <label for="age2">Odpoved 2</label>
    <input class="checkbox__question" type="checkbox" id="age3" name="answers[select][id][]" value="100">
    <label for="age3">Odpoved 3</label> --}}
</div>

