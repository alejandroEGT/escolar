
   <template >
  <div  class="page-container" v-if="$auth.check()">
    <md-app md-mode="reveal">
      <md-app-toolbar class="md-primary">
        <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
          <md-icon>menu</md-icon>
        </md-button>
        <span class="md-title">{{ user.nombres }}</span>
      </md-app-toolbar>

      <md-app-drawer :md-active.sync="menuVisible">
        <md-toolbar class="md-transparent" md-elevation="0">Navigation</md-toolbar>

        <md-list>
          <md-list-item>
            <md-icon>move_to_inbox</md-icon>
            <span class="md-list-item-text" @click="logout">Salir</span>
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
        <div  >
                 <router-view :key="$route.path"></router-view>  
              </div>
      </md-app-content>
    </md-app>
  </div>
</template>

<style lang="scss" scoped>
  .md-app {
    max-height: 800px;
    border: 1px solid rgba(#000, .12);
  }

   // Demo purposes only
  .md-drawer {
    width: 230px;
    max-width: calc(100vw - 125px);
  }
  .back{
    background-image: url('https://designshack.net/wp-content/uploads/tips-for-using-background-textures-in-web-design.jpg');
    background-repeat: no-repeat;
    background-position: center; 
    position: relative;
  }
</style>

<script>
export default {
  name: 'Reveal',
  data: () => ({
    menuVisible: false,
    user: [],
  }),
  created(){
    this.user = this.$auth.user();
  },
  methods:{
  	 logout: function () {
         this.$auth.logout({
                  makeRequest: true,
                  redirect: '/'
              });
      },
  } ,
   computed: {
            img_section_style: function(){
                var bgImg= "https://designshack.net/wp-content/uploads/tips-for-using-background-textures-in-web-design.jpg"
                return {
                    // "color": "red",
                    // "border" : "5px solid ",
                    "background": 'url('+bgImg+')'
                }
            },
}
  
}
</script>