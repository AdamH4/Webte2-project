<div>
    <div class="drawingCanvasWrapper">
        <div id="{{"drawingCanvas" . $question->id }}"></div>
    </div>
    <input type="text" name="answers[draw][{{$question->id}}]" hidden id="{{"painteroInput" . $question->id}}">
</div>
