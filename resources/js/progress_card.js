(function () {
  function getConfig() {
    const el = document.getElementById('dashboard-config');
    return {
      totalsUrl: el?.dataset?.totalsUrl || '',
      csrfToken: document.querySelector('meta[name="csrf-token"]')?.content || '',
    };
  }

  function setRing(id, value, max) {
    const card = document.getElementById(id);
    if (!card) return;
    const ring = card.querySelector('[data-ring]');
    const valueEl = card.querySelector('[data-value]');
    if (!ring || !valueEl) return;

    const c = Number(card.dataset.circumference || 0);
    if (!c) return;

    const v = Number(value) || 0;
    const m = Number(max) || 0;
    const pct = m > 0 ? Math.min(Math.max(v / m, 0), 1) : 0;
    ring.style.strokeDashoffset = String(c * (1 - pct));
    valueEl.textContent = v.toLocaleString(undefined, { maximumFractionDigits: 1 });
  }

  function applyTotals(data) {
    if (!data) return;
    setRing('ring-calories', data.remainingCalories, data.goalCalories);
    setRing('ring-protein', data.protein, data.proteinGoal);
    setRing('ring-carbs', data.carbohydrate, data.carbsGoal);
  }

  async function hydrateFromServer() {
    const { totalsUrl } = getConfig();
    if (!totalsUrl) return;
    const res = await fetch(totalsUrl, {
      headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      credentials: 'same-origin',
      cache: 'no-store',
    });
    if (!res.ok) throw new Error('Totals request failed: ' + res.status);
    const payload = await res.json();
    applyTotals(payload.data);
  }

  document.addEventListener('DOMContentLoaded', () => {
    hydrateFromServer().catch(console.error);

    // Delegated submit handler (works even if form is replaced/re-rendered)
    document.addEventListener('submit', async (e) => {
      const form = e.target;
      if (!(form instanceof HTMLFormElement)) return;
      if (form.id !== 'add-nutrition-form') return;

      e.preventDefault();
      e.stopPropagation();

      const submitBtn = form.querySelector('[type="submit"]');
      if (submitBtn) submitBtn.disabled = true;

      try {
        const { csrfToken } = getConfig();

        const res = await fetch(form.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
          },
          body: new FormData(form),
          credentials: 'same-origin',
        });

        if (!res.ok) throw new Error('Add nutrition failed: ' + res.status);
        const payload = await res.json();
        applyTotals(payload.data);

        document.getElementById('food-lookup')?.classList.remove('hidden');
        document.getElementById('nutrition-data')?.classList.add('hidden');
      } catch (err) {
        console.error(err);
      } finally {
        if (submitBtn) submitBtn.disabled = false;
      }
    }, true); // capture phase to intercept early
  });

  window.addEventListener('pageshow', () => {
    hydrateFromServer().catch(console.error);
  });
})();