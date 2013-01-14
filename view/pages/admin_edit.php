<section class="pages edit">
    <header><!-- header -->
        <h1>Page edit</h1>
    </header><!-- end of header -->
    <div class="content"><!-- content -->

        <div id="help" class="twelve"></div><!-- display help text -->
        
        <form action="<?php echo Router::url('admin/pages/edit/' . $id); ?>" method="post" >
            <?php echo $this->Form->input('name', 'Title'); ?>
            <?php echo $this->Form->input('slug', 'Slug'); ?>
            <?php echo $this->Form->select('id_cat', 'Category', $categories['list']); ?>
            <?php echo $this->Form->input('created', 'Date', array('type' => 'datetime', 'class' => 'datepicker')); ?>
            <?php echo $this->Form->input('id', 'hidden'); ?>

            <p>
                <label for="explorer">Library</label>
                <a href="#" id="explorerLink" data-modal-url="<?php echo Router::url('admin/medias/posts/'.$id); ?>" class="button secondary explorer">Upload/Use a file</a>
            </p>
            
            <?php echo $this->Form->input('content', 'Content', array('class' => 'xxlarge wysiwyg', 'type' => 'texarea', 'rows' => 10)); ?>
            <?php echo $this->Form->input('online', 'Online', array('type' => 'checkbox')); ?>
            <div class="actions">
                <input type="submit" class="button" value="Validate" >
            </div>
        </form>

    </div><!-- end of content -->
</section>




<!-- File explorer in modal -->
<div id="explorerModal" class="reveal-modal expand">
  <div class="content">
      
  </div>
  <a class="close-reveal-modal">&#215;</a>
</div>



<?php
    /* Call the editor script */
    echo $the_editor;
?>

