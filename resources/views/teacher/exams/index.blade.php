@extends ('layouts.teacher')

@section ('title')
    <title>Zoznam testov - Examio</title>
@endsection

@section ('content')

    <div class="container">
        <div class="accordion" id="accordionExample">
            <div class="card mb-0 ">
                <div class="card-header pa-5" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Collapsible Group Item #1
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        @include('components.questions.draw-answer')
                    </div>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Collapsible Group Item #2
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        @include('components.questions.select-answer')
                    </div>
                </div>
            </div>
            <div class="card pa-4">
                <div class="card-header" id="headingThree">
                    <div class="collapsed row" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <span class="col-sm-10">Question #3 loremimask dnasdk jasndk ajsnd aksjdn askjd naskdnj askdn asjkdn aksjdn askdn asjkdn asjkdfn ajdkansd jaksdn akjsdasjkdcnsdkadjk asnd jasdkasjdnasjkdnsajkdn asdjkasndjkasnd kjasnd asbdakjdnsadiuhfrjekndksajd nasdk ajsdnaskjd askdn sakdj sad kjasndkjsa</span>
                        <span class="col-sm-2 text-right">points for #3</span>
                    </div>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        @include('components.questions.short-answer')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section ('bottom-script')

@endsection
