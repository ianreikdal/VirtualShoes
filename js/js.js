const slides = document.getElementById('slides');
        const total = slides.children.length;
        let idx = 0;
        function showSlide(i) {
            slides.style.transform = 'translateX(' + (-i * 100) + '%)';
        }
        document.getElementById('next').addEventListener('click', () => {
            idx = (idx + 1) % total;
            showSlide(idx);
        });
        document.getElementById('prev').addEventListener('click', () => {
            idx = (idx - 1 + total) % total;
            showSlide(idx);
        });