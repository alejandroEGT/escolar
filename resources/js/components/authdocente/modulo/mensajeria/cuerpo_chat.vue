
<template>
  
                <div>
                    <div class="box-chat" >
                        <div class="chat-body" v-chat-scroll >
                            <!-- <chat-messages :messages="messages"></chat-messages> -->
                            <div v-for="message in messages">
					              <div v-if="id_mio == message.id_user_envia" >
					                <ol class="discussion">
					                  <li class="self">
					                    <div class="avatar">
					                      <img  :src="message.foto_user_1" />
					                    </div>
					                    <div>
					                     
					                    </div>
					                    <div class="messages" >
					                      <!-- <p>{{ message.nombre }}</p> -->
					                      <p>{{ message.mensaje }}</p>
					                      <img style="height:100%; width:100%" :src="message.archivo">
					                      <time datetime="2009-11-13T20:14">40 mins</time>
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
						                      <!-- <p>{{ message.nombre }}</p> -->
						                      <p>{{ message.mensaje }}</p>
						                      <div v-if="message.archivo">
						                        <img style="height:100%; width:100%" :src="message.archivo">
						                      </div>
						                      
						                      <time datetime="2009-11-13T20:14">37 mins</time>
						                    </div>
					                  </li>
					                  </ol>
					              </div>
            				</div>  
            				<div class="row">
					            <div class="col-md-12">
					                
					                <textarea class="textarea_chat" placeholder="Escribir mensaje" name="message" v-model="newMessage" @keyup.enter="addMessage">
					                    
					                </textarea>


					            </div>
         
       						 </div>
                     
                        </div>
                
                 <div class="chat-footsss">           
                     <!-- <chat-form v-on:messagesent="addMessage" :user="nameAuth" :load="btn_load"></chat-form> -->
                    <!--  <form method="POST" id="form1" enctype="multipart/form-data">
                      <input type="hidden" name="id_recibe" v-model="id_recibe" >
                      <input type="file" name="fotos[]" @change="sendFoto">
                  </form> -->
                  </div>
                    </div>
                </div>
          
</template>




<script type="text/javascript">
    
    export default{
        data(){
            return{
                loading: true,
                id: this.$route.params.user,
                amigo:{
                    nombres:'',
                    apellidos:'',
                    avatar:''
                },
                nameAuth:[],
		        avatarDefault:'',
		        user:this.$auth.user(),
		        id_mio: this.$auth.user().id,

                btn_load: false,
                nameAuth: this.$auth.user(),
                messages:[
                	{id:1, nombre:'alejandro', mensaje:'hola como estas'},
                	{id:2, nombre:'mariana', mensaje:'bien y tu'}
                ],
                newMessage: '',
                id_recibe: this.$route.params.id,
            }
        },
        mounted(){
            this.getAmigo();

        },
        created(){
             this.listen();
            this.fetchMessages();
        },
        methods:{
            getAmigo(){
                axios.get('api/auth/amigo/'+this.id).then((response)=>{
                        this.amigo = response.data;
                        this.loading = false;
                })
            },
            listen() {
          
          Echo.private('chat.'+this.nameAuth.id).listen('MessageSentEvent', (e) => {
                  if (e.message.id_user_recibe === this.$auth.user().id) {

                      var audio = new Audio('http://soundbible.com/mp3/Elevator Ding-SoundBible.com-685385892.mp3');
                      audio.play();
                        this.messages.push({
                          mensaje: e.message.mensaje,
                          archivo: e.message.archivo,
                          foto_user_2: e.user.avatar,
                          use_2: e.user.nombres,
                          created_at: e.user.created_at
                        });
                  }
                                    
          });      
                      
        },
        sendMessage() {
          
                console.log(this.user);
                //var form = document.querySelector("#form1");
               this.$emit('messagesent', {
                    user: this.user,
                    mensaje: this.newMessage,
                    
                });

                this.newMessage = ''
        },
        fetchMessages() {
            axios.get('api/auth/messages/'+this.id).then(response => {
                this.messages = response.data;
                //console.log(response.data);
            });
        },

        addMessage() {
          //console.log(this.newMessage)
          console.log(this.user.nombres)
            this.messages.push({
                          
                          //created_at: '192'
                          
                          mensaje: this.newMessage,
                         // foto_user_1: this.nameAuth.avatar,
                          use_1: this.user.nombres,
                          id_user_envia: this.user.id,
                          //created_at: e.user.created_at

                        });
            var datos={}  
            datos.id_envia = this.id_mio;
            datos.message = this.newMessage;
            datos.id_recibe = this.id;
            //console.log(datos);
            axios.post('api/auth/messages', datos).then(response => {
              //this.fetchMessages();
            
               this.newMessage = '';
            });
        },
        sendFoto(){
                 var datos={} 
                 var form = document.querySelector("#form1");
                

                axios.post('api/auth/fotoChat', new FormData(form),{
                    headers:{
                        'content-Type': 'miltipart/form-data'
                    }
                }).then((response) =>{
                    
                    console.log(response.data)
                    this.fetchMessages();
                    
                })
            }
      }
    }
</script>

<style type="text/css">
    .avatar_amigo{
        border-radius: 50px;
        height: 70px;
        width: 70px;
    }
    .box-chat{
        position: relative;
        height: 500px;
        width: 100%;
        
    }
    .chat-body{

        height: 450px;
        width: 100%;
        overflow: auto;
        border-bottom: 1px solid #D5DBDB;
    }
    .chat-foot{
          position: absolute;
          right: 0;
          bottom: 0;
          left: 0;
          padding: 1rem;
          text-align: center;
          background: #ECF0F1;
    }
    .textarea_chat{
        width: 100%;
        border:none;
    }


</style>
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