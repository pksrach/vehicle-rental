<div class="modal" id="disabledAnimation" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('backend.vehicles.create') }}" method="post" autocomplete="off"
              enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Create New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{--Attachment--}}
                    <div class="mb-3">
                        <label for="attachment" class="form-label">Attachment</label>
                        <input class="form-control form-control-md" name="attachment" id="attachment" type="file"
                               accept="image/*" onchange="previewImg(event)">
                        @error('attachment')
                        <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--Preview Image--}}
                    <div style="text-align: center;">
                        <img src="" alt="" id="img1" width="300">
                    </div>

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
                    {{--Description--}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        @error('description')
                        <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--Price--}}
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price"
                               value="{{ old('price', request()->input('price')) }}">
                        @error('price')
                        <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--Brand--}}
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <select class="form-control" id="brand" name="brand">
                            <option value="">---Select Brand---</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand')
                        <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--Category--}}
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" name="category">
                            <option value="">---Select Category---</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--Location--}}
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <select class="form-control" id="location" name="location">
                            <option value="">---Select Location---</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('location')
                        <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--Active--}}
                    <div class="mb-3">
                        <label for="active" class="form-label">Active</label>
                        <select class="form-control" id="active" name="active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('active')
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
