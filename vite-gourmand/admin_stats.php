<?php
require_once 'includes/header.php';

// On simule des données qui viendraient de MongoDB (NoSQL)
$stats_nosql = [
    ['menu' => 'Noël', 'commandes' => 45],
    ['menu' => 'Printemps', 'commandes' => 28],
    ['menu' => 'Vegan', 'commandes' => 12]
];

// Conversion en JSON pour le graphique
$data_json = json_encode($stats_nosql);
?>

<div class="container mt-5">
    <h2>Tableau de bord Administrateur (Données NoSQL)</h2>
    <p class="text-muted">Comparaison des ventes par type de menu</p>
    
    <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataNoSql = <?php echo $data_json; ?>;
    const labels = dataNoSql.map(item => item.menu);
    const counts = dataNoSql.map(item => item.commandes);

    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de commandes',
                data: counts,
                backgroundColor: ['#ff6384', '#36a2eb', '#4bc0c0']
            }]
        }
    });
</script>

<?php require_once 'includes/footer.php'; ?>