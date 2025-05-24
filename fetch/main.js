document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('apiForm');
  const input = document.getElementById('apiInput');
  const container = document.getElementById('right');
  const app = document.getElementById('app');

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    const url = input.value.trim();
    if (!url) return;

    // добавляем анти-кэш параметр
    // const fetchUrl = url + (url.includes('?') ? '&' : '?') + '_=' + Date.now();

    fetch(url)
      .then(res => {
        if (!res.ok) throw new Error('Ошибка загрузки');
        return res.json();
      })
      .then(data => {
        container.innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;
        container.classList.remove('hidden');
        app.classList.remove('centered');
        app.classList.add('split');
        input.focus(); // снова активируем поле ввода
      })
      .catch(err => {
        container.innerHTML = 'Ошибка загрузки данных';
        console.error(err);
      });
  });
});