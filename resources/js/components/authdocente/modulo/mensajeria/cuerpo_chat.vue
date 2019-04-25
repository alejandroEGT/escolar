<template>
	<div>
	<div class="box-chat" >
	 <div class="chat-body" v-chat-scroll >	
    <ol class="chat">
   		<div v-for="message in messages">
				<div v-if="id_mio == message.id_user_envia" >

					<li class="self">
				        <div class="avatar">Tú<!--<img :src="'/'+message.foto_use_1" draggable="false"/>--></div>
				      <div class="msg">
				        <p>{{message.mensaje}} <!-- <emoji class="books"/> --></p>
                        <div v-if="message.archivo">
                           <img style="width:100%; height:100%;"  :src="message.archivo">
                        </div>
				        <time><i class="far fa-clock"></i> {{' '+message.cuando}}</time>
				      </div>
				    </li>

				</div>
				
				 <div v-if="id_mio != message.id_user_envia" >
				    
				    <li class="other">
				        <div class="avatar"><img style="width:100%; height:100%;"  :src="'/'+message.foto_use_2" draggable="false"/></div>
				      <div class="msg">
				        <p style="color:white">{{message.mensaje}} <!-- <emoji class="pizza"/> --></p>
                        <div v-if="message.archivo">
                           <img style="width:100%; height:100%;"  :src="message.archivo">
                        </div>
				        <time><i class="far fa-clock"></i> {{' '+message.cuando}}</time>
				      </div>
				    </li>
				 </div>
	    </div>
    </li>
   
    </ol>
 </div>
</div>
   <div class="container">
    <form method="POST" id="form1" enctype="multipart/form-data">
        <div class="image-upload">
          <label for="file-input">
            <i style="color:#7F8C8D" class="fas fa-camera-retro fa-2x"></i>
          </label>
          <input type="hidden" name="id_recibe" v-model="id_recibe" >
          <input type="hidden" v-model="newMessage" name="newMessage">
          <input id="file-input" name="fotos[]" @change="sendFoto" type="file" />
        </div>
    </form>
   </div>
    <input class="textarea" type="text" placeholder="Ingrese mensaje.." name="message" v-model="newMessage" @keyup.enter="addMessage"/>
	</div>
</template>



<script type="text/javascript">
    
    export default{
        data(){
            return{
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
                	
                ],
                newMessage: '',
                id_recibe: this.$route.params.user,
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
                          foto_use_2: e.user.avatar,
                          use_2: e.user.nombres,
                          created_at: e.user.created_at,
                          cuando: e.message.cuando
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
                          foto_use_1: this.nameAuth.avatar,
                          use_1: this.user.nombres,
                          id_user_envia: this.user.id,
                          cuando: 'Ahora'

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
                    this.newMessage = ''
                    console.log(response.data)
                    this.fetchMessages();
                    
                })
            }
      }
    }
</script>



<style type="text/css">
	



/* M E N U */

/*.menu {
    position: fixed;
    top: 0px;
    left: 0px;
    right: 0px;
    width: 100%;
    height: 50px;
    background: rgba(82,179,217,0.9);
    z-index: 100;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}*/


.image-upload>input {
  display: none;
}

/* M E S S A G E S */

.chat {
    list-style: none;
    background: none;
    margin: 0;
    padding: 0 0 50px 0;
    margin-top: 60px;
    margin-bottom: 10px;

}
.chat li {
    padding: 0.5rem;
    overflow: hidden;
    display: flex;

}
.chat .avatar {
    width: 40px;
    height: 40px;
    position: relative;
    display: block;
    z-index: 2;
    border-radius: 100%;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    -ms-border-radius: 100%;
    background-color: rgba(255,255,255,0.9);
}
.chat .avatar img {
    width: 40px;
    height: 40px;
    border-radius: 100%;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    -ms-border-radius: 100%;
    background-color: rgba(255,255,255,0.9);
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;

}
.chat .day {
    position: relative;
    display: block;
    text-align: center;
    color: #c0c0c0;
    height: 20px;
    text-shadow: 7px 0px 0px #e5e5e5, 6px 0px 0px #e5e5e5, 5px 0px 0px #e5e5e5, 4px 0px 0px #e5e5e5, 3px 0px 0px #e5e5e5, 2px 0px 0px #e5e5e5, 1px 0px 0px #e5e5e5, 1px 0px 0px #e5e5e5, 0px 0px 0px #e5e5e5, -1px 0px 0px #e5e5e5, -2px 0px 0px #e5e5e5, -3px 0px 0px #e5e5e5, -4px 0px 0px #e5e5e5, -5px 0px 0px #e5e5e5, -6px 0px 0px #e5e5e5, -7px 0px 0px #e5e5e5;
    box-shadow: inset 20px 0px 0px #e5e5e5, inset -20px 0px 0px #e5e5e5, inset 0px -2px 0px #d7d7d7;
    line-height: 38px;
    margin-top: 5px;
    margin-bottom: 20px;
    cursor: default;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;

}

