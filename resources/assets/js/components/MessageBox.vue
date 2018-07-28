<template>
    <div>
        <list-contact :contacts="contacts" :path="path" @contact="getSelectedContact"></list-contact>
        <conversation :messages="messages" :contact="contact" :user="user" :path="path"></conversation>
    </div>
</template>

<script>
    import ListContact from './ListContact';
    import Conversation from './Conversation';
    export default {
        props:{
            user:{
                type:Object,
                default:null,
                require:true
            },
            contact:{
                type:Object,
                default:null
            }
        },
        data(){
            return{
                contacts:[],
                messages:[],
                path:'',
            }
        },
        mounted(){
            this.getAllContact();
        },
        methods:{
            getAllContact:function () {
                axios.post('/admin/axios/all-contacts').then(response=>{
                    this.contacts = response.data.contacts;
                    this.path = response.data.path;
                });
                if(this.contact){
                    axios.post('/admin/axios/get-conversation',{
                        'contact_id':this.contact.id
                    }).then(response=>{
                        this.messages = response.data;
                    });

                    Echo.private(`message.${this.user.id}`)
                        .listen('SendMessage', (e) => {
                            if(this.contact && e.message.sent_from == this.contact.id){
                                this.messages.push(e.message);
                            }
                        });
                }
            },
            getSelectedContact:function (contact) {
                this.contact = contact;
                axios.post('/admin/axios/get-conversation',{
                    'contact_id':this.contact.id
                }).then(response=>{
                    this.messages = response.data;
                });

                Echo.private(`message.${this.user.id}`)
                    .listen('SendMessage', (e) => {
                        if(this.contact && e.message.sent_from == this.contact.id){
                            this.messages.push(e.message);
                        }
                    });
            },
        },
        components:{
            'list-contact': ListContact,
            'conversation': Conversation
        }
    }
</script>