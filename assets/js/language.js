function changeLanguage(lang) {
    localStorage.setItem('lang', lang);
    // Implementasi terjemahan dengan fetch file json
    fetch(`lang/${lang}.json`)
        .then(res => res.json())
        .then(translations => {
            document.querySelectorAll('[data-translate]').forEach(el => {
                let key = el.getAttribute('data-translate');
                if (translations[key]) el.innerText = translations[key];
            });
        });
}
