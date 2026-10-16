document.addEventListener('DOMContentLoaded', () => {
    const flash = document.getElementById('flash-message');
    if (!flash) return;

    setTimeout(() => {
        flash.style.transition = 'opacity 0.5s ease';
        flash.style.opacity = '0';

        setTimeout(() => {
            flash.remove();
        }, 500); // wait for fade-out
    }, 5000); // 5 seconds
});

const button = document.getElementById('menu-toggle');
    const menu = document.getElementById('mobile-menu');

    button.addEventListener('click', () => {
        const isHidden = menu.classList.toggle('hidden');
        button.setAttribute('aria-expanded', String(!isHidden));
    });

    menu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            menu.classList.add('hidden');
            button.setAttribute('aria-expanded', 'false');
        });
    });