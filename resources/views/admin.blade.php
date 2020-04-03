@extends('layouts.admin')

@section('content')
 <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
        <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in as admin!
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
