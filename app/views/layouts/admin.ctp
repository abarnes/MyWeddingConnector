<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>MyWeddingConnector - Dallas/Ft. Worth - Control Panel</title>
    
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery-ui.js"></script>
    <script src="/js/jquery.corner.js"></script>
    <script src="/js/visualize.js"></script>
    <script src="/js/excanvas.js"></script>
    
    <?php echo $html->css('admin'); ?>
    <?php echo $html->css('visualize'); ?>
    <?php echo $html->css('visualize-light'); ?>
    <?php echo $html->css('redmond/jquery-ui-1.8.16.custom'); ?>

  </head>
  <body>
        <div class="out">
            <a href="/users/logout" style="float:right;font-size:.9em;margin-right:10px;text-decoration:none;">[sign out]</a><br/><br/>
            
            <?php
            if (!isset($down)) {
                $down = 'y';
            }
            
            if ($down=='dashboard') {
                $class = 'link down';
            } else {
                $class = 'link';
            }?>
            <a href="/records/dashboard" class="atop"><div class="<?php echo $class;?>">
                Dashboard
            </div></a>
            <?php if ($down=='brides') {
                $class = 'link down';
            } else {
                $class = 'link';
            }?>
            <a href="/clients" class="atop"><div class="<?php echo $class;?>">
                Brides
            </div></a>
            <?php if ($down=='vendors') {
                $class = 'link down';
            } else {
                $class = 'link';
            }?>
            <a href="/vendors/manage" class="atop"><div class="<?php echo $class;?>">
                Vendors
            </div></a>
            <?php if ($down=='industries') {
                $class = 'link down';
            } else {
                $class = 'link';
            }?>
            <a href="/categories" class="atop"><div class="<?php echo $class;?>">
                Industries
            </div></a>
            <?php if ($down=='admin') {
                $class = 'link-end down';
            } else {
                $class = 'link-end';
            }?>
            <a href="/users" class="atop"><div class="<?php echo $class; ?>">
                Admin
            </div></a>
            
            <?php if ($down=='pending') {
                $class = 'left-link down';
            } else {
                $class = 'left-link';
            }?>
            <a href="/clients/pending" class="atop"><div class="<?php echo $class; ?>">
                Pending Brides
            </div></a>
            
            <div class="main">
                <span style="color:red;"><?php echo $session->flash(); ?></span>
                <?php echo $content_for_layout; ?>
            </div>
        </div>
        <br/><br/>
  </body>
</html>