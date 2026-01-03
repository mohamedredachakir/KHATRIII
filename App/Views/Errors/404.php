<?php
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';
?>;

<main class="relative z-20 min-h-[70vh] flex items-center justify-center px-6">
    <div class="max-w-3xl w-full text-center space-y-12 py-20">
        
        <div class="relative">
            <h1 class="text-[12rem] md:text-[18rem] font-book font-black opacity-[0.03] absolute inset-0 flex items-center justify-center select-none">
                404
            </h1>
            <div class="relative z-10 flex flex-col items-center">
                <span class="text-6xl md:text-8xl mb-6">*</span>
                <h2 class="text-4xl md:text-6xl font-book font-bold italic tracking-tighter text-ink">
                    Lost in the <span class="text-gold">Archives.</span>
                </h2>
            </div>
        </div>

        <div class="space-y-6 max-w-xl mx-auto">
            <p class="font-book text-xl md:text-2xl text-ink/70 leading-relaxed italic">
                "Alas, the page you seek has been torn from the chronicles or was never written by the scribes. Even in the path to victory, one might find a silent hall."
            </p>
            
            <div class="flex items-center justify-center space-x-4 opacity-30">
                <div class="h-px w-12 bg-ink"></div>
                <span class="text-xl">❦</span>
                <div class="h-px w-12 bg-ink"></div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-center gap-6 pt-10">
            <a href="../index.php" class="bg-[#2c1810] text-paper px-10 py-4 rounded-full font-ui text-xs font-black uppercase tracking-[0.2em] hover:bg-gold hover:text-[#2c1810] transition-all shadow-2xl flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Return to Citadel
            </a>
            
            <a href="../articles.php" class="border border-ink/20 px-10 py-4 rounded-full font-ui text-xs font-black uppercase tracking-[0.2em] hover:border-gold hover:text-gold transition-all italic">
                Explore Chronicles
            </a>
        </div>

        <div class="pt-20">
            <p class="text-[9px] font-ui uppercase tracking-[0.8em] text-gold/40 font-bold">
                Error IV - Page Expelled from History
            </p>
        </div>
    </div>
</main>


<?php require_once __DIR__ . '/../Layouts/footer.php';?>