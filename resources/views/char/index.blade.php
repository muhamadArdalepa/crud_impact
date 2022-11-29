@extends('layout.main')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Character Table</h1>
<button class="btn btn-primary" onclick="Swal.fire(
    'Good job!',
    'You clicked the button!',
    'success'
  )">Add Character</button>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Rarity</th>
                        <th>Weapon</th>
                        <th>Vision</th>
                        <th>Birthday</th>
                        <th>Constellation</th>
                        <th>Region</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Rarity</th>
                        <th>Weapon</th>
                        <th>Vision</th>
                        <th>Birthday</th>
                        <th>Constellation</th>
                        <th>Region</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection