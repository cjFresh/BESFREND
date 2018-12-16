<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control" placeholder="Type your message..." v-model="newMessage" @keyup.enter="sendMessage">

        <span class="input-group-btn">
            <button class="btn btn-success" style="border-radius: 0;" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data(){
            return{
                newMessage: ''
            }
        },
        methods:{
            /*/
             * sendMessage() triggers messagesent event
             * which passes the message send by the user
            /*/
            sendMessage(){
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            }
        }
    }
</script>
