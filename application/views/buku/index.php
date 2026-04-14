<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Buku</h1>
        <a href="<?= base_url('buku/tambah') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Buku
        </a>
    </div>

    <!-- Alert Messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- DataTales -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Buku</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Lokasi Rak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($buku)): ?>
                            <?php $no = 1; foreach ($buku as $b): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($b->kode_buku) ?></td>
                                <td><?= htmlspecialchars($b->judul_buku) ?></td>
                                <td><?= htmlspecialchars($b->penulis) ?></td>
                                <td><?= htmlspecialchars($b->penerbit) ?></td>
                                <td><?= $b->tahun ?></td>
                                <td>
                                    <?php if ($b->nama_kategori): ?>
                                        <span class="badge badge-info"><?= htmlspecialchars($b->nama_kategori) ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($b->stok <= 0): ?>
                                        <span class="badge badge-danger"><?= $b->stok ?></span>
                                    <?php elseif ($b->stok <= 3): ?>
                                        <span class="badge badge-warning"><?= $b->stok ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-success"><?= $b->stok ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($b->lokasi_rak) ?></td>
                                <td>
                                    <a href="<?= base_url('buku/edit/'.$b->id) ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('buku/hapus/'.$b->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus buku <?= addslashes($b->judul_buku) ?>?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" class="text-center">Belum ada data buku</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>