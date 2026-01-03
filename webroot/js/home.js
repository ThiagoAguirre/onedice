// Initialize Lucide Icons
lucide.createIcons({
    attrs: {
        'stroke-width': 1.5
    }
});

// Scroll Reveal Observer
const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.1
};

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
        }
    });
}, observerOptions);

document.querySelectorAll('.reveal').forEach(el => {
    observer.observe(el);
});

// Marketplace Toggle Logic
function switchMarket(type) {
    const btnPlayer = document.getElementById('btn-player');
    const btnGm = document.getElementById('btn-gm');
    const contentPlayer = document.getElementById('content-player');
    const contentGm = document.getElementById('content-gm');

    if (type === 'player') {
        btnPlayer.classList.replace('text-stone-400', 'text-white');
        btnPlayer.classList.replace('bg-transparent', 'bg-stone-600');
        btnPlayer.classList.add('shadow');
        
        btnGm.classList.replace('text-white', 'text-stone-400');
        btnGm.classList.replace('bg-stone-600', 'bg-transparent');
        btnGm.classList.remove('shadow');

        contentPlayer.classList.remove('hidden');
        contentGm.classList.add('hidden');
    } else {
        btnGm.classList.replace('text-stone-400', 'text-white');
        btnGm.classList.replace('bg-transparent', 'bg-stone-600');
        btnGm.classList.add('shadow');

        btnPlayer.classList.replace('text-white', 'text-stone-400');
        btnPlayer.classList.replace('bg-stone-600', 'bg-transparent');
        btnPlayer.classList.remove('shadow');

        contentGm.classList.remove('hidden');
        contentPlayer.classList.add('hidden');
    }
}