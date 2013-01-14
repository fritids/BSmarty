<section class="menu">
    <header><!-- header -->
        <h1>Menu management</h1>
    </header><!-- end of header --> 
    <div class="content"><!-- content -->
        <h2 class="subheader">Complete menu <small>An overview of the front menu</small></h2>
        <p>Here, you can create, edit and delete all menu and menu items.</p>

        <h3 class="subheader">Add new menu</h3>
        <form action="<?php echo Router::url('admin/menu/edit/group'); ?>" method="post">
            <div class="row">
                <div class="four columns">
                  <label for="addgroup-name" class="right inline">Menu name</label>
                </div>
                <div class="four columns">
                  <input type="text" name="name" id="addgroup-name" class="inline">
                </div>
                <div class="four columns">
                  <input type="submit" value="Create" class="button">
                </div>
            </div>
        </form>

        <hr>

        <?php
            /* Build groups and items visualisation */
            echo '<dl class="tabs contained">';
            $i = 1;
            foreach($menus as $menu){
                echo '<dd';
                if($i == 1) echo ' class="active"';
                echo '><a href="#menu-'.$menu->id.'">'.$menu->name.'</a></dd>';

                $i++;
            }
            echo '</dl>';

            echo '<ul class="tabs-content contained">';
            $j = 1;
            foreach($menus as $menu){
                echo '<li';
                if($j == 1) echo ' class="active"';
                echo ' id="menu-'.$menu->id.'Tab">';
                echo '<div class="panel"><h5>Menu actions</h5><p>You can modify this menu <a href="'.Router::url('admin/menu/edit/item/'.$menu->id).'" title="Modify '.$menu->name.'">here</a>.</p></div>';
                echo $menu->html;

                    echo '<hr>';
                    echo '<form action="'.Router::url('admin/menu/edit/group').'" method="post">
                            <div class="row">
                                <div class="three columns">
                                    <label for="editgroup-name" class="right inline">New menu name</label>
                                </div>
                                <div class="three columns">
                                    <input type="text" name="name" id="editgroup-name" value="'.$menu->name.'">
                                </div>
                                <div class="three columns">
                                    <input type="submit" value="Edit" class="button">
                                </div>
                                <div class="three columns">
                                    <a href="'.Router::url('admin/menu/delete/group/'.$menu->id).'" class="button alert right">Delete</a>
                                </div>
                            </div>
                        </form>';
                
                echo '</li>';
                $j++;
            }
            echo '</ul>';

        ?>

    </div><!-- end of content -->
</section>
