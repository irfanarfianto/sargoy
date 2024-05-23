<x-dashboard-layout title="Kategori">
    <div class="container mx-auto max-w-screen-md justify-start px-4 py-8">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Kategori Baru</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="category_name">Nama Kategori</label>
                                <input type="text" class="form-control" id="category_name" name="category_name"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
