<?php 
require_once __DIR__ . '/../Layouts/header.php';
require_once __DIR__ . '/../Layouts/navbar.php';
// $user = $_SESSION['user'];
// $author_articles = fetchAuthorArticles($user['id']); 
?>

<style>
    .victory-bg-paper { background-color: #f2e8cf; }
    .ink-border { border: 1px solid rgba(44, 24, 16, 0.1); }
    
    .author-card {
        background-color: #f2e8cf;
        border-radius: 2.5rem;
        padding: 3rem;
    }

    .stat-pill {
        background: rgba(44, 24, 16, 0.05);
        border-radius: 1rem;
        padding: 1rem;
        border-left: 3px solid #d4af37;
    }

    .icon-code { font-family: serif; font-weight: bold; }
</style>

<main class="relative z-20 max-w-7xl mx-auto px-6 md:px-10 mt-16 mb-24">
    
    <div class="border-b border-[#2c1810]/10 pb-10 mb-16 flex justify-between items-end">
        <div>
            <h1 class="font-book text-6xl font-bold italic tracking-tighter text-ink leading-tight">Master <span class="text-gold">Scribe</span></h1>
            <p class="font-book text-ink/50 italic text-lg uppercase tracking-widest text-[10px]">Your literary legacy and insights</p>
        </div>
        <a href="/createarticle" class="px-6 py-3 bg-gold text-[#2c1810] rounded-full font-ui text-[10px] font-black uppercase tracking-widest hover:bg-[#2c1810] hover:text-paper transition-all">
            + New Manuscript
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
        
        <div class="lg:col-span-1 space-y-8">
            <div class="author-card shadow-sm flex flex-col items-center text-center ink-border">
                <div class="w-24 h-24 rounded-full bg-[#2c1810] flex items-center justify-center text-gold text-4xl font-black border-4 border-gold/20 mb-6 shadow-xl">
                    <?= strtoupper(substr($user['username'] ?? 'A', 0, 1)) ?>
                </div>
                <h2 class="font-book text-2xl font-bold italic text-ink"><?= htmlspecialchars($user['first_name']) ?></h2>
                <p class="font-ui text-[9px] uppercase font-black text-gold tracking-widest mb-6">Verified Author</p>
                
                <div class="w-full space-y-3">
                    <a href="/editprofile" class="block w-full py-3 bg-[#2c1810] text-paper rounded-full font-ui text-[9px] uppercase font-black tracking-widest hover:bg-gold transition-all shadow-md">
                        Edit Profile
                    </a>
                </div>
            </div>

            <div class="space-y-4">
                <h4 class="font-ui text-[10px] uppercase font-black text-ink/40 tracking-widest ml-4">Quick Insights</h4>
                <div class="stat-pill">
                    <span class="block font-ui text-[9px] uppercase font-black text-ink/40">Total Victories</span>
                    <span class="font-book text-2xl font-bold italic text-ink"><?= count($author_articles) ?></span>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3 space-y-16">
            
            <section>
                <div class="flex items-center space-x-4 mb-8">
                    <span class="h-px w-10 bg-gold"></span>
                    <h3 class="font-book text-3xl font-bold italic text-ink">Manage Manuscripts</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php foreach($author_articles as $article): ?>
                    <article class="victory-bg-paper ink-border rounded-[2rem] p-8 flex flex-col h-[350px] group relative">
                        <div class="flex justify-between mb-4">
                            <span class="font-ui text-[9px] uppercase font-black text-gold italic">#<?= $article['id'] ?></span>
                            <div class="flex space-x-3">
                                <a href="/editarticle?id=<?= $article['id'] ?>" class="text-[10px] font-black text-ink/40 hover:text-gold uppercase tracking-tighter">Edit</a>
                                <form action="/deletearticle" method="POST" onsubmit="return confirm('Burn this manuscript forever?')">
                                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                    <button class="text-[10px] font-black text-ink/40 hover:text-red-800 uppercase tracking-tighter">Burn</button>
                                </form>
                            </div>
                        </div>
                        <h4 class="font-book text-2xl font-bold italic text-ink mb-4 line-clamp-2"><?= htmlspecialchars($article['title']) ?></h4>
                        <p class="font-book text-sm text-ink/60 italic line-clamp-3 mb-6"><?= htmlspecialchars(strip_tags($article['content'])) ?></p>
                        
                        <div class="mt-auto pt-6 border-t border-[#2c1810]/5 flex items-center space-x-6">
                            <div class="flex items-center space-x-2 text-ink/30">
                                <span class="icon-code text-lg">&hearts;</span>
                                <span class="font-ui text-[10px] font-black"><?= $article['likes_count'] ?></span>
                            </div>
                            <div class="flex items-center space-x-2 text-ink/30">
                                <span class="icon-code text-md">&#10002;</span>
                                <span class="font-ui text-[10px] font-black"><?= $article['comments_count'] ?></span>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section>
                <div class="flex items-center space-x-4 mb-8">
                    <span class="h-px w-10 bg-gold"></span>
                    <h3 class="font-book text-3xl font-bold italic text-ink">Engagement Insights</h3>
                </div>

                <div class="victory-bg-paper ink-border rounded-[2.5rem] overflow-hidden">
                    <table class="w-full text-left font-book">
                        <thead class="bg-[#2c1810]/5 border-b border-[#2c1810]/10">
                            <tr>
                                <th class="px-8 py-5 font-ui text-[10px] uppercase font-black text-ink/50">Manuscript Title</th>
                                <th class="px-8 py-5 font-ui text-[10px] uppercase font-black text-ink/50 text-center">Interactions</th>
                                <th class="px-8 py-5 font-ui text-[10px] uppercase font-black text-ink/50 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#2c1810]/5">
                            <?php foreach($author_articles as $article): ?>
                            <tr class="hover:bg-gold/5 transition-colors">
                                <td class="px-8 py-6 font-bold italic text-ink"><?= htmlspecialchars($article['title']) ?></td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-center space-x-6">
                                        <span class="text-xs font-bold text-ink/60 italic"><?= $article['likes_count'] ?> Likes</span>
                                        <span class="text-xs font-bold text-ink/60 italic"><?= $article['comments_count'] ?> Comments</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="/view-comments?article_id=<?= $article['id'] ?>" class="font-ui text-[9px] font-black uppercase tracking-widest text-gold hover:text-ink transition-colors">
                                        See All Comments &rarr;
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>