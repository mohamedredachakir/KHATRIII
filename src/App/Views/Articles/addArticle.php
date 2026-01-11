<?php 
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';
// $categories = getAllCategories(); 
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
        <span class="font-ui text-[10px] uppercase tracking-[0.6em] text-gold font-black">Manuscript Phase</span>
        <h1 class="font-book text-5xl md:text-6xl font-bold italic tracking-tighter text-ink">Draft a New Victory</h1>
        <div class="flex items-center justify-center space-x-4 opacity-20 mt-6">
            <div class="h-px w-16 bg-ink"></div>
            <span class="text-xl">*</span>
            <div class="h-px w-16 bg-ink"></div>
        </div>
    </div>

    <form action="/createarticle" method="POST" class="space-y-8">
        
        <div class="bg-paper/40 backdrop-blur-md border border-[#2c1810]/5 rounded-[2rem] p-8 md:p-16 shadow-2xl space-y-12">
            
            <div class="space-y-4">
                <div class="flex justify-between items-end ml-1">
                    <label class="font-ui text-[10px] uppercase tracking-[0.3em] font-black text-gold">Archive Sections</label>
                    <span class="font-book text-[9px] italic text-ink/30 uppercase tracking-widest">Select all that apply</span>
                </div>
                
                <div class="categories-grid">
                    <?php if(!empty($categories)): ?>
                        <?php foreach($categories as $cat): ?>
                            <div class="relative">
                                <input type="checkbox" 
                                       name="categories[]" 
                                       id="cat_<?= $cat['id'] ?>" 
                                       value="<?= $cat['id'] ?>" 
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
                       placeholder="The Echoes of the Unconquered..." 
                       class="w-full bg-transparent border-b border-[#2c1810]/10 py-6 font-book text-3xl md:text-5xl italic focus:outline-none focus:border-gold transition-all placeholder:text-ink/10 text-ink">
            </div>

            <div class="space-y-4">
                <label class="font-ui text-[10px] uppercase tracking-[0.3em] font-black text-gold ml-1">The Narrative</label>
                <textarea name="content" required rows="12" 
                          placeholder="Let your thoughts flow onto the parchment..." 
                          class="w-full bg-transparent border-b border-[#2c1810]/10 py-4 font-book text-xl md:text-2xl italic leading-relaxed focus:outline-none focus:border-gold transition-all placeholder:text-ink/10 resize-none text-ink/80"></textarea>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-between gap-8 pt-10">
                <div class="flex items-center space-x-8">
                    <button type="button" class="font-ui text-[10px] uppercase tracking-[0.3em] font-black text-ink/40 hover:text-gold transition-colors">
                        Save Draft
                    </button>
                    <a href="/profile" class="font-ui text-[10px] uppercase tracking-[0.3em] font-black text-ink/40 hover:text-red-900 transition-colors">
                        Discard
                    </a>
                </div>

                <button type="submit" class="w-full md:w-auto px-16 py-5 bg-[#2c1810] text-paper rounded-full font-ui text-[11px] uppercase font-black tracking-[0.4em] shadow-2xl hover:bg-gold hover:text-[#2c1810] transition-all transform hover:-translate-y-1 active:scale-95">
                    Seal & Publish
                </button>
            </div>
        </div>
    </form>

    <div class="mt-12 text-center">
        <p class="font-book text-[11px] italic text-ink/30 uppercase tracking-[0.2em]">
            Words written here are etched into the eternal archives of Victory Age.
        </p>
    </div>
</main>

<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>