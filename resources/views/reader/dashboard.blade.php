@extends('layouts.app')

@section('content')

<div class="content">
    <!-- Top Statistics -->
    <div class="row">
        
        <div class="col-xl-4 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-2">
                <div class="card-body"> 
                    <h2 class="mb-1">{{{\App\Models\Book::active()->count()}}}</h2>
                    <p>{{__('Bibliographic record')}} </p>
                    <span class="mdi mdi-book"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-2">
                <div class="card-body">
                    <h2 class="mb-1">{{{\App\Models\Book::totalAll()}}}</h2>
                    <p>{{__('Number of books')}} </p>
                    <span class="mdi mdi-book"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-3">
                <div class="card-body">
                    <h2 class="mb-1">{{{\App\Models\BookInventar::active()->count()}}}</h2>
                    <p>{{__('Books in Copy')}}</p>
                    <span class="mdi mdi-book-multiple"></span>
                </div>
            </div>
        </div>
    </div>
  

</div> <!-- End Content -->


@endsection
