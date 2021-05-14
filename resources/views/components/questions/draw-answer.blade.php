<div>
    <div class="drawingCanvasWrapper">
        <div id="{{"drawingCanvas" . $question->id }}"></div>
    </div>
    <input type="text" name="answers[draw][{{$question->id}}][editor]" hidden id="{{"painteroInput" . $question->id}}">
</div>
<div class="form-group mt-5">
    <label>Nahrať obrázok</label>
    <input type="file" id="drawUpload" class="form-control" name="answers[draw][{{$question->id}}][upload]" accept="image/*" capture="camera">
    <a href="#" id="clearDrawUpload" class="btn btn-danger mt-3">Vymazať vybraný súbor</a> 
    <span class="alert alert-warning d-block mt-3">V prípade, ak ste nakreslili a aj nahrali súbor, tak sa pri vyhodnocovaní berie do úvahy nahraný súbor!</span>
</div>