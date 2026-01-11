<?php 
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';

// $total_readers = countReaders();
// $total_authors = countAuthors();
// $total_articles = countArticles();
// $categories = getAllCategories(); 
?>

<style>
    .admin-card {
        background-color: #f2e8cf; 
        border: 1px solid rgba(44, 24, 16, 0.1);
        border-radius: 2.5rem;
        padding: 2.5rem;
    }

    .stat-box {
        background: rgba(44, 24, 16, 0.03);
        border-radius: 1.5rem;
        padding: 1.5rem;
        border-bottom: 3px solid #d4af37;
        transition: transform 0.3s ease;
    }

    .category-item {
        background: rgba(44, 24, 16, 0.03);
        border-radius: 1rem;
        padding: 0.75rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid transparent;
        transition: all 0.3s ease;
    }

    .category-item:hover {
        border-color: #d4af37;
        background: white;
    }

    .icon-code { font-family: serif; font-weight: bold; }
</style>

<main class="relative z-20 max-w-7xl mx-auto px-6 md:px-10 mt-16 mb-24">
    
    <div class="border-b border-[#2c1810]/10 pb-10 mb-16">
        <h1 class="font-book text-6xl font-bold italic tracking-tighter text-ink leading-tight">Grand <span class="text-gold">Archive</span> Control</h1>
        <p class="font-book text-ink/50 italic text-lg uppercase tracking-widest text-[10px]">Managing the pulse of Victory Age</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="stat-box text-center">
            <span class="font-ui text-[10px] uppercase font-black text-ink/30 tracking-[0.2em] block mb-2">Total Readers</span>
            <span class="font-book text-4xl font-bold italic text-ink"><?= number_format($total_readers ?? 1250) ?></span>
        </div>
        <div class="stat-box text-center">
            <span class="font-ui text-[10px] uppercase font-black text-ink/30 tracking-[0.2em] block mb-2">Verified Authors</span>
            <span class="font-book text-4xl font-bold italic text-gold"><?= number_format($total_authors ?? 48) ?></span>
        </div>
        <div class="stat-box text-center">
            <span class="font-ui text-[10px] uppercase font-black text-ink/30 tracking-[0.2em] block mb-2">Total Articles</span>
            <span class="font-book text-4xl font-bold italic text-ink"><?= number_format($total_articles ?? 342) ?></span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <div class="lg:col-span-2 space-y-8">
            <div class="admin-card shadow-sm">
                <h3 class="font-book text-3xl font-bold italic text-ink mb-8">Chronicle Categories</h3>
                
                <div class="mb-10 pb-10 border-b border-[#2c1810]/5">
                    <label class="font-ui text-[9px] uppercase font-black text-ink/30 tracking-widest block mb-4">Forge New Category</label>
                    <form action="/addcategory" method="POST" class="flex gap-4">
                        <input type="text" name="name" placeholder="Enter category name..." 
                               class="flex-grow bg-white border border-[#2c1810]/10 rounded-full px-6 py-3 text-sm font-book italic focus:outline-none focus:border-gold shadow-inner">
                        <button type="submit" class="bg-[#2c1810] text-paper px-8 py-3 rounded-full font-ui text-[10px] font-black uppercase tracking-widest hover:bg-gold hover:text-[#2c1810] transition-all shadow-lg">
                            Add Category
                        </button>
                    </form>
                </div>

                <div class="space-y-3">
                    <label class="font-ui text-[9px] uppercase font-black text-ink/30 tracking-widest block mb-4">Existing Categories</label>
                    
                    <?php if (!empty($categories)): ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php foreach($categories as $cat): ?>
                            <div class="category-item group">
                                <span class="font-book text-lg font-bold italic text-ink">
                                    <?= htmlspecialchars($cat['name'] ?? $cat) ?>
                                </span>
                                
                                <form action="/deletecategory" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($cat['id'] ?? $cat) ?>">
                                    <button type="submit" 
                                            class="font-ui text-[9px] font-black uppercase text-red-800/40 hover:text-red-600 tracking-tighter transition-colors"
                                            onclick="return confirm('Do you wish to delete this category?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="py-10 text-center border-2 border-dashed border-[#2c1810]/5 rounded-3xl">
                            <p class="font-book text-sm text-ink/30 italic">No categories have been forged yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-8">
            <div class="admin-card border-dashed border-2 border-gold/30 bg-gold/5 p-8">
                <h4 class="font-book text-xl font-bold italic text-ink mb-6">Master Controls</h4>
                <div class="space-y-4">
                    <a href="/admin/users" class="flex items-center justify-between p-4 bg-white/40 rounded-2xl hover:bg-white transition-all group border border-transparent hover:border-gold/20">
                        <span class="font-ui text-[10px] uppercase font-black text-ink/60 group-hover:text-ink">User Directory</span>
                        <span class="icon-code text-gold">&#10142;</span>
                    </a>
                    <a href="/admin/reports" class="flex items-center justify-between p-4 bg-white/40 rounded-2xl hover:bg-white transition-all group border border-transparent hover:border-gold/20">
                        <span class="font-ui text-[10px] uppercase font-black text-ink/60 group-hover:text-ink">Review Reports</span>
                        <span class="icon-code text-gold">&#9873;</span>
                    </a>
                </div>
            </div>

            <a href="/profile" class="block text-center font-ui text-[10px] uppercase font-black tracking-widest text-ink/30 hover:text-gold transition-colors">
                &larr; Back to Personal Profile
            </a>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>