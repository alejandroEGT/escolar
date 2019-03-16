
<template>
  <div class="page-container">
    <md-app md-waterfall md-mode="fixed-last">
      <md-app-toolbar class="md-large md-dense md-primary">
        <div class="md-toolbar-row">
          <div class="md-toolbar-section-start">
       <!--      <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
              <md-icon>menu</md-icon>
            </md-button> -->

            <span class="md-title">APP</span>
          </div>

          <!-- <div class="md-toolbar-section-end">
            <md-button class="md-icon-button">
              <md-icon>more_vert</md-icon>
            </md-button>
          </div> -->
        </div>

        <div class="md-toolbar-row">
          <md-tabs class="md-primary">
            <md-tab id="tab-home" md-label="Home" @click='url_' ></md-tab>
            <md-tab id="tab-pages" md-label="Login" @click="url_login"></md-tab>
            <md-tab id="tab-posts" md-label="Registrar" @click="url_create"></md-tab>
            <md-tab id="tab-favorites" md-label="Favorites"></md-tab>
          </md-tabs>
        </div>
      </md-app-toolbar>

      <md-app-drawer :md-active.sync="menuVisible">
        <md-toolbar class="md-transparent" md-elevation="0">Navigation</md-toolbar>

        <md-list>
          <md-list-item>
            <md-icon>move_to_inbox</md-icon>
            <span class="md-list-item-text">Inbox</span>
          </md-list-item>

          <md-list-item>
            <md-icon>send</md-icon>
            <span class="md-list-item-text">Sent Mail</span>
          </md-list-item>

          <md-list-item>
            <md-icon>delete</md-icon>
            <span class="md-list-item-text">Trash</span>
          </md-list-item>

          <md-list-item>
            <md-icon>error</md-icon>
            <span class="md-list-item-text">Spam</span>
          </md-list-item>
        </md-list>
      </md-app-drawer>

      <md-app-content>
          <transition name="">
            <router-view></router-view>
          </transition>
      </md-app-content>
    </md-app>
  </div>
</template>

<style lang="scss" scoped>
  .md-app {
   
    border: 1px solid rgba(#000, .12);
  }

   // Demo purposes only
  .md-drawer {
    background: red !important; // makes the drawer partially blue
  }
  
</style>

<script>

export default {
  name: 'LastRowFixed',
  data: () => ({
    menuVisible: false
  }),
  methods:{
    url_(){
      this.$router.push('/');
    },
    url_login(){
      this.$router.push('login') 
    },
    url_create(){
      this.$router.push('create') 
    }
  }
}
</script>