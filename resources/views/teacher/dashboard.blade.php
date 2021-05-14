@extends('layouts.teacher', ['active' => 'dashboard'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3">
            <h1>Vitajte v <code>Examio</code> administrácii</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
    <div class="card">
    <div class="card-header">
        Približné rozdelenie úloh
    </div>
    <div class="card-body">
    <table class="table table-responsive-sm">
    <thead>
    <tr>
    <th>Úloha</th>
    <th>Podielali sa</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>návrh štruktúry databázy</td>
        <td>
            <span class="badge badge-success mr-1">B</span>
            <span class="badge badge-danger mr-1">M</span>
            <span class="badge badge-info mr-1">Č</span>
            <span class="badge badge-warning mr-1">H</span>
            <span class="badge badge-primary mr-1">K</span>
        </td>
    </tr>
    <tr>
        <td>implementácia migrácií a eloquent modelov</td>
        <td>
            <span class="badge badge-primary mr-1">K</span>
        </td>
    </tr>
    <tr>
        <td>rešerš a implementácia kresliacich a matematických editorov</td>
        <td>
            <span class="badge badge-warning mr-1">H</span>
        </td>
    </tr>
    <tr>
    <td>prihlasovanie sa do aplikácie (študent, učiteľ)</td>
    <td><span class="badge badge-success mr-1">B</span><span class="badge badge-danger mr-1">M</span></td>
    </tr>
    <tr>
    <td>realizácia otázok - teacher side</td>
    <td>
        {{-- <span class="badge badge-info mr-1">Č</span>
        <span class="badge badge-warning mr-1">H</span> --}}
        <span class="badge badge-primary mr-1">K</span>
    </td>
    </tr>
    <tr>
        <td>realizácia otázok - automaticke obodovanie odpovedí</td>
        <td>
            <span class="badge badge-info mr-1">Č</span>
            {{-- <span class="badge badge-warning mr-1">H</span> --}}
            {{-- <span class="badge badge-primary mr-1">K</span> --}}
        </td>
        </tr>
    <tr>
    <td>realizácia otázok - student side - backend</td>
    <td>
        <span class="badge badge-info mr-1">Č</span>
    </td>
    </tr>
    <tr>
    <td>realizácia otázok - frontend</td>
    <td>
        <span class="badge badge-warning mr-1">H</span>
    </td>
    </tr>
    <tr>
        <td>info pre učiteľa ozbiehaní testov, websockety (kto už ukončil akto opustil danú stránku)</td>
                <td>
                    <span class="badge badge-success mr-1">B</span><span class="badge badge-danger mr-1">M</span>
                </td>
                </tr>
                <tr>
                    <td>export do pdf, csv</td>
                    <td><span class="badge badge-info mr-1">Č</span></td>
                </tr>
                <tr>
                    <td>docker balíček</td>
                    <td>
                        <span class="badge badge-success mr-1">B</span><span class="badge badge-danger mr-1">M</span>
                    </td>
                </tr>
                <tr>
                    <td>grafický layout</td>
                    <td>
                        <span class="badge badge-success mr-1">B</span><span class="badge badge-danger mr-1">M</span>
                    </td>
                </tr>

    </tbody>
     </table>
     <div class="row">
         <div class="col-12 text-center">
            <span class="badge badge-success mr-3">Budinský</span>
            <span class="badge badge-danger mr-3">Mucska</span> 
            <span class="badge badge-info mr-3">Čavojová</span> 
            <span class="badge badge-warning mr-3">Harnúšek</span>
            <span class="badge badge-primary mr-3">Kobera</span>
         </div>
     </div>
    </div>
    </div>
    </div>
    
    
    </div>
    
    </div>

@endsection