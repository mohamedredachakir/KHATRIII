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

    .stat-box:hover { transform: translateY(-5px); }

    .category-tag {
        background: #2c1810;
        color: #f2e8cf;
        padding: 0.5rem 1rem;
        border-radius: 99px;
        font-family: 'ui-sans-serif';
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        display: flex;
        align-items: center;
        gap: 0.5rem;
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
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-book text-3xl font-bold italic text-ink">Chronicle Categories</h3>
                    
                    <form action="/addcategory" method="POST" class="flex gap-2">
                        <input type="text" name="name" placeholder="New Category..." 
                               class="bg-white/50 border border-[#2c1810]/10 rounded-full px-4 py-2 text-xs font-book italic focus:outline-none focus:border-gold">
                        <button type="submit" class="bg-gold text-[#2c1810] px-4 py-2 rounded-full font-ui text-[10px] font-black uppercase tracking-widest hover:bg-ink hover:text-white transition-all">
                            Add
                        </button>
                    </form>
                </div>

                <div class="flex flex-wrap gap-4">
                    <?php if (!empty($categories)): ?>
                        <?php foreach($categories as $cat): ?>
                        <div class="category-tag group">
                            <?= htmlspecialchars($cat['name']) ?>
                            <form action="/deletecategory" method="POST" class="inline">
                                <input type="hidden" name="id" value="<?= $cat['id'] ?>">
                                <button type="submit" class="hover:text-red-500 transition-colors text-sm font-bold ml-2" onclick="return confirm('Delete category?')">
                                    &times;
                                </button>
                            </form>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="font-book text-sm text-ink/30 italic">No categories forged yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-8">
            <div class="admin-card border-dashed border-2 border-gold/30 bg-gold/5">
                <h4 class="font-book text-xl font-bold italic text-ink mb-6">Master Controls</h4>
                <div class="space-y-4">
                    <a href="/admin/users" class="flex items-center justify-between p-4 bg-white/40 rounded-2xl hover:bg-white transition-all group">
                        <span class="font-ui text-[10px] uppercase font-black text-ink/60 group-hover:text-ink">User Directory</span>
                        <span class="icon-code text-gold">&#10142;</span>
                    </a>
                    <a href="/admin/reports" class="flex items-center justify-between p-4 bg-white/40 rounded-2xl hover:bg-white transition-all group">
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