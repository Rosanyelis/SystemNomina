document.addEventListener('alpine:init', () => {
    Alpine.store('theme', {
        dark: document.documentElement.classList.contains('dark'),

        toggle() {
            this.dark = ! this.dark;
            localStorage.setItem('theme', this.dark ? 'dark' : 'light');
            document.documentElement.classList.toggle('dark', this.dark);
        },

        setLight() {
            this.dark = false;
            localStorage.setItem('theme', 'light');
            document.documentElement.classList.remove('dark');
        },

        setDark() {
            this.dark = true;
            localStorage.setItem('theme', 'dark');
            document.documentElement.classList.add('dark');
        },
    });
});
