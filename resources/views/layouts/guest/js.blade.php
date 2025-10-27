<!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>


        // Back to top button
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopButton = document.querySelector('.back-to-top');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.style.display = 'block';
                } else {
                    backToTopButton.style.display = 'none';
                }
            });

            backToTopButton.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({top: 0, behavior: 'smooth'});
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Search functionality
            const searchInput = document.querySelector('input[placeholder="Cari warga..."]');
            const cards = document.querySelectorAll('.widget-card');

            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();

                    cards.forEach(card => {
                        const text = card.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            card.closest('.warga-card').style.display = 'block';
                        } else {
                            card.closest('.warga-card').style.display = 'none';
                        }
                    });
                });
            }

            // Filter functionality
            const filterOptions = document.querySelectorAll('.filter-option');
            let currentFilter = 'all';

            filterOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentFilter = this.getAttribute('data-filter');

                    const wargaCards = document.querySelectorAll('.warga-card');
                    wargaCards.forEach(card => {
                        const gender = card.getAttribute('data-gender');

                        if (currentFilter === 'all' || gender === currentFilter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Update dropdown text
                    const dropdownButton = document.querySelector('.dropdown-toggle');
                    const filterText = this.textContent;
                    dropdownButton.innerHTML = `<i class="fas fa-filter me-2"></i>${filterText}`;
                });
            });

            // Smooth animations
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100
            });

            // Enhanced search with Enter key
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const searchTerm = e.target.value.toLowerCase();

                        cards.forEach(card => {
                            const text = card.textContent.toLowerCase();
                            if (text.includes(searchTerm)) {
                                card.closest('.warga-card').style.display = 'block';
                                card.classList.add('fade-in');
                            } else {
                                card.closest('.warga-card').style.display = 'none';
                            }
                        });
                    }
                });
            }

            // Add loading animation to cards
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                    }
                });
            }, observerOptions);

            // Observe all cards
            document.querySelectorAll('.warga-card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>

<!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Simple spinner hide
        window.addEventListener('load', function() {
            document.getElementById('spinner').style.display = 'none';
        });

        // Back to top button
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopButton = document.querySelector('.back-to-top');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.style.display = 'block';
                } else {
                    backToTopButton.style.display = 'none';
                }
            });

            backToTopButton.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({top: 0, behavior: 'smooth'});
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const cards = document.querySelectorAll('.jenis-surat-card');

            function filterJenisSurat() {
                const searchTerm = searchInput.value.toLowerCase();

                cards.forEach(card => {
                    const text = card.textContent.toLowerCase();
                    const cardItem = card.closest('.jenis-surat-card-item');

                    if (text.includes(searchTerm)) {
                        cardItem.style.display = 'block';
                    } else {
                        cardItem.style.display = 'none';
                    }
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', filterJenisSurat);
            }

            // Filter functionality
            const filterOptions = document.querySelectorAll('.filter-option');
            let currentFilter = 'all';

            filterOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentFilter = this.getAttribute('data-filter');

                    const jenisSuratCards = document.querySelectorAll('.jenis-surat-card-item');
                    jenisSuratCards.forEach(card => {
                        const syarat = card.getAttribute('data-syarat');

                        if (currentFilter === 'all' ||
                            (currentFilter === 'with-syarat' && syarat === 'with-syarat') ||
                            (currentFilter === 'without-syarat' && syarat === 'without-syarat')) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Update dropdown text
                    const dropdownButton = document.querySelector('.dropdown-toggle');
                    const filterText = this.textContent;
                    dropdownButton.innerHTML = `<i class="fas fa-filter me-2"></i>${filterText}`;
                });
            });

            // Smooth animations
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100
            });

            // Enhanced search with Enter key
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        filterJenisSurat();
                    }
                });
            }

            // Add loading animation to cards
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                    }
                });
            }, observerOptions);

            // Observe all cards
            document.querySelectorAll('.jenis-surat-card-item').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>

//data warga
<script>
        window.addEventListener('load', function() {
            document.getElementById('spinner').style.display = 'none';
        });
    </script>
</body>
</html>
