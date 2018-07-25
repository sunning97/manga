<template>
    <ul class="chat-list p-t-30" ref="feed">
        <li v-for="message in messages" :class="message.sent_from == contact.id ? '' : 'odd'">
            <div class="chat-image"> <img :src="message.sent_from == contact.id ? (path+'/'+contact.avatar) : (path+'/'+user.avatar)"> </div>
            <div class="chat-body">
                <div class="chat-text">
                    <!--<h4>{{ message.sent_from == contact.id ? contact.avatar : user.avatar }}</h4>-->
                    <p> {{ message.content }} </p> <b>{{ date_format(message.created_at) }}</b> </div>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props:{
            messages:{
                type:Array,
                default:[]
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
        mounted(){
            $('.chat-list').slimScroll({
                height: '100%',
                position: 'right',
                size: "0px",
                color: '#dcdcdc',

            });
            $('.chat-list').css({'height':(($(window).height())-420)+'px'});
        },
        methods:{
            date_format:function (str) {
                return  $.format.date(str, "dd-MM-yyyy , hh:mm");
            },
            scroll:function () {
                setTimeout(()=>{
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                },50);
            }
        },
        watch:{
            contact(contact){
                this.scroll();
            },
            messages(message){
                this.scroll();
            }
        }
    }
</script>