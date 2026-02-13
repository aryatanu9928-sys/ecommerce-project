@extends('admin.layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Block Information</h3>
    </div>
    <div class="card-body">
        <form action="{{route('admin.block.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" id="name" name="name" required placeholder="Enter Block name">
                </div>

                <div class="form-group">
                    <label for="identifier">Block identifier</label>
                    <input type="text" id="identifier" name="identifier" placeholder="Enter page identifier">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="description">Description *</label>
                    <input type="text" id="description" name="description" required placeholder="">
                    <small style="color: #7f8c8d;">This will be used in the URL (e.g., /about-us)</small>
                </div>

                <div class="form-group">
                    <label for="image">Block Image</label>
                    <input type="file" id="image" name="image">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
            </div>


            <div class="d-flex gap-1" style="margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">Create Block</button>
                <button type="submit" name="save_draft" class="btn btn-secondary">Save</button>
                <a href="pages-list.html" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>


</div>
</main>








@endsection