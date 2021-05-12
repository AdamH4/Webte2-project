<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEST</title>
</head>
<body>
<section>
<div>
    @foreach ($questions as $id => $question)
        <div>
            <b>Otazka:</b> {{$question['question']}}
        </div>
        <div>
            @switch($question['type'])
                @case("draw_answer")
                <div style="margin-top: 20px; margin-bottom: 20px;">
                    <b>Odpoved:</b>
                    <div style="margin-left: 20px;"><img width="300" src="{{$answers[$id]}}" alt=""/></div>
                </div>
                @break
                @case("math_answer")
                <div style="margin-top: 20px; margin-bottom: 20px;">
                    <b>Odpoved:</b>
                    <img src="http://latex.codecogs.com/gif.latex?{{$answers[$id]}}" style="margin-top: 3px; margin-left: 8px;" alt=""/>
                </div>
                @break
                @case("pair_answer")
                Moznosti:
                @foreach ($options[$id] as $optionType => $optionArray)
                    @foreach($optionArray as $letterKey => $letterValue)
                        <div style="margin-left: 20px;">{{$letterKey}}. {{$letterValue}}<br></div>
                    @endforeach
                @endforeach
                <div style="margin-top: 20px; margin-bottom: 20px;">
                    <b>Odpoved:</b>
                    @foreach ($answers[$id] as $numberKey => $data)
                        <div style="margin-left: 20px;">{{$data['rightKey']}}. {{$data['right']}} => {{$numberKey}}. {{$data['left']}}</div>
                    @endforeach
                </div>
                @break
                @case("select_answer")
                Moznosti:
                @foreach ($options[$id] as $position => $value)
                    <div style="margin-left: 20px;">{{$position}}. {{$value}}<br></div>
                @endforeach
                <div style="margin-top: 20px; margin-bottom: 20px;">
                    <b>Odpoved:</b>
                    @foreach ($answers[$id] as $position => $value)
                        <div style="margin-left: 20px;">{{$position}}. {{$value}}</div>
                    @endforeach
                </div>
                @break
                @case("short_answer")
                <div  style="margin-top: 20px; margin-bottom: 20px;">
                    <b>Odpoved:</b> {{$answers[$id]}}
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
