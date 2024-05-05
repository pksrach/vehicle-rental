<div class="modal" id="disabledAnimation" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('backend.payment_methods.create') }}" method="post" autocomplete="off"
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
                    {{--Payment Name--}}
                    <div class="mb-3">
                        <label for="payment_name" class="form-label">Payment Name</label>
                        <input type="text" class="form-control" id="payment_name" name="payment_name"
                               value="{{ old('payment_name', request()->input('payment_name')) }}">
                        @error('payment_name')
                        <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--Account Name--}}
                    <div class="mb-3">
                        <label for="account_name" class="form-label">Account Name</label>
                        <input type="text" class="form-control" id="account_name" name="account_name"
                               value="{{ old('account_name', request()->input('account_name')) }}">
                        @error('account_name')
                        <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--Account Number--}}
                    <div class="mb-3">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="text" class="form-control" id="account_number" name="account_number"
                               value="{{ old('account_number', request()->input('account_number')) }}">
                        @error('account_number')
                        <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--Links--}}
                    <div class="mb-3">
                        <label for="links" class="form-label">Links</label>
                        <input type="text" class="form-control" id="links" name="links"
                               value="{{ old('links', request()->input('links')) }}">
                        @error('links')
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
