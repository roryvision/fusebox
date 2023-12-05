

document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('[data-onboard-target]');

    buttons.forEach((button) => {
        button.addEventListener('click', function () {
            const targetId = button.getAttribute('data-onboard-target');
            const currentOnboard = document.querySelector('.step-card.show');
            const nextOnboard = document.getElementById(targetId);

            if (currentOnboard && nextOnboard) {
                currentOnboard.classList.remove('show');
                nextOnboard.classList.add('show');
            }
        });
    });
});

