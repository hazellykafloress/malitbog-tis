
<div class="d-flex flex-column">
    <span>Owner Name</span>
    <h5>{{ $establishment?->owner?->name }}</h5>
</div>

<div class="d-flex flex-column">
    <span>Name</span>
    <h5>{{ $establishment->name }}</h5>
</div>

<div class="d-flex flex-column">
    <span>Description</span>
    <h5>{{ $establishment->description }}</h5>
</div>

<div class="d-flex flex-column">
    <span>Address</span>
    <h5>{{ $establishment->address }}</h5>
</div>

<div class="d-flex flex-column">
    <span>Accessibility</span>
    <h5>{{ $establishment->mode_of_access }}</h5>
</div>

<div class="d-flex flex-column">
    <span>Contact Number</span>
    <h5>{{ $establishment->contact_number }}</h5>
</div>

<div class="d-flex flex-column">
    <span>Business Type</span>
    <h5>{{ $establishment->businessType->name }}</h5>
</div>
