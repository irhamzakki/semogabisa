<!-- Gaya Modern (Tailwind + FontAwesome CDN optional) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
    .dashboard-box {
        padding: 20px;
        border-radius: 15px;
        color: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        transition: transform 0.2s ease;
    }
    .dashboard-box:hover {
        transform: translateY(-5px);
    }
    .info-icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <h1 class="text-center">📊 Dashboard Statistik Penduduk</h1>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="row">
            <!-- Penduduk -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-box" style="background-color: #00c0ef;">
                    <div class="text-center">
                        <i class="fas fa-users info-icon"></i>
                        <h4>Penduduk</h4>
                        <h2><?= $this->db->count_all_results('penduduk'); ?></h2>
                    </div>
                </div>
            </div>

            <!-- Kelahiran -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-box" style="background-color: #00a65a;">
                    <div class="text-center">
                        <i class="fas fa-baby info-icon"></i>
                        <h4>Kelahiran</h4>
                        <h2><?= $this->db->count_all_results('Kelahiran'); ?></h2>
                    </div>
                </div>
            </div>

            <!-- Kematian -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-box" style="background-color: #f39c12;">
                    <div class="text-center">
                        <i class="fas fa-book-dead info-icon"></i>
                        <h4>Kematian</h4>
                        <h2><?= $this->db->count_all_results('Kematian'); ?></h2>
                    </div>
                </div>
            </div>

            <!-- Pindah -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-box" style="background-color: #dd4b39;">
                    <div class="text-center">
                        <i class="fas fa-right-left info-icon"></i>
                        <h4>Pindah</h4>
                        <h2><?= $this->db->count_all_results('pindahdatang'); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Statistik -->
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-12">
                <div class="box" style="padding: 20px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    <h3 class="text-center">📈 Statistik Data Grafik</h3>
                    <canvas id="barChart" style="max-height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const penduduk = <?= $this->db->count_all_results('penduduk'); ?>;
    const kelahiran = <?= $this->db->count_all_results('Kelahiran'); ?>;
    const kematian = <?= $this->db->count_all_results('Kematian'); ?>;
    const pindah = <?= $this->db->count_all_results('pindahdatang'); ?>;

    const ctx = document.getElementById('barChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Penduduk', 'Kelahiran', 'Kematian', 'Pindah'],
            datasets: [{
                label: 'Jumlah Data',
                data: [penduduk, kelahiran, kematian, pindah],
                backgroundColor: ['#00c0ef', '#00a65a', '#f39c12', '#dd4b39'],
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: context => `${context.parsed.y} data`
                    }
                }
            }
        }
    });
</script>
