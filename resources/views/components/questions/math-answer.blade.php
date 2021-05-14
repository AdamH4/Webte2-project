<div class="math__container">
    <div id="{{"mathLive" . $question->id}}"></div>
    <input type="text" hidden name="answers[math][{{$question->id}}][editor]" id="{{"mathLiveInput" . $question->id}}">
</div>
<div class="form-group mt-5">
    <label>Nahrať obrázok</label>
    <input type="file" id="mathUpload" class="form-control" name="answers[math][{{$question->id}}][upload]" accept="image/*" capture="camera">
    <a href="#" id="clearMathUpload" class="btn btn-danger mt-3">Vymazať vybraný súbor</a> 
    <span class="alert alert-warning d-block mt-3">V prípade, ak ste nakreslili a aj nahrali súbor, tak sa pri vyhodnocovaní berie do úvahy nahraný súbor!</span>
</div>
