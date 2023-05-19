@extends('layouts.app')

@section('content')
<div class="container">
    <a class="btn btn-primary mb-2" href="/list">Kembali</a>
    <div class="card">
        <div class="card-body">
            <h4 class="my-auto">Master Produk</h4>
            <hr>
            <form method="POST" action="/addproduct" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nama*</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- <div class="form-group">
                    <label for="image">Gambar</label>
                    <div class="custom-file">
                        <input id="image" class="custom-file-input" type="file" accept="image/png, image/jpeg" name="image_url" value="{{ old('image_url') }}">
                        <label id="image-label" class="custom-file-label" for="image_url">Pilih gambar</label>
                    </div>
                    @error('image_url')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> -->
                <div class="mb-3">
                    <label for="image" class="form-label">Cover</label>
                    <input class="form-control" type="file" id="formFile" accept="image/png, image/jpeg" name="image_url" value="{{ old('image_url') }}">
                </div>
                <!-- <div class="form-group">
                    <label for="description">Description*</label>
                    <input id="description" class="form-control" type="text" name="description" value="{{ old('description') }}">
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description*</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" value="{{ old('description') }}"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Harga*</label>
                    <input id="price" class="form-control" type="text" name="price" value="{{ old('price') }}">
                    @error('price')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="stock">Stock*</label>
                    <input id="stock" class="form-control" type="text" name="stock" value="{{ old('stock') }}">
                    @error('stock')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <hr>
                <div class="d-flex">
                    <button class="btn btn-primary ml-auto" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<!-- @section('scripts')
<script>
    document.getElementById('image').addEventListener('change', (e) => {
        const fullPath = document.getElementById('image').value

        if (fullPath) {
            const startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'))
            let filename = fullPath.substring(startIndex)

            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1)
            }

            document.getElementById('image-label').innerHTML = filename
        }
    })
</script>
@endsection -->