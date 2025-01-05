        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/devblog brief/public/index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-blog"></i>
                </div>
                <div class="sidebar-brand-text mx-3">DevBlog Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
                <a class="nav-link" href="/devblog brief/public/index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Content Management
            </div>

            <!-- Nav Item - Articles Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArticles"
                    aria-expanded="true" aria-controls="collapseArticles">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Articles</span>
                </a>
                <div id="collapseArticles" class="collapse" aria-labelledby="headingArticles" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Article Management:</h6>
                        <a class="collapse-item" href="/devblog brief/public/articles/list-articles.php">View Articles</a>
                        <a class="collapse-item" href="/devblog brief/public/articles/add-article.php">Add New Article</a>
                        <a class="collapse-item" href="/devblog brief/public/articles/article-drafts.php">Pending Articles</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Categories -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategories"
                    aria-expanded="true" aria-controls="collapseCategories">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Categories</span>
                </a>
                <div id="collapseCategories" class="collapse" aria-labelledby="headingCategories" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Category Management:</h6>
                        <a class="collapse-item" href="/devblog brief/public/categories/list-categories.php">View All Categories</a>
                        <a class="collapse-item" href="/devblog brief/public/categories/add-category.php">Add New Category</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tags -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTags"
                    aria-expanded="true" aria-controls="collapseTags">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Tags</span>
                </a>
                <div id="collapseTags" class="collapse" aria-labelledby="headingTags" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tag Management:</h6>
                        <a class="collapse-item" href="/devblog brief/public/tags/list-tags.php">View All Tags</a>
                        <a class="collapse-item" href="/devblog brief/public/tags/add-tag.php">Add New Tag</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                User Management
            </div>

            <!-- Nav Item - Authors -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuthors"
                    aria-expanded="true" aria-controls="collapseAuthors">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span>
                </a>
                <div id="collapseAuthors" class="collapse" aria-labelledby="headingAuthors" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Users Management:</h6>
                        <a class="collapse-item" href="/devblog brief/public/users/authors.php">View All Authors</a>
                        <a class="collapse-item" href="/devblog brief/public/users/visitors.php">View All Visitors</a>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Settings
            </div>


            <!-- Nav Item - Your Profile -->
            <li class="nav-item">
                <a class="nav-link" href="profile.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Your Profile</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->