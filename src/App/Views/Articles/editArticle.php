<?php 
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';

// $article = fetchArticleById($_GET['id']); 
// $categories = getAllCategories(); 
// $current_categories = getArticleCategories($article['id']); 
?>

<style>
    
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 0.75rem;
        background: rgba(44, 24, 16, 0.02);
        border: 1px solid rgba(44, 24, 16, 0.05);
        border-radius: 1.5rem;
        padding: 1.5rem;
    }

    
    .category-checkbox {
        display: none;
    }

    
    .category-label {
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.6rem 1rem;
        border-radius: 99px;
        border: 1px solid rgba(44, 24, 16, 0.1);
        font-family: 'serif';
        font-style: italic;
        font-size: 0.8rem;
        color: rgba(44, 24, 16, 0.5);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-align: center;
        background: white;
    }

    
    .category-checkbox:checked + .category-label {
        background-color: #d4af37;
        border-color: #d4af37;
        color: #2c1810;
        font-weight: bold;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.2);
        transform: scale(1.05);
    }

    
    .category-label:hover {
        border-color: #d4af37;
        color: #2c1810;
    }
</style>

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

    <form action="/editarticle" method="POST" class="space-y-8">
        <input type="hidden" name="id" value="<?= $article['id'] ?? '123' ?>">

        <div class="bg-paper/40 backdrop-blur-md border border-[#2c1810]/5 rounded-[2rem] p-8 md:p-16 shadow-2xl space-y-12">
            
            <div class="space-y-4">
                <div class="flex justify-between items-end ml-1">
                    <label class="font-ui text-[10px] uppercase tracking-[0.3em] font-black text-gold">Archive Sections</label>
                    <span class="font-book text-[9px] italic text-ink/30 uppercase tracking-widest">Select all applicable sections</span>
                </div>
                
                <div class="categories-grid">
                    <?php if(!empty($categories)): ?>
                        <?php foreach($categories as $cat): ?>
                            <div class="relative">
                                <?php 
                                    $is_checked = (isset($current_categories) && in_array($cat['id'], $current_categories)) ? 'checked' : '';
                                ?>
                                <input type="checkbox" 
                                       name="category_ids[]" 
                                       id="cat_<?= $cat['id'] ?>" 
                                       value="<?= $cat['id'] ?>" 
                                       <?= $is_checked ?>
                                       class="category-checkbox">
                                <label for="cat_<?= $cat['id'] ?>" class="category-label">
                                    <?= htmlspecialchars($cat['name']) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-span-full py-4 text-center">
                            <p class="font-book text-xs text-ink/30 italic">No archive sections forged yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="space-y-4">
                <label class="font-ui text-[10px] uppercase tracking-[0.3em] font-black text-gold ml-1">Chapter Title</label>
                <input type="text" name="title" required
                       value="<?= htmlspecialchars($article['title'] ?? 'The Original Title of the Victory') ?>" 
                       placeholder="The Echoes of the Unconquered..." 
                       class="w-full bg-transparent border-b border-[#2c1810]/10 py-6 font-book text-3xl md:text-5xl italic focus:outline-none focus:border-gold transition-all text-ink">
            </div>

            <div class="space-y-4">
                <label class="font-ui text-[10px] uppercase tracking-[0.3em] font-black text-gold ml-1">The Narrative</label>
                <textarea name="content" required rows="15" 
                          placeholder="Continue your narrative..." 
                          class="w-full bg-transparent border-b border-[#2c1810]/10 py-4 font-book text-xl md:text-2xl italic leading-relaxed focus:outline-none focus:border-gold transition-all resize-none text-ink/80"><?= htmlspecialchars($article['content'] ?? 'This is where the existing content would go...') ?></textarea>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-between gap-8 pt-10">
                <div class="flex items-center">
                    <a href="/profile" class="font-ui text-[10px] uppercase tracking-[0.3em] font-black text-ink/40 hover:text-red-900 transition-colors">
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