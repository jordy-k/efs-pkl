<!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: rgba(10, 10, 10, .5);">
      <?php $role_id = $this->session->userdata('role_id'); ?>
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php if($role_id == 1) { echo base_url('admin/index'); } else { echo base_url('employee/index'); } ;?>">
        <div class="sidebar-brand-icon">
          <i class="fas"><img src="<?= base_url('assets/img/templates/logo.png');?>"></i>
        </div>
      </a>

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- QUERY MENU -->
      <?php
        $queryMenu = 
          "
            SELECT `user_menu`.`id` , `menu`
            FROM `user_menu` JOIN `user_access_menu`
            ON `user_menu`.`id` = `user_access_menu`.`menu_id`
            WHERE `user_access_menu`.`role_id` =  $role_id
            ORDER BY `user_access_menu`.`menu_id` ASC
          "
          ;
        $menu = $this->db->query($queryMenu)->result_array();
      ?>

      <!-- LOOPING MENU -->
      <?php foreach($menu as $m) { ?>
      <div class="sidebar-heading animated fadeinleftbig pb-1">
        <?= $m['menu']; ?>
      </div>

        <!-- LOOPING SUB MENU SESUAI MENU-->
        <?php
        $menuId = $m['id'];
          $querySubMenu = 
          "
            SELECT *
            FROM `user_sub_menu` JOIN `user_menu`
            ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
            WHERE `user_sub_menu`.`menu_id` =  $menuId
          "
          ;
          $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <?php foreach($subMenu as $sm) {   
          if(!($this->session->userdata('role_id') == 1 && ($sm['title'] == 'Add EFS Data' || $sm['title'] == 'Add Multiple EFS Data'))) {
        ?>
          <?php if ($title == $sm['title']) { ?>
          <li class="nav-item active animated delay-5s fadeinleftbig" style="background: rgba(0, 0, 200, .5);">
          <?php } else { ?>
          <li class="nav-item animated delay-5s fadeinleftbig">
          <?php } ?>
            <a class="nav-link pb-0 pt-0" href="<?= base_url($sm['url']); ?>">
              <i class="<?= $sm['icon']; ?>"></i>
              <span><?= $sm['title']; ?></span></a>
          </li>
        <?php } } ?>
        <hr class="sidebar-divider mb-0 mt-3">
      <?php } ?>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline mt-3">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->