.other .msg {
    order: 1;
    border-top-left-radius: 0px;
    box-shadow: -1px 2px 0px #D4D4D4;
    background: #5DADE2;
    border-radius: 8px;
    width: 18rem;
}
.other:before {
    content: "";
    position: relative;
    top: 0px;
    right: 0px;
    left: 40px;
    width: 0px;
    height: 0px;
    border: 5px solid #fff;
    border-left-color: transparent;
    border-bottom-color: transparent;
    /*background: #5499C7;*/
}

.self {
    justify-content: flex-end;
    align-items: flex-end;
}
.self .msg {
    order: 1;
    border-bottom-right-radius: 0px;
    box-shadow: 1px 2px 0px #D4D4D4;
    background: #5D6D7E;
    border-radius: 8px;
    width: 18rem;
}
.self .avatar {
    order: 2;

}
.self .avatar:after {
    content: "";
    position: relative;
    display: inline-block;
    bottom: 19px;
    right: 0px;
    width: 0px;
    height: 0px;
    /*border: 5px solid red;*/
    border-right-color: transparent;
    border-top-color: transparent;
    /*box-shadow: 0px 2px 0px red;*/

}

.msg {
    background: white;
    min-width: 50px;
    padding: 10px;
    border-radius: 2px;
    box-shadow: 0px 2px 0px rgba(0, 0, 0, 0.07);
}
.msg p {
    font-size: 0.8rem;
    margin: 0 0 0.2rem 0;
    color: white;
}
.msg img {
    position: relative;
    display: block;
    width: 450px;
    border-radius: 5px;
    box-shadow: 0px 0px 3px #eee;
    transition: all .4s cubic-bezier(0.565, -0.260, 0.255, 1.410);
    cursor: default;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}
@media screen and (max-width: 800px) {
    .msg img {
    width: 300px;
}
}
@media screen and (max-width: 550px) {
    .msg img {
    width: 200px;
}
}

.msg time {
    font-size: 0.7rem;
    color: white;
    margin-top: 3px;
    float: right;
    cursor: default;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}
.msg time:before{
    content:"";
    color: white;
    font-family: FontAwesome;
    display: inline-block;
    margin-right: 4px;
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


/*emoji{
    display: inline-block;
    height: 18px;
    width: 18px;
    background-size: cover;
    background-repeat: no-repeat;
    margin-top: -7px;
    margin-right: 2px;
    transform: translate3d(0px, 3px, 0px);
}*/
/*emoji.please{background-image: url(https://imgur.com/ftowh0s.png);}
emoji.lmao{background-image: url(https://i.imgur.com/MllSy5N.png);}
emoji.happy{background-image: url(https://imgur.com/5WUpcPZ.png);}
emoji.pizza{background-image: url(https://imgur.com/voEvJld.png);}
emoji.cryalot{background-image: url(https://i.imgur.com/UUrRRo6.png);}
emoji.books{background-image: url(https://i.imgur.com/UjZLf1R.png);}
emoji.moai{background-image: url(https://imgur.com/uSpaYy8.png);}
emoji.suffocated{background-image: url(https://i.imgur.com/jfTyB5F.png);}
emoji.scream{background-image: url(https://i.imgur.com/tOLNJgg.png);}
emoji.hearth_blue{background-image: url(https://i.imgur.com/gR9juts.png);}
emoji.funny{background-image: url(https://i.imgur.com/qKia58V.png);}

@-webikt-keyframes pulse {
  from { opacity: 0; }
  to { opacity: 0.5; }
}

::-webkit-scrollbar {
    min-width: 12px;
    width: 12px;
    max-width: 12px;
    min-height: 12px;
    height: 12px;
    max-height: 12px;
    background: #e5e5e5;
    box-shadow: inset 0px 50px 0px rgba(82,179,217,0.9), inset 0px -52px 0px #fafafa;
}

::-webkit-scrollbar-thumb {
    background: #bbb;
    border: none;
    border-radius: 100px;
    border: solid 3px #e5e5e5;
    box-shadow: inset 0px 0px 3px #999;
}

::-webkit-scrollbar-thumb:hover {
    background: #b0b0b0;
  box-shadow: inset 0px 0px 3px #888;
}

::-webkit-scrollbar-thumb:active {
    background: #aaa;
  box-shadow: inset 0px 0px 3px #7f7f7f;
}

::-webkit-scrollbar-button {
    display: block;
    height: 26px;
}*/

/* T Y P E */

input.textarea {
    position: fixed;
    bottom: 0px;
    left: 0px;
    right: 0px;
    width: 100%;
    height: 50px;
    z-index: 99;
    background: #fafafa;
    border: none;
    outline: none;
    padding-left: 55px;
    padding-right: 55px;
    color: #666;
    font-weight: 400;
}

</style>