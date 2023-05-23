@extends('layout.main')
@section('content')
<!-- Page Heading -->
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 mb-2 text-gray-800">Character Table</h1>
    <button class="btn btn-primary btn-add-char" data-toggle="modal" data-target="#addCharModal"><i
            class="fas fa-user-plus"></i>&nbsp;Add New Character</button>
</div>
<!-- Modal -->
<div class="modal fade" id="addCharModal" tabindex="-1" role="dialog" aria-labelledby="addCharModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCharModalLabel">Add New Character</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <ul id="msg"></ul>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-9">
                        <label for="name">Name</label>
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" id="name" name="name" autofocus>
                        <div id="name-feedback" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-3">
                        <label for="rarity">Rarity</label>
                        <select class="form-control" id="rarity" name="rarity">
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <div id="rarity-feedback" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="birthday">Birthday</label>
                        <input type="date" class="form-control" id="birthday" name="birthday">
                        <div id="birthday-feedback" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-6">
                        <label for="constellation">Constellation</label>
                        <input type="text" class="form-control" id="constellation" name="constellation">
                        <div id="constellation-feedback" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="weapon">Weapon</label>
                        <select class="form-control" id="weapon" name="weapon">
                            <option value="sword">Sword</option>
                            <option value="claymore">Claymore</option>
                            <option value="polearm">Polearm</option>
                            <option value="catalyst">Catalyst</option>
                            <option value="bow">Bow</option>
                        </select>
                        <div id="weapon-feedback" class="invalid-feedback"></div>

                    </div>
                    <div class="form-group col">
                        <label for="vision">Vision</label>
                        <select class="form-control" id="vision" name="vision">
                            <option value="pyro">Pyro</option>
                            <option value="hydro">Hydro</option>
                            <option value="electro">Electro</option>
                            <option value="cryo">Cryo</option>
                            <option value="dendro">Dendro</option>
                            <option value="anemo">Anemo</option>
                            <option value="geo">Geo</option>
                        </select>
                        <div id="vision-feedback" class="invalid-feedback"></div>

                    </div>
                    <div class="form-group col">
                        <label for="region">Region</label>
                        <input type="text" class="form-control" id="region" name="region">
                        <div id="region-feedback" class="invalid-feedback"></div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="save">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
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
                        <th>#</th>
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