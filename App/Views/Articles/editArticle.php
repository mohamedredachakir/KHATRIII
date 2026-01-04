<?php 
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';

// $article = fetchArticleById($_GET['id']); 
?>

<main class="relative z-20 max-w-4xl mx-auto px-6 py-16 md:py-24">
    <div class="text-center space-y-4 mb-16">
        <span class="font-ui text-[10px] uppercase tracking-[0.6em] text-gold font-black">Revision Phase</span>
        <h1 class="font-book text-5xl md:text-6xl font-bold italic tracking-tighter text-ink">Refine the Chronicle</h1>
        <p class="font-book text-ink/40 italic">"Polishing the ink of history for future generations."</p>
        <div class="flex items-center justify-center space-x-4 opacity-20 mt-6">
            <div class="h-px w-16 bg-ink"></div>
            <span class="text-xl">*</span>
            <div class="h-px w-16 bg-ink"></div>
        </div>
    </div>

    <form action="/articles/update" method="POST" class="space-y-8">
        <input type="hidden" name="id" value="123">

        <div class="bg-paper/40 backdrop-blur-md border border-[#2c1810]/5 rounded-[2rem] p-8 md:p-16 shadow-2xl space-y-12">
            
            <div class="space-y-4">
                <label class="font-ui text-[10px] uppercase tracking-[0.3em] font-black text-gold ml-1">Chapter Title</label>
                <input type="text" name="title" 
                       value="The Original Title of the Victory" 
                       placeholder="The Echoes of the Unconquered..." 
                       class="w-full bg-transparent border-b border-[#2c1810]/10 py-6 font-book text-3xl md:text-5xl italic focus:outline-none focus:border-gold transition-all text-ink">
            </div>

            <div class="space-y-4">
                <label class="font-ui text-[10px] uppercase tracking-[0.3em] font-black text-gold ml-1">The Narrative</label>
                <textarea name="content" rows="15" 
                          placeholder="Continue your narrative..." 
                          class="w-full bg-transparent border-b border-[#2c1810]/10 py-4 font-book text-xl md:text-2xl italic leading-relaxed focus:outline-none focus:border-gold transition-all resize-none text-ink/80">This is where the existing content of the article would go. The scribe can now refine every word and sharpen every thought.</textarea>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-between gap-8 pt-10">
                <div class="flex items-center">
                    <a href="/articles" class="font-ui text-[10px] uppercase tracking-[0.3em] font-black text-ink/40 hover:text-red-900 transition-colors">
                        Cancel Revision
                    </a>
                </div>

                <button type="submit" class="w-full md:w-auto px-16 py-5 bg-gold text-[#2c1810] rounded-full font-ui text-[11px] uppercase font-black tracking-[0.4em] shadow-2xl hover:bg-[#2c1810] hover:text-paper transition-all transform hover:-translate-y-1 active:scale-95">
                    Update the Record
                </button>
            </div>
        </div>
    </form>
</main>

<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>