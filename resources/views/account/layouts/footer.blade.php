<style>
    /* Atur body menjadi flex container */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Pastikan body setinggi 100% layar */
    }

    /* Buat konten mengambil ruang yang tersedia */
    .content {
        flex-grow: 1; /* Agar konten mengambil ruang yang tersisa */
    }

    /* Styling footer */
    footer {
        background-color: #f8f9fa;
        padding: 20px;
        text-align: center;
        width: 100%;
        position: relative;
        margin-top: auto; /* Pastikan footer selalu di bawah */
    }

    /* Footer Bottom Styling */
    .footer-bottom {
        margin-top: 20px;
        font-size: 14px;
        color: #333;
    }
</style>

<!-- Footer -->
<footer class="footer-section">
    <div class="container">
        <div class="footer-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-info">
                        <h5>SIMAWA</h5>
                        <p>© 2024 - Faculty of Engineering University of Bengkulu</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-contact">
                        <h5>Kontak</h5>
                        <p><i class="fas fa-envelope"></i> ft@unib.ac.id</p>
                        <p><i class="fas fa-phone"></i> +62 736 21170</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 - Faculty of Engineering University of Bengkulu</p>
        </div>
    </div>
</footer>
