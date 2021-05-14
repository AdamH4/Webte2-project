<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEST</title>
</head>
<style>
body {
    font-family: DejaVu Sans;
    font-size: 12px
}
</style>
<body>
<section>
<div>
    @foreach ($questions as $id => $question)
        <div>
            <b>Otázka:</b> {{$question['question']}}
        </div>
        <div>
            @switch($question['type'])
                @case("draw_answer")
                <div style="margin-top: 20px; margin-bottom: 20px;">
                    <b>Odpoveď:</b>
                    <div style="margin-left: 20px;"><img width="300" src="{{$answers[$id]}}" alt=""/></div>
                </div>
                @break
                @case("math_answer")
                <div style="margin-top: 20px; margin-bottom: 20px;">
                    <b>Odpoveď:</b>
                    @if(!empty($answers[$id]) && !$question['answer_is_uploaded_file'])
                        <img src="http://latex.codecogs.com/gif.latex?{{$answers[$id]}}" style="margin-top: 3px; margin-left: 8px;border:1px solid #000;" alt=""/>
                    @else
                        <div style="margin-left:20px;"><img src="{{ $answers[$id] }}" width="300" alt=""/></div>
                    @endif
                </div>
                @break
                @case("pair_answer")
                Možnosti:
                @foreach ($options[$id] as $optionType => $optionArray)
                    @foreach($optionArray as $letterKey => $letterValue)
                        <div style="margin-left: 20px;">{{$letterKey}}. {{$letterValue}}<br></div>
                    @endforeach
                @endforeach
                <div style="margin-top: 20px; margin-bottom: 20px;">
                    <b>Odpoveď:</b>
                    @if(! empty($answers[$id]))
                        @foreach ($answers[$id] as $numberKey => $data)
                            <div style="margin-left: 20px;">{{$data['rightKey']}}. {{$data['right']}} => {{$numberKey}}. {{$data['left']}}</div>
                        @endforeach
                    @endif
                </div>
                @break
                @case("select_answer")
                Možnosti:
                @foreach ($options[$id] as $position => $value)
                    <div style="margin-left: 20px;">{{$position}}. {{$value}}<br></div>
                @endforeach
                <div style="margin-top: 20px; margin-bottom: 20px;">
                    <b>Odpoved:</b>
                    @if(! empty($answers[$id]))
                        @foreach ($answers[$id] as $position => $value)
                            <div style="margin-left: 20px;">{{$position}}. {{$value}}</div>
                        @endforeach
                    @endif
                </div>
                @break
                @case("short_answer")
                <div  style="margin-top: 20px; margin-bottom: 20px;">
                    <b>Odpoveď:</b>
                    @if(! empty($answers[$id]))
                        {{$answers[$id]}}
                    @endif
                </div>
                @break
                @default
            @endswitch
        </div>
        <hr>
    @endforeach
</div>
</section>
</body>
</html>
