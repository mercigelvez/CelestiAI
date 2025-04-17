document.addEventListener('DOMContentLoaded', function() {
    const starsContainer = document.getElementById('stars-container');
    const numberOfStars = 100;

    for (let i = 0; i < numberOfStars; i++) {
        const star = document.createElement('div');
        star.classList.add('star');

        // Random position
        const x = Math.floor(Math.random() * 100);
        const y = Math.floor(Math.random() * 100);

        // Random size
        const size = Math.random() * 3;

        // Random animation delay
        const delay = Math.random() * 3;

        star.style.left = `${x}%`;
        star.style.top = `${y}%`;
        star.style.width = `${size}px`;
        star.style.height = `${size}px`;
        star.style.animationDelay = `${delay}s`;
        star.style.pointerEvents = 'none';

        starsContainer.appendChild(star);
    }
});
