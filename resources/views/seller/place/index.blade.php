@extends('layouts.seller')

@section('content')
  <div class="w-100">
    <h2 class="text-dark fw-bold">{{ isset($place->name) ? "Update $place->name" : 'Create new Place' }}</h2>
  </div>
  
  <div class="w-100 mt-2">
    @error
    @success
    <div class="card p-3 mt-4">
      <div class="row">
        <div class="col-md-6">
          <form action="/seller/place"  method="POST">
            <div class="form-group">
              @include('components.input', ['name' => 'name', 'label' => 'Place Name', 'value' => isset($place->name) ? $place->name : ''])
              @include('components.input', ['name' => 'contact', 'label' => 'Contact', 'type' => 'textarea', 'value' => isset($place->contact) ? $place->contact : ''])
              @include('components.input', ['name' => 'address', 'label' => 'Place Address', 'type' => 'textarea', 'value' => isset($place->address) ? $place->address : ''])
              @include('components.input', ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'value' => isset($place->description) ? $place->description : ''])
              <div class="w-100 mt-3 d-flex">
                <button class="btn btn-primary ms-auto">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endSection