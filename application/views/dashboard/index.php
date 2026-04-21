<h1 class="h3 mb-4 text-gray-800">
    Dashboard
</h1>
<div class="row">
    <!--Kategori-->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left=primary shadow h-100 py-2">
            <div class="card body">
                <h5> Total Kategori</h5>
                <h3><?= $total_kategori; ?></h3>
            </div>
        </div>
    </div>

    <!--Buku-->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left=success shadow h-100 py-2">
            <div class="card body">
                <h5> Total Buku</h5>
                <h3><?= $total_Buku; ?></h3>
            </div>
        </div>
    </div>

<div class="card shadow-mb-4">
    <div class="card-body">
            <canvas id="chartDashboard"></canvas>
        </div>
    </div>
</div>