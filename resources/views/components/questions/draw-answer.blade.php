
<div>
    <div class="drawingCanvasWrapper">
        <div id="drawingCanvas"></div>
    </div>
</div>


@section('bottom-script')
<script>
        const painterro = window.Painterro({
            id: "drawingCanvas",
            hiddenTools: ['close', 'rotate', 'crop', 'zoomin', 'zoomout', 'resize', 'open'],
            defaultTool: 'brush'
        })
        painterro.show()
</script>
@endsection
