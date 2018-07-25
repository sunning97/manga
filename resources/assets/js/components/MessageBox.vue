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
        },
        data(){
            return{
                contacts:[],
                messages:[],
                path:'',
                contact:null
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
            },
            getSelectedContact:function (contact) {
                this.contact = contact;
                axios.post('/admin/axios/get-conversation',{
                    'contact_id':this.contact.id
                }).then(response=>{
                    this.messages = response.data;
                });
            }
        },
        components:{
            'list-contact': ListContact,
            'conversation': Conversation
        }
    }
</script>