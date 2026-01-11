<?php 
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';
?>

<style>
    .icon-code {
        font-family: serif;
        font-weight: bold;
    }

    .article-category-tag {
        display: inline-block;
        padding: 2px 8px;
        background: rgba(212, 175, 55, 0.05);
        border: 1px solid rgba(212, 175, 55, 0.2);
        color: #d4af37;
        font-family: 'ui-sans-serif';
        font-size: 8px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 4px;
        margin-right: 4px;
        margin-bottom: 4px;
    }

   
    .action-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.8rem;
        border-radius: 99px;
        background: rgba(44, 24, 16, 0.03);
        border: 1px solid rgba(44, 24, 16, 0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .btn-like:hover {
        background: rgba(185, 28, 28, 0.1);
        border-color: rgba(185, 28, 28, 0.2);
        color: #b91c1c;
        transform: translateY(-2px);
    }

    .btn-comment:hover {
        background: rgba(212, 175, 55, 0.1);
        border-color: rgba(212, 175, 55, 0.2);
        color: #d4af37;
        transform: translateY(-2px);
    }

    .btn-report:hover {
        background: #2c1810;
        color: #f2e8cf;
        transform: translateY(-2px);
    }

   
    .action-form {
        display: inline-block;
        margin: 0;
    }
</style>

<main class="relative z-20 max-w-7xl mx-auto px-6 md:px-10 mt-16 mb-24">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-[#2c1810]/10 pb-10 mb-16 gap-6">
        <div class="space-y-2">
            <h1 class="font-book text-5xl md:text-6xl font-bold italic tracking-tighter text-ink">The Chronicles</h1>
            <p class="font-book text-ink/50 italic text-lg tracking-wide">"The collection of victories written into history."</p>
        </div>

        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'author'): ?>
        <a href="/createarticle" class="group relative inline-flex items-center px-8 py-4 overflow-hidden rounded-full bg-gold text-[#2c1810] shadow-xl transition-all hover:scale-105 active:scale-95">
            <span class="relative z-10 font-ui text-xs font-black uppercase tracking-[0.2em] flex items-center">
                <span class="mr-2 text-lg font-bold">+</span> Write New Chapter
            </span>
            <div class="absolute inset-0 bg-[#2c1810] translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
        </a>
        <?php endif; ?>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        
        <?php if (!empty($articles)): ?>
            <?php foreach($articles as $article): ?>
            <article class="group relative bg-paper/40 backdrop-blur-sm border border-[#2c1810]/5 rounded-[2.5rem] p-8 hover:shadow-2xl transition-all duration-500 flex flex-col h-[500px]">
                
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center space-x-2">
                        <span class="h-px w-6 bg-gold"></span>
                        <span class="font-ui text-[9px] uppercase font-black tracking-widest text-gold italic">Entry #<?= htmlspecialchars($article['id']) ?></span>
                    </div>
                    <span class="font-ui text-[9px] font-black uppercase tracking-tighter text-ink/30"><?= date('M d, Y', strtotime($article['create_at'])) ?></span>
                </div>

                <div class="mb-4 flex flex-wrap">
                    <?php 
                    $cats = is_array($article['categories']) ? $article['categories'] : explode(',', $article['categories'] ?? 'General');
                    foreach($cats as $cat_name): 
                    ?>
                        <span class="article-category-tag"><?= htmlspecialchars(trim($cat_name)) ?></span>
                    <?php endforeach; ?>
                </div>
                
                <div class="space-y-4 flex-grow">
                    <h3 class="font-book text-2xl md:text-3xl font-bold italic leading-tight group-hover:text-gold transition-colors line-clamp-2">
                        <?= htmlspecialchars($article['title']) ?>
                    </h3>
                    <p class="font-book text-sm text-ink/60 italic leading-relaxed line-clamp-4">
                        <?= htmlspecialchars(strip_tags($article['content'])) ?>
                    </p>
                </div>

                <div class="mb-6">
                    <span class="font-ui text-[8px] uppercase font-black text-ink/20 block leading-none mb-1">Written by</span>
                    <span class="font-book text-sm font-bold italic text-ink"><?= htmlspecialchars($article['author_name'] ?? 'Unknown Scribe') ?></span>
                </div>

                <div class="pt-6 border-t border-[#2c1810]/5 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        
                        <form action="/likearticle" method="POST" class="action-form">
                            <input type="hidden" name="id" value="<?= $article['id'] ?>">
                            <button type="submit" class="action-btn btn-like text-ink/40">
                                <span class="icon-code text-lg">&hearts;</span>
                                <span class="font-ui text-[10px] font-black"><?= number_format($article['likes_count'] ?? 0) ?></span>
                            </button>
                        </form>
                        
                        <form action="/comment" method="GET" class="action-form">
                            <input type="hidden" name="id" value="<?= $article['id'] ?>">
                            <button type="submit" class="action-btn btn-comment text-ink/40">
                                <span class="icon-code text-base">&#10002;</span>
                                <span class="font-ui text-[10px] font-black"><?= number_format($article['comments_count'] ?? 0) ?></span>
                            </button>
                        </form>
                    </div>

                    <form action="/reportarticle" method="POST" class="action-form" onsubmit="return confirm('Do you wish to report this chronicle to the high council?')">
                        <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                        <button type="submit" class="action-btn btn-report text-ink/20" title="Report this chronicle">
                            <span class="icon-code text-sm">&#9873;</span>
                        </button>
                    </form>
                </div>
            </article>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'author'): ?>
        <a href="/createarticle" class="border-2 border-dashed border-gold/20 rounded-[2.5rem] flex flex-col items-center justify-center p-12 text-center space-y-4 opacity-40 hover:opacity-100 hover:border-gold hover:bg-gold/5 transition-all group h-[500px]">
            <div class="text-4xl text-gold group-hover:rotate-90 transition-transform duration-500">*</div>
            <h4 class="font-book text-xl font-bold italic text-ink">Next Victory...</h4>
            <p class="font-book text-xs italic text-ink/50 uppercase tracking-widest">The ink never dries</p>
        </a>
        <?php endif; ?>

    </div>
</main>

<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>