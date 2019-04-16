<template>

  <div>
            <div v-for="message in messages">
              <!-- <div v-if="id_mio == message.id_user_envia" >
                <ol class="discussion">
                  <li class="self">
                    <div class="avatar">
                      <img  :src="message.foto_user_1" />
                    </div>
                    <div>
                     
                    </div>
                    <div class="messages" >
                      <p>{{ message.use_1}}</p>
                      <p>{{ message.mensaje }}</p>
                      <img style="height:100%; width:100%" :src="message.archivo">
                      <time datetime="2009-11-13T20:14">37 mins</time>
                    </div>
                  </li>
                  </ol>
              </div>
              <div v-if="id_mio != message.id_user_envia" >
                 <ol class="discussion">
                  <li class="other">
                    <div class="avatar">
                      <img :src="message.foto_user_2" />
                    </div>
                    <div>
                     
                    </div>
                    <div class="messages" >
                      <p>{{ message.use_2 }}</p>
                      <p>{{ message.mensaje }}</p>
                      <div v-if="message.archivo">
                        <img style="height:100%; width:100%" :src="message.archivo">
                      </div>
                      
                      <time datetime="2009-11-13T20:14">37 mins</time>
                    </div>
                  </li>
                  </ol>
              </div> -->
            </div>  
  </div>
</template>

<script>
  

  export default {
    props: ['messages'],

    data(){
      return{
        loading: false,
        nameAuth:[],
        avatarDefault:'',
        id_mio: this.$auth.user().id,
      }
    },

    methods:{
     
     

    },
    created(){
      
    }
  };
</script>

<style scoped lang="scss" >
    

    @import url(http://weloveiconfonts.com/api/?family=typicons);
    [class*="typicons-"]:before {
      font-family: 'Typicons', sans-serif;
    }


    .top-bar {
     
      h1 {
        display: inline;
        font-size: 1.1rem;
      }
      .typicons-message {
        display: inline-block;
        padding: 4px 5px 2px 5px;
      }
      .typicons-minus {
        position: relative;
        top: 3px;
      }
      .left {
        float: left;
      }
      .right {
        float: right;
        padding-top: 5px;
      }
      > * {
        position: relative; 
      }
      &::before {
        content: "";
        position: absolute;
        top: -100%;
        left: 0;
        right: 0;
        bottom: -100%;
        opacity: 0.25;
        background: radial-gradient(white, black);
        animation: pulse 1s ease alternate infinite;
      }
    }

    .discussion {
      list-style: none;
      /*background: #e5e5e5;*/
      margin: 0;
      padding: 0 0 50px 0; // finality
      li {
        padding: 0.5rem;
        overflow: hidden;
        display: flex;
      }
      .avatar {
        width: 40px; // stronger than %
        // could set height, but gonna bottom-align instead
        position: relative; // for triangle
        img {
          display: block; // triangle position
          width: 100%;
          border-radius:40%;
        }
      }
    }

    .other {
      .avatar {
        &:after {
          content: "";
          position: absolute;
          top: 0;
          right: 0;
          width: 0;
          height: 0;
          border: 5px solid #00A2F8;
          border-left-color: transparent;
          border-bottom-color: transparent;
        }
      }
      .messages{
        border-bottom-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom-right-radius:10px;
      }
    }


    .self {
      justify-content: flex-end;
      align-items: flex-end;
      .messages {
        order: 1;
        border-bottom-right-radius: 0; // weird shadow fix
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom-left-radius:10px;
      }
      .avatar {
        order: 2;
        &:after {
          content: "";
          position: absolute;
          bottom: 0;
          left: 0;
          width: 0;
          height: 0;
          //**border: 5px solid #00A2F8;**//
          border-right-color: transparent;
          border-top-color: transparent;
          box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
        }
      }
    }

    .messages {
      
      width:300px;
      color:white;
      background: #00A2F8;
      padding: 10px;

        box-shadow: 5px 10px #E5E8E8;
      p {
        font-size: 0.9rem;
        margin: 0 0 0.2rem 0;
      }
      time {
        font-size: 0.7rem;
        color: #34495E;
      }
    }

    @keyframes pulse {
      from { opacity: 0; }
      to { opacity: 0.5; }
    }
</style>