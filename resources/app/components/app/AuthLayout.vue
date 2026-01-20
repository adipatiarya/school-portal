<template>
  <!-- BEGIN login -->
  <div class="login login-v1">
    <!-- BEGIN login-container -->
    <div class="login-container">
      <!-- BEGIN login-header -->
      <div class="login-header">
        <div class="brand">
          <div class="d-flex align-items-center">
            <span class="logo"></span> <b>Color</b> Admin
          </div>
          <small>Bootstrap 5 Responsive Admin Template</small>
        </div>
        <div class="icon">
          <i class="fa fa-lock"></i>
        </div>
      </div>
      <!-- END login-header -->

      <!-- BEGIN login-body -->
      <div class="login-body">
        <!-- BEGIN login-content -->
        <slot></slot>
        <!-- END login-content -->
      </div>
      <!-- END login-body -->
    </div>
    <!-- END login-container -->
  </div>
  <!-- END login -->
</template>
