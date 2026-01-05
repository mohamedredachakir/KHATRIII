<?php 
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';

?>

<main class="relative z-20 max-w-7xl mx-auto px-6 md:px-10 mt-16 mb-24">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-[#2c1810]/10 pb-10 mb-16 gap-6">
        <div class="space-y-2">
            <h1 class="font-book text-5xl md:text-6xl font-bold italic tracking-tighter text-ink">Your Chronicles</h1>
            <p class="font-book text-ink/50 italic text-lg tracking-wide">"The collection of victories you have written into history."</p>
        </div>

        <a href="/createarticle" class="group relative inline-flex items-center px-8 py-4 overflow-hidden rounded-full bg-gold text-[#2c1810] shadow-xl transition-all hover:scale-105 active:scale-95">
            <span class="relative z-10 font-ui text-xs font-black uppercase tracking-[0.2em] flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                </svg>
                Write New Chapter
            </span>
            <div class="absolute inset-0 bg-[#2c1810] translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
            <span class="absolute inset-0 w-full h-full group-hover:text-paper transition-colors duration-500"></span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        
        <?php if (!empty($articles)): ?>
            <?php foreach($articles as $article): ?>
            <article class="group relative bg-paper/40 backdrop-blur-sm border border-[#2c1810]/5 rounded-[2rem] p-8 hover:shadow-2xl transition-all duration-500 flex flex-col h-[400px]">
                
                <div class="flex justify-between items-start mb-6">
                    <div class="flex items-center space-x-2">
                        <span class="h-px w-6 bg-gold"></span>
                        <span class="font-ui text-[9px] uppercase font-black tracking-widest text-gold italic">
                            Entry #<?= htmlspecialchars($article['id']) ?>
                        </span>
                    </div>
                    <span class="font-ui text-[9px] font-black uppercase tracking-tighter text-ink/30">
                        <?= date('M d, Y', strtotime($article['created_at'])) ?>
                    </span>
                </div>
                
                <div class="space-y-4 flex-grow">
                    <h3 class="font-book text-2xl md:text-3xl font-bold italic leading-tight group-hover:text-gold transition-colors line-clamp-2">
                        <?= htmlspecialchars($article['title']) ?>
                    </h3>
                    
                    <p class="font-book text-sm text-ink/60 italic leading-relaxed line-clamp-4">
                        <?= htmlspecialchars(strip_tags($article['content'])) ?>
                    </p>
                </div>

                <div class="pt-6 mt-auto flex justify-between items-center border-t border-[#2c1810]/5">
                    <div class="flex space-x-4">
                        <a href="/editarticle?id=<?= $article['id'] ?>" class="text-[10px] font-ui font-black uppercase tracking-widest text-ink/40 hover:text-gold transition-colors">
                            Refine
                        </a>
                        <form action="/deletearticle" method="POST" onsubmit="return confirm('Are you sure you want to burn this record?')" style="display:inline;">
    <input type="hidden" name="id" value="<?= $article['id'] ?>">
    <button type="submit"
        class="text-[10px] font-ui font-black uppercase tracking-widest text-ink/40 hover:text-red-800 transition-colors">
        Burn
    </button>
</form>

                    </div>
                    
                    <a href="/viewarticle?id=<?= $article['id'] ?>" class="w-10 h-10 rounded-full border border-gold/30 flex items-center justify-center group-hover:bg-gold group-hover:border-gold group-hover:text-paper transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        <?php endif; ?>

        <a href="/createarticle" class="border-2 border-dashed border-gold/20 rounded-[2rem] flex flex-col items-center justify-center p-12 text-center space-y-4 opacity-40 hover:opacity-100 hover:border-gold hover:bg-gold/5 transition-all group h-[400px]">
            <div class="text-4xl text-gold group-hover:scale-125 transition-transform duration-500">*</div>
            <h4 class="font-book text-xl font-bold italic text-ink">Next Victory...</h4>
            <p class="font-book text-xs italic text-ink/50">The archives await your next masterpiece.</p>
        </a>

    </div>
</main>

<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>