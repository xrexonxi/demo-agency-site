document.querySelectorAll('a[data-plan]').forEach(btn => {
  btn.addEventListener('click', e => {
    const plan = e.currentTarget.getAttribute('data-plan');
    const input = document.getElementById('selectedPlan');
    if (input) input.value = plan || '';
  });
});

// Smooth scroll (simple)
document.querySelectorAll('a[href^="#"]').forEach(link => {
  link.addEventListener('click', function(e) {
    const id = this.getAttribute('href').slice(1);
    const el = document.getElementById(id);
    if (el) {
      e.preventDefault();
      el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});
