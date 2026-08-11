<form method="POST" action="{{ route('admin.products.store') }}">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold">Kategori</label>
            <input type="text" name="category" class="form-control" value="Bubur" required>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold">Umur</label>
            <input type="text" name="age_group" class="form-control" value="6+ Bulan" required>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">Harga</label>
            <input type="number" name="price" class="form-control" min="1" required>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">Stok</label>
            <input type="number" name="stock" class="form-control" min="0" required>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">Status</label>
            <select name="status" class="form-select">
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
            </select>
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold">Bahan</label>
            <textarea name="ingredients" class="form-control" rows="3"></textarea>
        </div>
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-brand-purple"><i class="fa-solid fa-save me-2"></i> Simpan Produk</button>
        </div>
    </div>
</form>
