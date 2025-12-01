document.addEventListener('DOMContentLoaded', function() {
    const backgrounds = [
        'url(../../img/index/Bg-1.png)',
        'url(../../img/index/Bg-2.png)',
        'url(../../img/index/Bg-3.png)'
    ];
    let currentBg = 0;
    const heroSection = document.getElementById('hero-section');
    const progressBar = document.getElementById('progress-bar');

    function animateProgressBarAndBackground() {
        // Reset progress bar instantly before starting animation
        progressBar.style.transition = 'none';
        progressBar.style.width = '0';
        void progressBar.offsetWidth;
        setTimeout(() => {
            progressBar.style.transition = 'width 5s linear';
            progressBar.style.width = '100%';
        }, 50);

        let localCountdown = 5;
        const timer = setInterval(() => {
            localCountdown--;
            if (localCountdown <= 0) {
                clearInterval(timer);
                // Change background
                currentBg = (currentBg + 1) % backgrounds.length;
                heroSection.style.backgroundImage = backgrounds[currentBg];
                // Reset progress bar instantly
                progressBar.style.transition = 'none';
                progressBar.style.width = '0';
                void progressBar.offsetWidth;
                setTimeout(() => {
                    progressBar.style.transition = 'width 5s linear';
                    progressBar.style.width = '100%';
                }, 50);
                // Restart countdown and animation
                animateProgressBarAndBackground();
            }
        }, 1000);
    }

    animateProgressBarAndBackground();
});
