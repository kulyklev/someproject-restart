<template>
  <nav class="navbar-dark bg-primary navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link to="/" class="nav-link">Home</router-link>
        </li>

        <li class="nav-item">
          <router-link to="/workspace" class="nav-link">Workspace</router-link>
        </li>

        <li class="nav-item">
          <router-link to="/faq" class="nav-link" >About</router-link>
        </li>

        <li class="nav-item">
          <router-link to="/register" class="nav-link">Register</router-link>
        </li>

        <li class="nav-item">
          <router-link to="/login" class="nav-link">Login</router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'nav-header',
};
</script>
