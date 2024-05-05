<div class="modal" id="disabledAnimation" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('backend.locations.create') }}" method="post" autocomplete="off"
              enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Create New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{--ID hidding--}}
                    <input type="hidden" name="id" id="id">
                    {{--Name--}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ old('name', request()->input('name')) }}">
                        @error('name')
                        <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--Parent Location--}}
                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Parent Location</label>
                        <select class="form-select" id="parent_id" name="parent_id">
                            <option value="">Select Parent Location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}"
                                    {{ old('parent_id', request()->input('parent_id')) == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_id')
                        <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{--Button--}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="submitButton" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
