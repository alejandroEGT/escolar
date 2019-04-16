<template>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                
                <textarea class="textarea_chat" placeholder="Escribir mensaje" name="message" v-model="newMessage" @keyup.enter="sendMessage">
                    
                </textarea>


            </div>
           <!--  <el-col :span="5" >
                <el-button @click="sendMessage" v-loading="load">
                Enviar
            </el-button>
            </el-col> -->
        </div>
        <!--<input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">-->
    </div>
</template>

<script>
    export default {
        props: ['user', 'load'],

        data() {
            return {
                newMessage: '',
                
            }
        },

        methods: {
            sendMessage() {
                console.log(this.user);
                var form = document.querySelector("#form1");
               this.$emit('messagesent', {
                    created_at: this.user.created_at,
                    foto_user_1: this.user.foto_user_1,
                    foto_user_2: this.user.foto_user_2,
                    id_user_envia: this.user.id_user_envia,
                    id_user_recibe: this.user.id_user_recibe,
                    fotos: new FormData(form),
                    mensaje: this.newMessage,
                    use_1: this.user.use_1,
                    use_2: this.user.use_2
                });

                this.newMessage = ''
            },
            
        }    
    }
</script>

<style type="text/css">
    .textarea_chat{
        width: 100%;
        border:none;
    }
</style>