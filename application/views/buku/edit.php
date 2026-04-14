<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Buku</h1>
        <a href="<?= base_url('buku') ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">
            <form method="post" action="<?= base_url('buku/update/'.$buku->id) ?>">
                
                <div class="form-group">
                    <label>Kode Buku <span class="text-danger">*</span></label>
                    <input type="text" name="kode_buku" class="form-control" value="<?= $buku->kode_buku ?>" required>
                </div>

                <div class="form-group">
                    <label>Judul Buku <span class="text-danger">*</span></label>
                    <input type="text" name="judul_buku" class="form-control" value="<?= $buku->judul_buku ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Penulis <span class="text-danger">*</span></label>
                            <input type="text" name="penulis" class="form-control" value="<?= $buku->penulis ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Penerbit <span class="text-danger">*</span></label>
                            <input type="text" name="penerbit" class="form-control" value="<?= $buku->penerbit ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tahun <span class="text-danger">*</span></label>
                            <input type="number" name="tahun" class="form-control" value="<?= $buku->tahun ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori_id" class="form-control">
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($kategori as $k): ?>
                                    <option value="<?= $k->id ?>" <?= ($k->id == $buku->kategori_id) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($k->nama_kategori) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" value="<?= $buku->stok ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Lokasi Rak</label>
                    <input type="text" name="lokasi_rak" class="form-control" value="<?= $buku->lokasi_rak ?>">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>

            </form>
        </div>
    </div>
</div>