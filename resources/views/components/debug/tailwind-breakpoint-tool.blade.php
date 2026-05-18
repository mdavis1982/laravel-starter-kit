<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ID = 'tailwind-breakpoint-tool';

        let el = null;
        let widthEl = null;
        let hideTimer = null;
        let raf = null;

        function createTool() {
            if (el) return;

            el = document.createElement('div');
            el.id = ID;
            el.style.zIndex = '9999';

            el.className = `
            fixed top-0 left-1/2 -translate-x-1/2 -translate-y-full
            flex items-center gap-1 px-2 py-1 text-xs
            rounded-full border border-neutral-200/50
            bg-white/80 backdrop-blur-lg shadow-2xl
            transition-all duration-300 ease-out
            dark:border-neutral-700/70 dark:bg-neutral-900/80
        `;

            el.innerHTML = `
            <div class="px-2 py-0.5 font-bold text-white bg-blue-500 rounded-full min-w-[42px] text-center">
                <span class="inline-block sm:hidden">XS</span>
                <span class="hidden sm:inline-block md:hidden">SM</span>
                <span class="hidden md:inline-block lg:hidden">MD</span>
                <span class="hidden lg:inline-block xl:hidden">LG</span>
                <span class="hidden xl:inline-block 2xl:hidden">XL</span>
                <span class="hidden 2xl:inline-block">2XL</span>
            </div>

            <span class="px-2 py-1 text-black dark:text-white">
                <span data-current-width></span>px
            </span>

            <button
                type="button"
                aria-label="Close breakpoint tool"
                data-close
                class="flex items-center justify-center w-5 h-5 rounded-full
                       text-gray-500 bg-neutral-200/60 hover:bg-neutral-200
                       dark:text-neutral-300 dark:bg-neutral-700/80 dark:hover:bg-neutral-700"
            >
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;

            document.body.appendChild(el);

            widthEl = el.querySelector('[data-current-width]');

            el.querySelector('[data-close]')
                .addEventListener('click', hideTool);

            requestAnimationFrame(() => {
                el.classList.remove('-translate-y-full');
                el.classList.add('translate-y-3');
            });
        }

        function updateTool() {
            createTool();

            widthEl.textContent = window.innerWidth;

            clearTimeout(hideTimer);
            hideTimer = setTimeout(hideTool, 3000);
        }

        function hideTool() {
            if (!el) return;

            clearTimeout(hideTimer);

            el.classList.add('-translate-y-full');
            el.classList.remove('translate-y-3');

            const currentEl = el;

            setTimeout(() => {
                currentEl.remove();

                if (currentEl === el) {
                    el = null;
                    widthEl = null;
                }
            }, 300);
        }

        window.addEventListener('resize', () => {
            if (raf) {
                cancelAnimationFrame(raf);
            }

            raf = requestAnimationFrame(updateTool);
        });
    });
</script>
