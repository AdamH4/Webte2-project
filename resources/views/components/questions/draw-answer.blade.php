
<div>
    <div id="drawingCanvas"></div>
</div>


{{-- Tuto musis tiez napojit na ten @yield zo student.blade.php co je uplne dole @yield('bottom-script') --}}
@section('bottom-script')
<script>
    console.log(window.Painterro)
        const painterro = window.Painterro({
            id: "drawingCanvas"
        })
        painterro.show()
</script>
@endsection
