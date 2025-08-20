(function(){
  // News team filter via AJAX
  const filter = document.getElementById('news-team-filter');
  const feed = document.getElementById('news-feed');
  if (filter && feed) {
    filter.addEventListener('change', async () => {
      const endpoint = feed.dataset.endpoint;
      const team = filter.value;
      const form = new FormData();
      form.append('action', filter.dataset.ajax || 'hc_filter_news');
      form.append('team_id', team);
      try {
        const res = await fetch(endpoint, { method: 'POST', body: form, credentials: 'same-origin' });
        const html = await res.text();
        feed.innerHTML = html;
      } catch (e) { console.error('News filter failed', e); }
    });
  }

  // Live ticker polling (expects backend action hc_live_ticker to return JSON {score, eventsHtml})
  const liveBoxes = document.querySelectorAll('[data-live-ticker]');
  if (liveBoxes.length) {
    setInterval(async () => {
      for (const box of liveBoxes) {
        const matchId = box.getAttribute('data-live-ticker');
        try {
          const form = new FormData();
          form.append('action', 'hc_live_ticker');
          form.append('match_id', matchId);
          const res = await fetch(window.ajaxurl || '/wp-admin/admin-ajax.php', { method: 'POST', body: form, credentials: 'same-origin' });
          const data = await res.json();
          const ticker = document.getElementById('ticker-' + matchId);
          if (ticker && data && data.score) {
            ticker.textContent = data.score;
          }
        } catch (e) { /* silently ignore */ }
      }
    }, 15000); // 15s
  }
})();