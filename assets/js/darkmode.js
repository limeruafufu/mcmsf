;(function(){
    const KEY = 'darkMode';
    function apply(enabled){
        document.documentElement.classList.toggle('dark-mode', enabled);
        document.documentElement.classList.toggle('oneui-dark', enabled);
        document.body.classList.toggle('dark-mode', enabled);
        document.body.classList.toggle('oneui-dark', enabled);
        const page = document.getElementById('page-container');
        if(page) page.classList.toggle('dark-mode', enabled);
        localStorage.setItem(KEY, enabled ? '1' : '0');
        updateToggleIcons(enabled);
    }

    function updateToggleIcons(enabled){
        document.querySelectorAll('[data-action="dark_mode_toggle"]').forEach(btn=>{
            try{
                btn.innerHTML = enabled ? '<i class="far fa-sun"></i>' : '<i class="far fa-moon"></i>';
            }catch(e){}
        });
    }

    function init(){
        const stored = localStorage.getItem(KEY);
        const prefers = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        const enabled = stored === null ? prefers : stored === '1';
        apply(enabled);

        document.addEventListener('click', function(e){
            const btn = e.target.closest ? e.target.closest('[data-action]') : null;
            if(!btn) return;
            const action = btn.getAttribute('data-action');
            if(action === 'dark_mode_toggle'){
                apply(!document.documentElement.classList.contains('dark-mode'));
            }
        });
    }

    if(document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
    else init();
})();
