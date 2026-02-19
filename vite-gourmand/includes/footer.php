</div> <footer id="contact" class="bg-dark text-white mt-5">
    <div class="container-fluid py-5"> 
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase fw-bold" style="color: #d4af37;">Vite & Gourmand</h5>
                    <p>Votre traiteur bordelais de confiance, alliant fraîcheur et rapidité.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase fw-bold">Horaires de livraison</h5>
                    <ul class="list-unstyled">
                        <li>Lundi - Vendredi : 08h00 - 20h00</li>
                        <li>Samedi : 09h00 - 22h00</li>
                        <li>Dimanche : Fermé</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase fw-bold">Contact</h5>
                    <p>📍 12 rue de la Gourmandise, Bordeaux<br>
                       📞 05 56 00 00 00<br>
                       ✉️ contact@vite-gourmand.fr</p>
                </div>
            </div>
            <hr class="bg-secondary">
            <p class="text-center mb-0">&copy; 2026 Vite & Gourmand - Projet ECF</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Animation de la barre de progression au chargement
    window.onload = function() {
        const loader = document.getElementById('loader-bar');
        if(loader) {
            loader.style.width = '100%';
            setTimeout(() => {
                loader.style.opacity = '0';
            }, 400);
        }
    };
</script>
</body>
</html>