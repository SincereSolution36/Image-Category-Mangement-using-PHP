<aside class="main-sidebar scrollable">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../assets/img/profilepics/<?php echo $_SESSION['profilepic']; ?>" class="user-image img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['role'] == 'guest' ? '<a href="login.php" >Stranger</a>' : $_SESSION['username'] ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li class="treeview active">
                <a href="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../index.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <?php if($_SESSION['role'] != 'guest') { ?>
                <li class="header">MEDIA GALLERY</li>

                <li class="treeview active">
                    <a href="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../media/index.php">
                        <i class="fa fa-image"></i> <span>Media</span>
                    </a>
                </li>

                <?php if($_SESSION['role'] != 'editor') { ?>
                    <li class="header">ADMIN PANEL</li>

                    <li class="treeview active">
                        <a href="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../admin/role.php">
                            <i class="fa fa-user-o"></i> <span>Users</span>
                        </a>
                    </li>
    
                    <li class="treeview active">
                        <a href="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../category/category-form.php">
                            <i class="fa fa-folder-open-o"></i> <span>Category</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../category/category-form.php?add=add-category"><i class="fa fa-plus"></i> Add Category</a></li>
                        </ul>
                    </li>
    
                    <li class="treeview active">
                        <a href="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../category/category-form.php">
                            <i class="fa fa-flag-o"></i> <span>SKU</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../category/category-form.php?add=add-sku"><i class="fa fa-plus"></i> Add SKU</a></li>
                        </ul>
                    </li>
    
                    <li class="treeview active">
                        <a href="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../tag/index.php">
                            <i class="fa fa-chain"></i> <span>Tags</span>
                        </a>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </section>
</aside>