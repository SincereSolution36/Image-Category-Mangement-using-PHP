<header>
    <a href="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../index.php" class="logo">
        <span class="logo-mini"><b>C</b>IM</span>
        <span class="logo-lg"><b>Image</b>Manager</span>
    </a>

    <nav class="navbar navbar-static-top p-0">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <script>
            document.querySelector('.sidebar-toggle').addEventListener('click', function() {
                $('body').toggleClass('sidebar-collapse');
            })
        </script>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu d-flex align-items-center">
                    <a href="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../admin/read.php?editid=<?php echo htmlentities($_SESSION['userID']) ?>" class="dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                        <img src="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../assets/img/profilepics/<?php echo $_SESSION['profilepic']; ?>" class="user-image" alt="User Image" />
                        <span class="hidden-xs"><?php echo $_SESSION['role'] == 'guest' ? '<a href="' . substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) . '/../login.php" >Log In</a>' : $_SESSION['username'] ?></span>
                    </a>

                    <?php if($_SESSION['role'] != 'guest') { ?>
                        <div class="dropdown-menu">
                            <?php if($_SESSION['role'] != 'super-admin') { ?>
                                <a href="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../admin/read.php?viewid=<?php echo $_SESSION['userID'] ?>" class="btn btn-default btn-flat">Profile</a>
                            <?php } ?>
                            <a href="<?php echo substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))) ?>/../logout.php" class="btn btn-default btn-flat">Sign out</a>    
                        </div>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </nav>
</header>