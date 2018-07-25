<template>
    <div class="chat-right-aside">
        <div class="chat-main-header">
            <div class="p-20 b-b">
                <h3 class="box-title">Tin nhắn: {{ contact ? `${contact.f_name} ${contact.l_name}`: 'Chọn một admin' }}</h3> </div>
        </div>
        <div class="chat-box">
            <message-feed :messages="messages" :contact="contact" :user="user" :path="path"></message-feed>
            <write-message @newMessage="message"></write-message>
        </div>
    </div>
</template>

<script>
    import MessageFeed from './conversation/MessageFeed';
    import WriteMessage from './conversation/WriteMessage';
    export default {
        props:{
            messages:{
                type:Array,
                default:[],
            },
            contact:{
                type:Object,
                default:null
            },
            user:{
                type:Object,
                default:null,
                require:true
            },
            path:{
                type:String,
                default:''
            }
        },
        methods:{
            message:function (content) {
                console.log(content);
            }  
        },
        components:{
            'message-feed':MessageFeed,
            'write-message':WriteMessage
        }
    }
</script>